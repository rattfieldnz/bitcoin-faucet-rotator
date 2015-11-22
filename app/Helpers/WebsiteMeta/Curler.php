<?php namespace App\Helpers\WebsiteMeta;

// dependency check
use Exception;

if (!in_array('curl', get_loaded_extensions())) {
    throw new Exception('Curl extension needs to be installed.');
}

/**
 * Curler
 *
 * Makes Curl requests (HEAD, GET and POST) to a URI.
 *
 * @link    https://github.com/onassar/PHP-Curler
 * @author  Oliver Nassar <onassar@gmail.com>
 * @notes   currently has features that limit requests if file size is too
 *          large, or mime type isn't acceptable for the request
 *          GET's are setup to, by default, accept only webpage mime types;
 *          HEAD's are setup to accept all, so you need to be specific if you
 *          want a HEAD to fail (return <false>) for certain mime type checks
 *          all requests will fail/return <false> if a 404 is encoutered; the
 *          response can still be accessed with the <getInfo> method, however
 *          if a response has no mime type, it will fail
 * @example
 * <code>
 *     // booting
 *     require_once APP . '/vendors/PHP-Curler/Curler.class.php';
 *
 *     // <GET> requests
 *     $curler = (new Curler());
 *     $curler->get('http://www.google.com/'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->setMime('webpages');
 *     $curler->get('http://www.google.com/'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->setMime('text/html');
 *     $curler->get('http://www.google.com/'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->get('http://www.google.ca/intl/en/images/about_logo.gif');
 *     // fails (default is to accept only webpage mime types)
 *
 *     $curler = (new Curler());
 *     $curler->setMime('images');
 *     $curler->get('http://www.google.ca/intl/en/images/about_logo.gif'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->setMime('gif');
 *     $curler->get('http://www.google.ca/intl/en/images/about_logo.gif'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->setMime('image/gif');
 *     $curler->get('http://www.google.ca/intl/en/images/about_logo.gif'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->setMime('image/jpeg');
 *     $curler->get('http://www.google.ca/intl/en/images/about_logo.gif'); // fails
 *
 *     $curler = (new Curler());
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // fails, since response is image/javascript
 *
 *     $curler = (new Curler());
 *     $curler->setMime('image');
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // fails if javascript, passes otherwise
 *
 *     $curler = (new Curler());
 *     $curler->setMime('image/jpeg');
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // fails if javascript, passes otherwise
 *
 *     $curler = (new Curler());
 *     $curler->setMime('javascript');
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // fails if image, passes otherwise
 *
 *     $curler = (new Curler());
 *     $curler->setMime('text/javascript');
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // fails if image, passes otherwise
 *
 *     $curler = (new Curler());
 *     $curler->setMimes('image', 'javascript');
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // passes
 *
 *     $curler = (new Curler());
 *     $curler->setMime('all');
 *     $curler->get('https://graph.facebook.com/oliver.nassar/picture'); // passes
 *
 *     // <POST> requests
 *     $curler = (new Curler());
 *     $curler->head('http://www.google.com/'); // passes (theoretically; head call will go through)
 *
 *     $curler = (new Curler());
 *     $curler->setMimes('image', 'javascript');
 *     $curler->head('http://www.google.com/');
 *     // fails (theoretically; head call will go through)
 *
 *     $curler = (new Curler());
 *     $curler->head('http://www.google.ca/intl/en/images/about_logo.gif');
 *     // passes (theoretically; head call will go through)
 *
 *     $curler = (new Curler());
 *     $curler->head('graph.facebook.com/oliver.nassar/picture');
 *     // passes (theoretically; head call will go through)
 * </code>
 */
class Curler
{
    /**
     * acceptable
     *
     * Array of acceptable mime types that ought to result in a successful
     * curl.
     *
     * @var    array
     * @access protected
     */
    protected $acceptable;

    /**
     * auth
     *
     * HTTP auth credentials
     *
     * @var    array
     * @access protected
     */
    protected $auth;

    /**
     * cookie
     *
     * Path to the cookie file that should be used for temporary storage of
     * cookies that are sent back by a curl.
     *
     * @var    string
     * @access protected
     */
    protected $cookie;

    /**
     * death
     *
     * When set to false, signifies that the curl should never die; when set
     * to an int (eg. 404), signifies the http status code that should mark
     * it to die.
     *
     * @var    false|integer|array
     * @access protected
     */
    protected $death;

    /**
     * dynamicResponse
     *
     * @var    string (default: '')
     * @access protected
     */
    protected $dynamicResponse = '';

    /**
     * error
     *
     * Array containing details of a possible error.
     *
     * @var    array
     * @access protected
     */
    protected $error;

    /**
     * headers
     *
     * Array containing the request headers that will be sent with the curl.
     *
     * @var    array
     * @access protected
     */
    protected $headers;

    /**
     * headInfo
     *
     * @var    array
     * @access protected
     */
    protected $headInfo;

    /**
     * info
     *
     * Storage of the info that was returned by the GET and HEAD calls
     * (since a GET is always preceeded by a HEAD).
     *
     * @var    array
     * @access protected
     */
    protected $info;

    /**
     * limit
     *
     * The limit, in kilobytes, that the curler will grab. This is
     * determined by sending a HEAD request first.
     *
     * (default value: 1024)
     *
     * @var    integer
     * @access protected
     */
    protected $limit = 1024;

    /**
     * mimes
     *
     * Mime type mappings, used to determine if requests should be processed
     * and/or returned.
     *
     * @notes  can be modified if you want certain mime-types (eg.
     *         application/whatever) to be 'categorized' in a certain way
     * @var    array
     * @access protected
     */
    protected $mimes = [

        // js
        'application/json' => [
            'all',
            'javascript',
            'js',
            'json',
            'text'
        ],
        'application/rss+xml' => [
            'all',
            'text',
            'xml'
        ],
        'application/x-javascript' => [
            'all',
            'javascript',
            'js',
            'text'
        ],
        'application/xhtml+xml' => [
            'all',
            'text',
            'webpage',
            'webpages',
            'xhtml',
            'xml'
        ],
        'application/xml' => [
            'all',
            'text',
            'xml'
        ],

        // images
        'image/bmp' => [
            'all',
            'bmp',
            'image',
            'images'
        ],
        'image/gif' => [
            'all',
            'gif',
            'image',
            'images'
        ],
        'image/jpeg' => [
            'all',
            'image',
            'images',
            'jpeg',
            'jpg'
        ],
        'image/jpg' => [
            'all',
            'image',
            'images',
            'jpeg',
            'jpg'
        ],
        'image/pjpeg' => [
            'all',
            'image',
            'images',
            'jpeg',
            'jpg'
        ],
        'image/png' => [
            'all',
            'image',
            'images',
            'png'
        ],
        'image/vnd.microsoft.icon' => [
            'all',
            'image',
            'images'
        ],
        'image/x-icon' => [
            'all',
            'image',
            'images'
        ],
        'image/x-bitmap' => [
            'all',
            'image',
            'images'
        ],

        // css
        'text/css' => [
            'all',
            'css',
            'text'
        ],

        // html
        'text/html' => [
            'all',
            'html',
            'text',
            'webpage',
            'webpages'
        ],

        // plain
        'text/plain' => [
            'all',
            'text'
        ],

        // javascript
        'text/javascript' => [
            'all',
            'javascript',
            'js',
            'text'
        ],
        'text/x-javascript' => [
            'all',
            'javascript',
            'js',
            'text'
        ],
        'text/x-json' => [
            'all',
            'javascript',
            'js',
            'json',
            'text'
        ]
    ];

    /**
     * response
     *
     * @var    String
     * @access protected
     */
    protected $response;

    /**
     * timeout
     *
     * Number of seconds to wait before timing out and failing.
     *
     * @var    integer
     * @access protected
     */
    protected $timeout;

    /**
     * userAgent
     *
     * The user agent that should be simulating the request.
     *
     * @var    string
     * @access protected
     */
    protected $userAgent;

    /**
     * curlOptions
     *
     * Array of curl options
     *
     * @var    array
     * @access protected
     */
    protected $curlOptions = [];

    /**
     * __construct
     *
     * @access public
     * @param  Integer $death . (default: 404) HTTP code that should kill the
     *         request (eg. don't return the response); if false, will
     *         continue always
     */
    public function __construct($death = 404)
    {
        // ensure no HTTP auth credentials are setup
        $this->auth = [];

        // set the death code (used for marking a 'failed' curl)
        $this->death = $death;

        // set the mime types that are acceptable, by default
        $this->setMime('webpages');

        // set default cookie path
        $this->cookie = __DIR__ . '/cookies.txt';

        // set the request headers
        $this->setHeaders([
            'Connection' => 'keep-alive',
            'Accept-Language' => 'en-us,en;q=0.5'
        ]);

        // set timeout in seconds
        $this->setTimeout(5);

        // set user agent
        $this->setUserAgent(
            'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-US; ' .
            'rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12'
        );

        // Set default curl options
        $this->setCurlOptions([
            'CURLOPT_SSL_VERIFYPEER' => false,
            'CURLOPT_SSL_VERIFYHOST' => 2,
            'CURLOPT_FOLLOWLOCATION' => true,
            'CURLOPT_MAXREDIRS' => 10,
        ]);
    }

    /**
     * close
     *
     * @access protected
     * @param  resource $resource
     * @return void
     */
    protected function close($resource)
    {
        curl_close($resource);
    }

    /**
     * getCurlOption
     *
     * Returns a pre-defined curl option value
     *
     * @access protected
     * @param  string $option
     * @return mixed
     * @throws Exception
     */
    protected function getCurlOption($option)
    {
        if (!isset($this->curlOptions[$option])) {
            throw new Exception(
                'Curl option ' . ($option) . ' is empty. Use setCurlOptions'
            );
        }
        return $this->curlOptions[$option];
    }

    /**
     * getHeaders
     *
     * Parses and returns the headers for the curl request.
     *
     * @access protected
     * @return array headers formatted to be correctly formed for an HTTP request
     */
    protected function getHeaders()
    {
        $formatted = [];
        foreach ($this->headers as $name => $value) {
            array_push($formatted, ($name) . ': ' . ($value));
        }
        return $formatted;
    }

    /**
     * getResource
     *
     * Creates a curl resource, set's it up, and returns it's reference.
     *
     * @access protected
     * @param  String $url
     * @param  Boolean $head . (default: false) whether or not this is a HEAD
     *         request, in which case no response-body is returned
     * @return Resource curl resource reference
     */
    protected function getResource($url, $head = false)
    {
        // ensure cookie is writable by attempting to open it up
        $this->openCookie();

        // init call, headers, user agent
        $resource = curl_init($url);
        curl_setopt($resource, CURLOPT_HTTPHEADER, $this->getHeaders());
        curl_setopt($resource, CURLOPT_HEADER, false);
        curl_setopt($resource, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($resource, CURLOPT_ENCODING, 'gzip,deflate');

        // authentication
        if (!empty($this->auth)) {
            curl_setopt(
                $resource,
                CURLOPT_USERPWD,
                ($this->auth['username']) . ':' .
                ($this->auth['password'])
            );
        }

        // cookies
        curl_setopt($resource, CURLOPT_COOKIEFILE, $this->cookie);
        curl_setopt($resource, CURLOPT_COOKIEJAR, $this->cookie);

        // time allowances
        curl_setopt($resource, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($resource, CURLOPT_TIMEOUT, $this->timeout);

        // https settings
        curl_setopt(
            $resource,
            CURLOPT_SSL_VERIFYPEER,
            $this->getCurlOption('CURLOPT_SSL_VERIFYPEER')
        );
        curl_setopt(
            $resource,
            CURLOPT_SSL_VERIFYHOST,
            $this->getCurlOption('CURLOPT_SSL_VERIFYHOST')
        );
        curl_setopt($resource, CURLOPT_FRESH_CONNECT, true);

        // response, redirection, and HEAD request settings
        curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $resource,
            CURLOPT_FOLLOWLOCATION,
            $this->getCurlOption('CURLOPT_FOLLOWLOCATION')
        );
        curl_setopt(
            $resource,
            CURLOPT_MAXREDIRS,
            $this->getCurlOption('CURLOPT_MAXREDIRS')
        );
        curl_setopt($resource, CURLOPT_NOBODY, $head);

        // return resource reference (all set up and ready to go)
        return $resource;
    }

    /**
     * openCookie
     *
     * @access protected
     * @throws Exception
     */
    protected function openCookie()
    {
        // ensure file is writable
        if (file_exists($this->cookie)) {
            if (posix_access($this->cookie, POSIX_W_OK) === false) {
                throw new Exception(
                    'File *' . ($this->cookie) . '* must be writable ' .
                    'for cookie storage.'
                );
            }
        } // ensure file directory is writable

        $dir = dirname($this->cookie);
        if (is_writable($dir) === false) {
            throw new Exception(
                'Path *' . ($dir) . '* must be writable for cookie ' .
                'storage.'
            );
        }

        // open file
        $resource = fopen($this->cookie, 'w');
        fclose($resource);
    }

    /**
     * valid
     *
     * Ensures that a request is valid, based on the http code, mime type
     * and content length returned.
     *
     * @access protected
     * @return Boolean whether or not the request is valid to be processed
     */
    protected function valid()
    {
        // should be killed; die
        if (in_array($this->headInfo['http_code'], (array)$this->death)) {
            $this->error = [
                'message' => ($this->headInfo['http_code']) .
                    ' error while trying to retrieve ' .
                    ($this->headInfo['url'])
            ];
            return false;
        }

        // check if mime type requirement met
        $mimes = $this->getMimes();
        $pieces = explode(';', $this->headInfo['content_type']);
        $mime = current($pieces);
        if (!in_array($mime, $mimes)) {
            // make error, and return false (eg. <content_type> didn't
            // match; info still available for usage via
            // <$this->getInfo>)
            $this->error = [
                'message' => 'Mime-type requirement not met. Resource is ' .
                    current(explode(';', $this->headInfo['content_type'])) .
                    '. You were hoping for one of: ' .
                    implode(', ', $this->getMimes()) . '.'
            ];
            return false;
        }

        // greater than maximum allowed
        if ($this->headInfo['download_content_length'] > ($this->limit * 1024)) {
            // make error, return false
            $this->error = [
                'message' => ('File size limit reached. Limit was set to ') .
                    ($this->limit) . ('kb. ') . ('Resource is ') .
                    round(($this->headInfo['download_content_length'] / 1024), 2) .
                    ('kb.')
            ];
            return false;
        }

        // return as valid
        return true;
    }

    /**
     * addMime
     *
     * Adds a specific mime type to the acceptable range for a
     * return/response.
     *
     * @access public
     * @param  String $mime
     * @return void
     */
    public function addMime($mime)
    {
        $this->acceptable[] = $mime;
    }

    /**
     * addMimes
     *
     * Adds passed in mime types to the array tracking which are acceptable
     * to be returned.
     *
     * @access public
     * @return void
     */
    public function addMimes()
    {
        $args = func_get_args();
        foreach ($args as $mime) {
            $this->addMime($mime);
        }
    }

    /**
     * get
     *
     * Returns the actual content (string), or else false if the request
     * failed.
     *
     * @access public
     * @param  String $url
     * @return String|false
     */
    public function get($url)
    {
        // execute HEAD call, and check if invalid
        if (is_null($this->headInfo)) {
            $this->head($url);
        }
        if (!$this->valid()) {
            /**
             * failed HEAD, so return <false> (info of the call and error
             * details still available through <$this->getInfo> and
             * <$this->getError>, respectively)
             */
            return false;
        }

        // mime type setting
        $this->setHeader('Accept', implode(',', $this->getMimes()));
        $resource = $this->getResource($url);
        curl_setopt($resource, CURLOPT_WRITEFUNCTION, [$this, 'writeCallback']);

        // make the GET call, storing the response; store the info
        curl_exec($resource);
        $this->response = $this->dynamicResponse;
        $this->info = curl_getinfo($resource);

        // error founded
        if (curl_errno($resource) !== '0') {
            $this->error = [
                'code' => curl_errno($resource),
                'message' => curl_error($resource)
            ];
        }

        // close the resource
        $this->close($resource);

        // give the response back :)
        return $this->response;
    }

    /**
     * getCharset
     *
     * Requires $this->get to be called before being called.
     *
     * @access public
     * @return String|false
     */
    public function getCharset()
    {
        $headerCharset = $this->getHeaderCharset();
        if ($headerCharset !== false) {
            return $headerCharset;
        }
        return $this->getContentCharset();
    }

    /**
     * getContentCharset
     *
     * @note   The `url` value being used from the curler info is valid to
     *         use since it is the redirect url. For example, if a bit.ly
     *         link is specified, the `url` value being used below is not
     *         bit.ly, but rather whatever site it's being redirect to.
     * @access public
     * @return false|String
     * @throws Exception
     */
    public function getContentCharset()
    {
        // dependency check
        if (class_exists('MetaParser') === false) {
            throw new Exception(
                '*MetaParser* class required. Please see ' .
                'https://github.com/onassar/PHP-MetaParser'
            );
        }

        // instantiate parser to get access to content's provided charset
        $info = $this->getInfo();
        $parser = (new MetaParser($this->response, $info['url']));
        return $parser->getCharset();
    }

    /**
     * getError
     *
     * Get details on the error that occured.
     *
     * @access public
     * @return array
     */
    public function getError()
    {
        if (is_null($this->error)) {
            return [];
        }
        return $this->error;
    }

    /**
     * getHeaderCharset
     *
     * @access public
     * @return String|false
     */
    public function getHeaderCharset()
    {
        // check header
        $info = $this->getInfo();
        $contentType = $info['content_type'];
        $pattern = '#charset=([a-zA-Z0-9-]+)#';
        preg_match($pattern, $contentType, $matches);
        if (isset($matches[1])) {
            $charset = array_pop($matches);
            $charset = trim($charset);
            $charset = strtolower($charset);
            if ($charset === 'utf8') {
                return 'utf-8';
            }
            return $charset;
        }
        return false;
    }

    /**
     * getInfo
     *
     * Grabs the previously stored info for the curl call.
     *
     * @access public
     * @return array
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * getHeadInfo
     *
     * @access public
     * @return array
     */
    public function getHeadInfo()
    {
        return $this->headInfo;
    }

    /**
     * getMimes
     *
     * Maps the mime types specified and returns them for the curl requests.
     *
     * @access public
     * @return array mime types formatted to the be correctly formed for an
     *         HTTP request
     */
    public function getMimes()
    {
        $mimes = [];
        foreach ($this->mimes as $mime => $buckets) {
            $intersection = array_intersect($this->acceptable, $buckets);
            if (in_array($mime, $this->acceptable)) {
                array_push($mimes, $mime);
            } elseif (!empty($intersection)) {
                $mimes = array_merge($mimes, (array)$mime);
            }
        }
        return array_unique($mimes);
    }

    /**
     * head
     *
     * Make a HEAD call to the passed in url.
     *
     * @notes  intrinsically, HEAD requests don't have a response, just the
     *         info from the server
     *         a HEAD request will still fail/return <false> if the mime
     *         type requirement isn't met
     * @access public
     * @param  string $url the url to run the HEAD call again
     * @return array
     */
    public function head($url)
    {
        /**
         * Accept all content (ignored by HEAD requests, just put in for
         * clarity); grab the resource
         */
        $this->setHeader('Accept', '*/*');
        $resource = $this->getResource($url, true);

        // make the HEAD call; store the info
        curl_exec($resource);
        $this->headInfo = curl_getinfo($resource);

        // error founded
        if (curl_errno($resource) !== '0') {
            $this->error = [
                'code' => curl_errno($resource),
                'message' => curl_error($resource)
            ];
        }

        // close the resource
        $this->close($resource);

        // return info (head-headers)
        return $this->headInfo;
    }

    /**
     * getResponse
     *
     * Grabs the previously stored response.
     *
     * @access public
     * @return String
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * post
     *
     * @access public
     * @param  String $url
     * @param array $data
     * @param  boolean $buildQuery (default: true)
     * @return array|false
     * @internal param Array $array
     */
    public function post($url, array $data = [], $buildQuery = true)
    {
        // execute HEAD call, and check if invalid
        $this->head($url);
        if (!$this->valid()) {
            /**
             * failed HEAD, so return <false> (info of the call and error
             * details still available through <$this->getInfo> and
             * <$this->getError>, respectively)
             */
            return false;
        }

        // mime type setting
        $this->setHeader('Accept', implode(',', $this->getMimes()));
        $resource = $this->getResource($url);

        // set post-specific details
        curl_setopt($resource, CURLOPT_POST, true);
        if ($buildQuery === true) {
            curl_setopt(
                $resource,
                CURLOPT_POSTFIELDS,
                http_build_query($data)
            );
        }
        curl_setopt($resource, CURLOPT_POSTFIELDS, $data);

        // make the GET call, storing the response; store the info
        $this->response = curl_exec($resource);
        $this->info = curl_getinfo($resource);

        // error founded
        if (curl_errno($resource) !== '0') {
            $this->error = [
                'code' => curl_errno($resource),
                'message' => curl_error($resource)
            ];
        }

        // close the resource
        $this->close($resource);

        // give the response back :)
        return $this->response;
    }

    /**
     * reset
     *
     * Resets the curler to _construct phase for further use.
     *
     * @access public
     * @return void
     */
    public function reset()
    {
        $this->__construct($this->death);
    }

    /**
     * setAuth
     *
     * @access public
     * @param  string $username
     * @param  string $password
     * @return void
     */
    public function setAuth($username, $password)
    {
        $this->auth = [
            'username' => $username,
            'password' => $password
        ];
    }

    /**
     * setCurlOptions
     *
     * Set curl options
     *
     * @access public
     * @param  array $options Associative array of curl options
     * @return void
     */
    public function setCurlOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $this->curlOptions[$option] = $value;
        }
    }

    /**
     * setHeader
     *
     * Sets a header for the request being made.
     *
     * @notes  note using <array_push> here since I want to be able to
     *         overwrite specific headers (eg. mime type options)
     * @access public
     * @param  string $name
     * @param  string $value
     * @return void
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * setHeaders
     *
     * Sets a group of headers at once, for the request.
     *
     * @access public
     * @param  array $headers
     * @return void
     */
    public function setHeaders(array $headers)
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }
    }

    /**
     * setLimit
     *
     * Sets the maximum number of kilobytes that can be downloaded/requested.
     * in a GET request
     *
     * @access public
     * @param  integer|float $kilobytes
     * @return void
     */
    public function setLimit($kilobytes)
    {
        $this->limit = $kilobytes;
    }

    /**
     * setMime
     *
     * Sets the acceptable mime's for content type to a specific one.
     *
     * @access public
     * @param  string $mime
     * @return void
     */
    public function setMime($mime)
    {
        $this->setMimes($mime);
    }

    /**
     * setMimes
     *
     * Stores which mime types can be accepted in the request.
     *
     * @notes  if false specified (such as setMime(false) or
     *         setMimes(false)), then no mimes are set as being allowed (eg.
     *         good for clearing out any previously set acceptable
     *         mime-types)
     * @access public
     * @return void
     */
    public function setMimes()
    {
        $args = func_get_args();
        $this->acceptable = [];
        if (!in_array(false, $args)) {
            $this->acceptable = $args;
        }
    }

    /**
     * setTimeout
     *
     * @access public
     * @param  string $seconds
     * @return void
     */
    public function setTimeout($seconds)
    {
        $this->timeout = $seconds;
    }

    /**
     * setUserAgent
     *
     * @access public
     * @param  string $str
     * @return void
     */
    public function setUserAgent($str)
    {
        $this->userAgent = $str;
        $this->setHeader('User-Agent', $str);
    }

    /**
     * Set path to file for curl to store cookies. File must be writable
     * @param string $cookie
     */
    public function setCookieFile($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * writeCallback
     *
     * @access public
     * @param  string $data
     * @return int
     * @throws Exception
     */
    public function writeCallback($data)
    {
        $this->dynamicResponse .= $data;
        $limit = $this->limit * 1024;
        if (strlen($this->dynamicResponse) > $limit) {
            throw new Exception('Exceeding size.');
        }
        return strlen($data);
    }
}

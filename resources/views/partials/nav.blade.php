<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Bitcoin Faucet Rotator</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if(Auth::guest())
                    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::addThisId())
                        <li class="addthis_sharing_toolbox" style="margin-top:0.5em;"></li>
                    @endif
                @endif
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Faucets <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/faucets">View Faucets</a></li>
                            <li><a href="/admin/faucets/create">Add New Faucet</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Payment Processors<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/payment_processors">View Payment Processors</a></li>
                            <li><a href="/admin/payment_processors/create">Add New Payment Processor</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/main_meta">Manage Main Meta</a>
                    </li>
                    <li>
                        <a href="/admin/twitter_config">Manage Twitter Config</a>
                    </li>
                    <li>
                        <a href="/admin/ad_block_config">Manage Ad Block</a>
                    </li>
                @else
                    <li><a href="/faucets">Faucets</a></li>
                    <li><a href="/payment_processors">Payment Processors</a></li>
                    @if(\App\Helpers\WebsiteMeta\WebsiteMeta::twitterUsername())
                        <li style="margin-top:0.70em;">
                            <a 
                                href="https://twitter.com/{{ \App\Helpers\WebsiteMeta\WebsiteMeta::twitterUsername() }}"
                                class="twitter-follow-button"
                                data-show-count="false"
                                data-size="large">Follow {{ "@" . \App\Helpers\WebsiteMeta\WebsiteMeta::twitterUsername() }}
                            </a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                        </li>
                     @endif
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/auth/login">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/admin/admin">Account Overview</a></li>
                            <li><a href="/auth/logout">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

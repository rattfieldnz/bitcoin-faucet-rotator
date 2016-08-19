<?php namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        //'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $viewLog = new Logger('View Logs');
        $viewLog->pushHandler(new StreamHandler(storage_path().'/logs/laravel.log', Logger::INFO));

        if ($e instanceof ModelNotFoundException) {
            Log::useFiles(storage_path() . '/logs/laravel.log');
            $viewLog->addInfo(
                'A 404 error (ModelNotFoundException) has been encountered, ' .
                'details are as follows:\n\n' . $e->getMessage()
            );
            Log::error('A 404 error (ModelNotFoundException) has been encountered, ' .
                'details are as follows:\n\n' . $e->getMessage());
            return response(view('errors.404'), 404);
        }
        if ($e instanceof ErrorException) {
            Log::useFiles(storage_path() . '/logs/laravel.log');
            $viewLog->addInfo(
                'A 500 error (ErrorException) has been encountered, ' .
                'details are as follows:\n\n' . $e->getMessage()
            );
            Log::error(
                'A 500 error (ErrorException) has been encountered, ' .
                'details are as follows:\n\n' . $e->getMessage()
            );
            return response(view('errors.404'), 404);

        }
        if ($e instanceof NotFoundHttpException) {
            Log::useFiles(storage_path() . '/logs/laravel.log');
            $viewLog->addInfo(
                'A 404 error (ErrorException) has been encountered, ' .
                'details are as follows:\n\n' . $e->getMessage()
            );
            Log::error(
                'A 404 error (ErrorException) has been encountered, ' .
                'details are as follows:\n\n' . $e->getMessage()
            );
            return response(view('errors.404'), 404);

        }

        return parent::render($request, $e);
    }
}

<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Mail\ExceptionOccured;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
		
	if ($this->shouldReport($exception)) {
        $this->sendEmail($exception); // sends an email
    }
		
		
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
		if(env('APP_DEBUG')==true){
		return parent::render($request, $exception);
		}else{		
        $response = [];
        $response['exception'] = get_class($exception);
        $response['status_code'] = $exception->getStatusCode();

         switch($response['status_code'])
        {
            case 403:
                $response['message'] = 'You are not authorized to view that page!';
                break;
            case 404:
                $response['message'] = 'Page Not Found';
                break;
            default:
                $response['message'] = 'Something went wrong!';
                break;
        }
	  
         return response()->view('errors.error', compact('response'));		
        }
		
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
	
	
	
	
	public function sendEmail(Exception $exception)
	{
    try {
        $e = FlattenException::create($exception);
        $handler = new SymfonyExceptionHandler();
        $html = $handler->getHtml($e);
        Mail::to('ihebsaad@gmail.com')->send(new ExceptionOccured($html));
    } catch (Exception $ex) {
        dd($ex);
    }
	
	
}
	
	
}

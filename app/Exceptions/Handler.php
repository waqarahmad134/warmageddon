<?php

namespace App\Exceptions;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable|\Exception  $exception
     * @return void
     */
    public function report($exception)
    {
        // Ignore deprecation warnings
        if ($exception instanceof \ErrorException && $exception->getSeverity() === E_USER_DEPRECATED) {
            return;
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable|\Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, $exception)
    {
        // Handle 404
        if ($exception instanceof NotFoundHttpException) {
            return redirect('error/404');
        }

        // Handle wrong HTTP method
        if ($exception instanceof MethodNotAllowedHttpException) {
            return redirect('/');
        }

        // Handle CSRF token mismatch
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        }

        // Handle Spatie Permission Unauthorized Exception
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            Toastr::error('Sorry! You do not have the right permission', 'Error');
            return redirect()->back();
        }

        return parent::render($request, $exception);
    }
}

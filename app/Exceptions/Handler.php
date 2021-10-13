<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    //  render an exception page
    public function render($request, Throwable $e)
    {

        // if requests expect json
        if ($request->expectsJson()) {
            // if model not found exception
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => 'Product not found'
                ], Response::HTTP_NOT_FOUND);
            }
            if($e instanceof AuthenticationException){
                return response()->json([
                    'error' => 'Unauthenticated'
                ], Response::HTTP_UNAUTHORIZED);
            }
            if($e instanceof NotFoundHttpException){
                return response()->json([
                    'error' => 'Incorrect route'
                ], Response::HTTP_NOT_FOUND);
            }
        }else{
            // if not ajax request
            if ($e instanceof ModelNotFoundException) {
                // return abort 404 response
                return abort(404);
            }
        }

        return parent::render($request, $e);
    }
}

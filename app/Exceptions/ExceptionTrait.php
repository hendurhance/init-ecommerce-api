<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


// create a new trait
trait ExceptionTrait
{
    // create a new method
    public function getJsonResponse($request, $e)
    {
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
    }
}
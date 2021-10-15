<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CategoryNotParent extends Exception
{
    //
    public function render($request)
    {
        // if response is json
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'The category is not a parent category.'
            ], Response::HTTP_FORBIDDEN);
        }
        return response()->json([
            'message' => 'Category is not parent',
            'status' => 'error'
        ], Response::HTTP_FORBIDDEN);
    }
}

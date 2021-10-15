<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class SubCategoryNotParentsChild extends Exception
{
    //

    public function render($request)
    {
        // if request is json
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'The subcategory is not a child of the parent category.'
            ], Response::HTTP_FORBIDDEN);
        }
        
        return response()->json([
            'message' => 'The subcategory is not a child of the parent category.t',
            'status' => 'error'
        ], Response::HTTP_FORBIDDEN);
    }
}

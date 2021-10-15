<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ParentCategoryNotExist extends Exception
{
    //
    public function render($request)
    {
        // if response is json
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'The parent category does not exist.'
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'message' => 'The parent category does not exist',
            'status' => 'error'
        ], Response::HTTP_NOT_FOUND);
    }
}

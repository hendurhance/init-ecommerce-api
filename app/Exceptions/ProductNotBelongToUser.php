<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ProductNotBelongToUser extends Exception
{
    //

    public function render() {
        // if response is json
        if (request()->wantsJson()) {
            return response()->json([
                'error' => 'Product does not belong to user'
            ], Response::HTTP_UNAUTHORIZED);
        }else{
            // abort unauthorized
            return abort(Response::HTTP_UNAUTHORIZED, 'Product does not belong to user');
        }
    }
}

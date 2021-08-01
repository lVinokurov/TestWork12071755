<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResponse;
use App\Http\Resources\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @param array|string|null $val
     * @param string|null $message
     * @param int $code
     * @return Response
     */
    public function errorResponse($val = null, $message = null, int $code = 200): Response
    {
        $arr = [];
        if ($val)
            $arr['errors'] = $val;
        if ($message)
            $arr['message'] = $message;

        return (new ErrorResponse($arr))->response()->setStatusCode($code);
    }

    /**
     * @param array|string|null $val
     * @param string|null $message
     * @param int $code
     * @return Response
     */
    public function dataResponse($val = null, $message = null, int $code = 200): Response
    {
        $arr = [];
        if ($val)
            $arr['data'] = $val;
        if ($message)
            $arr['message'] = $message;

        return (new DataResponse($arr))->response()->setStatusCode($code);
    }
}

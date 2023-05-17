<?php

namespace App\Http\Responses;

use App\Http\Requests\MainRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

final class MainResponse
{
    public static function response(MainRequest $request, array|string $data, int $httpCode = Response::HTTP_OK): Response | Redirector | RedirectResponse
    {
        if ($request->header('is-api') === 'True') {
            return response($data, $httpCode);
        } else {
            return redirect($request->getLastSegment(1))->with($data);
        }
    }
}

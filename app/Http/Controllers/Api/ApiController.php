<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;

    public function __construct(Request $request)
    {
        if (!$request->expectsJson() && !app()->runningInConsole()) {
            abort(403);
        }

        $this->user = $this->getUserByToken();
    }

    public function getToken()
    {
        return request()->bearerToken() ?: request('api_token');
    }

    public function getUserByToken()
    {
        $token = $this->getToken();
        if (!$token) {
            abort(401);
        }

        $user = User::where('api_token', $token)->first();
        if (!$user) {
            abort(401);
        }

        return $user;
    }
}

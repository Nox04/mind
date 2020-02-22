<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * Create a controller instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Login method.
     * @param RegisterRequest $request
     * @return AuthResource
     */
    public function register(RegisterRequest $request)
    {
        return new AuthResource($this->user->register($request->validated()));
    }
}

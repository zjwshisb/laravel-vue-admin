<?php
namespace App\Auth;

use Illuminate\Auth\TokenGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class AdminGuard extends TokenGuard{

    public function __construct(UserProvider $provider, Request $request, $inputKey = 'auth_token', $storageKey = 'auth_token', $hash = false)
    {
        parent::__construct($provider, $request, $inputKey, $storageKey, $hash);
    }
}

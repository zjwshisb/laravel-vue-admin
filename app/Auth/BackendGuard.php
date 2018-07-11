<?php
namespace App\Auth;

use Illuminate\Auth\TokenGuard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\UserProvider;
class BackendGuard extends TokenGuard {

    public function __construct(UserProvider $provider, Request $request, $inputKey = 'api_token', $storageKey = 'api_token')
    {
       parent::__construct($provider,$request,$inputKey,$storageKey);
    }

    public function user()
    {
        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (! is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $token = $this->getTokenForRequest();

        if (! empty($token)) {
            $user = $this->provider->retrieveByCredentials(
                [$this->storageKey => $token]
            );
        }

        return $this->user = $user;
    }
}
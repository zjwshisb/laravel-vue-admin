<?php
namespace App\Auth;

use Illuminate\Auth\TokenGuard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\UserProvider;
class BackendGuard extends TokenGuard {

    protected $expireKey = 'expire_time';

    protected $maintainTime = 30 * 60;

    /**
     * BackendGuard constructor.
     * @param UserProvider $provider
     * @param Request $request
     * @param string $inputKey
     * @param string $storageKey
     */
    public function __construct(UserProvider $provider, Request $request, $inputKey = 'api_token', $storageKey = 'api_token')
    {
       parent::__construct($provider,$request,$inputKey,$storageKey);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (! is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        $token = $this->getTokenForRequest();
        if (! empty($token)) {
            $user = $this->provider->retrieveByCredentials(
                // 登陆的查询条件
                [
                    [$this->storageKey,'=', $token],
                    [$this->expireKey,'>',date("Y-m-d H:i:s")]
                ]
            );
            // token 延期
            if($user){
                $expireKey = $this->expireKey;
                $user->$expireKey = date("Y-m-d H:i:s",time() + $this->maintainTime);
                $user->save();
            }
        }
        return $this->user = $user;
    }
}
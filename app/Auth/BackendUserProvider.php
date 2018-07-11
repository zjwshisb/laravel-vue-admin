<?php
namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;

/**
 * Class BackendUserProvider
 * @package App\Auth
 * 后台登陆 auth provider
 */
class BackendUserProvider extends EloquentUserProvider{

    public function retrieveByCredentials(array $credentials)
    {
        if( sizeof($credentials) <=0) return ;

        $query = $this->createModel()->newQuery()->where($credentials);

        return $query->first();
    }
}
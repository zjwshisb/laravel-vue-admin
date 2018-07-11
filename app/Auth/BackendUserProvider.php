<?php
namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;


class BackendUserProvider extends EloquentUserProvider{

    public function retrieveByCredentials(array $credentials)
    {
        if( sizeof($credentials) <=0) return ;
        $query = $this->createModel()->newQuery()->where($credentials);
        return $query->first();
    }
}
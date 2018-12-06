<?php
namespace App\Http\Controllers\Backend;

use App\Http\Resources\Backend\MeResource;
use Illuminate\Support\Facades\Auth;

/**
 * Class MeController
 * @package App\Http\Controllers\Backend
 * @author zjw
 */
class MeController extends BackendController{

    public function index(){
        return new MeResource(Auth::user());
    }
}

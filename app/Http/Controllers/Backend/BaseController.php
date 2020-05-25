<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\Fail;
use App\Traits\Success;

class BaseController extends Controller {
    use Success, Fail;
}

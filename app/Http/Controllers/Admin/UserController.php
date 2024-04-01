<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    private $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }


    public function index(){
        return $this->userService->index();
    }

}

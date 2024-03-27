<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use App\Http\Services\AboutService;
use App\Http\Controllers\Controller;


class AboutController extends Controller
{
    //
    private $aboutService;

    public function __construct(AboutService $aboutService){
        $this->aboutService = $aboutService;
    }

    public function index(){
        return $this->aboutService->index();

    }

    public function updateOrAddAbout(AboutRequest $request){
        if($request->_id){
            return $this->aboutService->update($request);
        }else{
            return $this->aboutService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->aboutService->delete($request);
    }

}

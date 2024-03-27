<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterRequest;
use App\Http\Services\FooterService;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    //
    private $footerService;


    public function __construct(FooterService $footerService){
        $this-> footerService = $footerService;
    }

      // For Store Footer
    public function index(){
        return $this->footerService->index();
    }

    // For Store Footer
    public function updateOrAddFooter(FooterRequest $request){
        if($request->_id){
            return $this->footerService->update($request);
        }else{
            return $this->footerService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->footerService->delete($request);
    }

}

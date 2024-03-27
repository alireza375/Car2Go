<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HeaderRequest;
use App\Http\Services\HeaderService;

class HeaderController extends Controller
{
    //
    private $headerService;

    public function __construct(HeaderService $headerService){
        $this->headerService = $headerService;
    }

    // For Index
    public function index(){
        return $this->headerService->index();
    }

    // For Update and Storeu
    public function updateOrAddHeader(HeaderRequest $request){
        if($request->_id){
            return $this->headerService->update($request);
        }else{
            return $this->headerService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->headerService->delete($request);
    }

}

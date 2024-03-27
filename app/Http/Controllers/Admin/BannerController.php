<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Http\Services\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    private $bannerService;

    public function __construct(BannerService $bannerService){
        $this->bannerService = $bannerService;
    }

    public function index(){
        return $this->bannerService->index();
    }

    public function updateOrAddBanner(BannerRequest $request){
        if($request->_id){
            return $this->bannerService->update($request);
        }else{
            return $this->bannerService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->bannerService->delete($request);
    }

}

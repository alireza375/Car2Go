<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DownloadRequest;
use App\Http\Services\DownloadService;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    //
    private $downloadService;

    public function __construct(DownloadService $downloadService){
        $this->downloadService = $downloadService;
    }

    public function index(){
        return $this->downloadService->index();
    }

    public function updateOrAddDownload(DownloadRequest $request){
        if($request->_id){
            return $this->downloadService->update($request);
        }else{
            return $this->downloadService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->downloadService->delete($request);

    }
}

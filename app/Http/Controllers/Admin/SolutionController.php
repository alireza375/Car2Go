<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SolutionRequest;
use App\Http\Services\SolutionService;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    //
    private $solutionService;

    public function __construct(SolutionService $solutionService){
        $this->solutionService = $solutionService;
    }


    public function index(){
        return $this->solutionService->index();
    }

    // For Update and Store
    public function updateOrAddSolution(SolutionRequest $request){
        if($request->_id){
            return $this->solutionService->update($request);
        }else{
            return $this->solutionService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->solutionService->delete($request);
    }

}

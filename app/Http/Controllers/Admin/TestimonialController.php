<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Http\Services\TestimonialService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    //
    private $testimonialService;

    public function __construct(TestimonialService $testimonialService){
        $this->testimonialService = $testimonialService;
    }

    public function index(){
        return $this->testimonialService->index();
    }

    public function updateOrAddTestimonial(TestimonialRequest $request){
        if($request->_id){
            return $this->testimonialService->update($request);
        }else{
            return $this->testimonialService->store($request);
        }
    }

    public function delete(Request $request){
        return $this->testimonialService->delete($request);
    }

}

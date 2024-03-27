<?php

namespace App\Http\Services;

use Exception;
use App\Models\Solution;

class SolutionService
{
    public function makeData($request)
    {

        $ImageName = null;
        if($request->hasFile("image")){
            $image = $request->file("image");
            $ImageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("solution_image"), $ImageName);
           }
        $data = [
            'image' => $ImageName,
            'short_description' => $request->input('short_description'),
            'title' => $request->input('title'),
        ];

        return $data;
    }

    public function index(){
        $data = Solution::select('id as _id', 'image', 'title', 'short_description', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('Solution fetched successfully.'), $data);
    }


    // For Store
    public function store($request){
        try {
            $data = $this->makeData($request);
            $solution = Solution::create($data);
            $response = [
                'title' => $solution->title,
                'short_description' => $solution->short_description,
                'image' => $solution->image,
                'createdAt' => $solution->created_at,
                'updatedAt' => $solution->updated_at,
            ];
            return successResponse(__('Solution Created Successfully'), $response);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
       return true;
    }


     // For Update
     public function update($request){
        $data=$this->makeData($request);
        $solution=Solution::find($request->_id);
        if(!$solution){
            return errorResponse(__("Solution Not Found"));
        }
        try{
            $solution->update($data);
            return successResponse(__("Solution Update Successfully"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }
     }


     //delete
     public function delete($request){
        $solution=Solution::find($request->_id);
        if (!$solution) {
            return errorResponse(__('Solution not found.'));
        }
        $solution->delete();
        return successResponse(__('Solution deleted successfully.'));
    }



}

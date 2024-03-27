<?php

namespace App\Http\Services;

use App\Models\Testimonial;
use Exception;

class TestimonialService
{
    public function makeData($request)
    {
        // For image
        $imageName = null;
        if($request->hasFile("image")){
            $image = $request->file("image");
            $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Testimonial_images"), $imageName);
           }
        $data = [
            'image' => $imageName,
            'name' => $request->input('name'),
            'occupation' => $request->input('occupation'),
            'comment' => $request->input('comment'),
        ];

        return $data;
    }

    public function index(){
        $data = Testimonial::select('id as _id', 'image', 'name', 'occupation', 'comment', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('Testimonial fetched successfully.'), $data);

    }


    // For Store About
    public function store($request){
        try {
            $data = $this->makeData($request);
            $contact = Testimonial::create($data);
            $data = [
                'image' => $contact->image,
                'name' => $contact->name,
                'occupation' => $contact->occupation,
                'comment' => $contact->comment,
                'createdAt' => $contact->created_at,
                'updatedAt' => $contact->updated_at,
            ];
            return successResponse(__('Testimonial Created Successfully'), $data);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
       return true;
    }


     // For Update
     public function update($request){
        $data=$this->makeData($request);
        $testimonial = Testimonial::find($request->_id);
        if (!$testimonial) {
            return errorResponse(__('Testimonila not found.'));
        }
        try{
            $testimonial->update($data);
            return successResponse(__("Testimonial Update Successful"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }
     }


     //delete
     public function delete($request){
        $testimonial = Testimonial::find($request->_id);
        if (!$testimonial) {
            return errorResponse(__('Testmonial not found.'));
        }
        $testimonial->delete();
        return successResponse(__('Testmonial deleted successfully.'));
    }
}





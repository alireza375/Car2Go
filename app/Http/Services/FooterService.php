<?php

namespace App\Http\Services;

use Exception;
use App\Models\Footer;

class FooterService
{
    public function makeData($request)
    {
        $logoName = null;
        if($request->hasFile("logo")){
            $logo = $request->file("logo");
            $logoName = 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
            $logo->move(public_path("Footer_logos"), $logoName);
           }
        $data = [
            'logo' => $logoName,
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'button' => $request->input('button'),
            'quicklink' => $request->input('quicklink'),
            'follow' => $request->input('follow'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        return $data;
    }

    public function index(){
        $data = Footer::select('id as _id', 'logo', 'quicklink', 'follow', 'title', 'short_description', 'button', 'email', 'phone', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('Footer fetched successfully.'), $data);

    }

    // For Store About
    public function store($request){
        try {
            $data = $this->makeData($request);
            $footer = Footer::create($data);
            $data = [
                'logo' => $footer->logo,
                'title' => $footer->title,
                'short_description' => $footer->short_description,
                'button' => $footer->button,
                'quicklink' => $footer->quicklink,
                'follow' => $footer->follow,
                'email' => $footer->email,
                'phone' => $footer->phone,
                'createdAt' => $footer->created_at,
                'updatedAt' => $footer->updated_at,
            ];
            return successResponse(__('Footer Created Successfully'), $data);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }

       return true;

    }


     // For Update
     public function update($request){
        $data=$this->makeData($request);
        $footer=Footer::find($request->_id);
        if(!$footer){
            return errorResponse(__("Footer Not Found"));
        }
        try{
            $footer->update($data);
            return successResponse(__("Footer Update Successfully"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }
     }

     //delete
     public function delete($request){
        $footer = Footer::find($request->_id);
        if (!$footer) {
            return errorResponse(__('Footer not found.'));
        }
        $footer->delete();
        return successResponse(__('Footer deleted successfully.'));
    }

    
}




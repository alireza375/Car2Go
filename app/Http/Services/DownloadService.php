<?php

namespace App\Http\Services;

use Exception;
use App\Models\Download;

class DownloadService
{
    public function makeData($request)
    {
        // For Logo
        $Fst_image = null;
        if($request->hasFile("image1")){
            $image = $request->file("image1");
            $Fst_image = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Download"), $Fst_image);
           }
        // For second Image
        $Sec_image = null;
        if($request->hasFile("image2")){
            $image = $request->file("image2");
            $Sec_image = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Download"), $Sec_image);
            }

        $data = [
            'image1' => $Fst_image,
            'image2' => $Sec_image,
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'button' => $request->input('button'),
        ];

        return $data;
    }

    public function index(){
        $data = Download::select('id as _id', 'image1','image2','title', 'short_description', 'button', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('Download fetched successfully.'), $data);

    }


    // For Store About
    public function store($request){
        try {
            $data = $this->makeData($request);
            $about = Download::create($data);
            $data = [
                'image1' => $about->image1,
                'image2' => $about->image2,
                'title' => $about->title,
                'short_description' => $about->short_description,
                'button' => $about->button,
                'createdAt' => $about->created_at,
                'updatedAt' => $about->updated_at,
            ];
            return successResponse(__('App Download Section Created Successfully'), $data);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }

        return true;

    }

     // For Update
     public function update($request){
        $data=$this->makeData($request);
        $download=Download::find($request->_id);
        if(!$download){
            return errorResponse(__("Download Not Found"));
        }
        try{
            $download->update($data);
            return successResponse(__("Download Update Successfully"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }

     }

     //delete
     public function delete($request){
        $download = Download::find($request->_id);
        if (!$download) {
            return errorResponse(__('Download Section not found.'));
        }
        $download->delete();
        return successResponse(__('Download Section deleted successfully.'));
     }


}

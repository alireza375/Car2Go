<?php

namespace App\Http\Services;

use Exception;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerService
{
    public function makeData($request)
    {
        // For First Image
        $Fst_image = null;
        if($request->hasFile("image1")){
            $image = $request->file("image1");
            $Fst_image = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Banner"), $Fst_image);
           }
        // For second Image
        $Sec_image = null;
        if($request->hasFile("image2")){
            $image = $request->file("image2");
            $Sec_image = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Banner"), $Sec_image);
            }
        // For Third Image
        $Trd_image = null;
        if($request->hasFile("image3")){
            $image = $request->file("image3");
            $Trd_image = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Banner"), $Trd_image);
            }
        $data = [
            'image1' => $Fst_image,
            'image2' => $Sec_image,
            'image3' => $Trd_image,
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'button' => $request->input('button'),
        ];

        return $data;
    }

    // For Banner List
    public function index(){
        $data = Banner::select('id as _id', 'image1', 'image2', 'image3', 'title', 'short_description', 'button', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('Banner fetched successfully.'), $data);

    }

    // For Store Banner
    public function store($request){
        try {
            $data = $this->makeData($request);
            $banner = Banner::create($data);
            $data = [
                'image1' => $banner->image1,
                'image2' => $banner->image2,
                'image3' => $banner->image3,
                'title' => $banner->title,
                'short_description' => $banner->short_description,
                'button' => $banner->button,
                'createdAt' => $banner->created_at,
                'updatedAt' => $banner->updated_at,
            ];
            return successResponse(__('Banner Created Successfully'), $data);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }

       return true;

    }


     // For Update
     public function update(Request $request){
        $data=$this->makeData($request);
        $banner=Banner::find($request->_id);
        if(!$banner){
            return errorResponse(__("Banner Not Found"));
        }
        try{
            $banner->update($data);
            return successResponse(__("Banner Update Successfully"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }

     }

     //delete
     public function delete($request){
        $banner = Banner::find($request->_id);
        if (!$banner) {
            return errorResponse(__('Banner not found.'));
        }
        $banner->delete();
        return successResponse(__('Banner deleted successfully.'));
    }

}

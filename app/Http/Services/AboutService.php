<?php

namespace App\Http\Services;

use Exception;
use App\Models\About;
use Illuminate\Http\Request;

class AboutService
{
    public function makeData($request)
    {
        // For Logo
        $logoName = null;
        if($request->hasFile("logo")){
            $logo = $request->file("logo");
            $logoName = 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
            $logo->move(public_path("About_logos"), $logoName);
           }
        $data = [
            'logo' => $logoName,
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
        ];

        return $data;
    }

    // For About List
    public function index(){
        $data = About::select('id as _id', 'logo','title', 'short_description', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('About fetched successfully.'), $data);

    }


        // For Store About
        public function store($request){
            try {
                $data = $this->makeData($request);
                $about = About::create($data);
                $data = [
                    'logo' => $about->logo,
                    'title' => $about->title,
                    'short_description' => $about->short_description,
                    'createdAt' => $about->created_at,
                    'updatedAt' => $about->updated_at,
                ];
                return successResponse(__('About Created Successfully'), $data);
            } catch (\Exception $e) {
                return errorResponse($e->getMessage());
            }

           return true;

        }

        // For Update
        public function update(Request $request){
            $data=$this->makeData($request);
            $about=About::find($request->_id);
            if(!$about){
                return errorResponse(__("about Not Found"));
            }
            try{
                $about->update($data);
                return successResponse(__("about Update Successfully"),$data);
            }
            catch(Exception $e){
                return errorResponse($e->getMessage());
            }

         }

        //delete
        public function delete($request){
            $about = About::find($request->_id);
            if (!$about) {
                return errorResponse(__('About not found.'));
            }
            $about->delete();
            return successResponse(__('About deleted successfully.'));
        }


}

<?php

namespace App\Http\Services;

use App\Http\Resources\HeaderResource;
use App\Models\Header;
use Exception;

class HeaderService
{
    public function makeData($request)
    {

        $logoName = null;
        if($request->hasFile("logo")){
            $logo = $request->file("logo");
            $logoName = 'post_image_'.md5(('uniqid')). time() .".". $logo->getClientOriginalExtension();
            $logo->move(public_path("logos"), $logoName);
           }
        $data = [
            'logo' => $logoName,
            'navber' => json_encode($request->navber),
            'link' => $request->input('link'),
        ];

        return $data;
    }

    // For Index Data
    public function index(){
        // select( 'logo','navber','link')->get();
        $data = Header::get();
        $data = HeaderResource::collection($data);
        return successResponse(__('Data fetched successfully.'), $data);

    }


    // For Store
    public function store($request){
        try {
            $data = $this->makeData($request);
            $header = Header::create($data);
            $data = [
                'link' => $header->link,
                'navber' => $header->navber,
                'logo' => $header->logo,
                'createdAt' => $header->created_at,
                'updatedAt' => $header->updated_at,
            ];
            return successResponse(__('Header Created Successfully'), $data);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }
       return true;
    }


     // For Update
     public function update($request){
        $data=$this->makeData($request);
        $header=Header::find($request->_id);
        if(!$header){
            return errorResponse(__("Header Not Found"));
        }
        try{
            $header->update($data);
            return successResponse(__("Header Update Successfully"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }
     }

     //delete
     public function delete($request){
        $header = Header::find($request->_id);
        if (!$header) {
            return errorResponse(__('Header not found.'));
        }
        $header->delete();
        return successResponse(__('Header deleted successfully.'));
    }



}

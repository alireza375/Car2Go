<?php

namespace App\Http\Services;

use Exception;
use App\Models\Contact;

class ContactService
{
    public function makeData($request)
    {
        // For image
        $imageName = null;
        if($request->hasFile("image")){
            $image = $request->file("image");
            $imageName = 'post_image_'.md5(('uniqid')). time() .".". $image->getClientOriginalExtension();
            $image->move(public_path("Contact_images"), $imageName);
           }
        $data = [
            'image' => $imageName,
            'title' => $request->input('title'),
            'short_description' => $request->input('short_description'),
            'link' => $request->input('link'),
        ];

        return $data;
    }

    // For Contact List
    public function index(){
        $data = Contact::select('id as _id', 'image','title', 'short_description', 'link', 'created_at as createdAt', 'updated_at as updatedAt')->get();
        return successResponse(__('Contact fetched successfully.'), $data);

    }


    // For Store Contact
    public function store($request){
        try {
            $data = $this->makeData($request);
            $contact = Contact::create($data);
            $data = [
                'image' => $contact->image,
                'title' => $contact->title,
                'short_description' => $contact->short_description,
                'link' => $contact->link,
                'createdAt' => $contact->created_at,
                'updatedAt' => $contact->updated_at,
            ];
            return successResponse(__('Contact Created Successfully'), $data);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage());
        }

       return true;

    }

     // For Update
     public function update($request){
        $data=$this->makeData($request);
        $contact=Contact::find($request->_id);
        if(!$contact){
            return errorResponse(__("Contact Not Found"));
        }
        try{
            $contact->update($data);
            return successResponse(__("Contact Update Successfully"),$data);
        }
        catch(Exception $e){
            return errorResponse($e->getMessage());
        }
     }

     //delete
     public function delete($request){
        $contact = Contact::find($request->_id);
        if (!$contact) {
            return errorResponse(__('Contact not found.'));
        }
        $contact->delete();
        return successResponse(__('Contact deleted successfully.'));
     }



}

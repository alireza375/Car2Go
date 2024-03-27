<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AboutRequest;
use App\Http\Services\AboutService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Services\ContactService;

class ContactController extends Controller
{
    //
    private $contactService;

    public function __construct(ContactService $contactService){
        $this->contactService = $contactService;
    }

    public function index(){
        return $this->contactService->index();
    }

    public function updateOrAddContact(ContactRequest $request){
        if($request->_id){
            return $this->contactService->update($request);
        }else{
            return $this->contactService->store($request);
        }
    }

    //delete
    public function delete(Request $request){
        return $this->contactService->delete($request);
    }
}

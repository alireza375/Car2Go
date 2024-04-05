<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Http\Services\Admin\PageService;

class PageController extends Controller
{
    //
    private $pageService;

    public function __construct(PageService $pageService){
        $this->pageService = $pageService;
    }

    public function List(){
        // $data = Page::select('id', 'title', 'slug', 'content', 'content_type', 'enable')->get();
        $data = Page::get();
        return successResponse("Page list", PageResource::collection($data));    }


    public function Page(PageRequest $request){
        if(!empty($request->_id)){
            return $this->pageService->Udpate($request);
        }else{
            return $this->pageService->Store($request);
        }
    }


    public function GetPage(Request $request){
        $slug = $request->input('slug');
        // return $this->pageService->getPage($slug);

        $page = Page::where('slug', $slug)->first();
        if($page){
            return successResponse("Page Fatched Successfully", new PageResource($page));
        } else{
            return errorResponse("'{$slug}' doesn't exiest", 404);
        }
    }


    public function Delete(Request $request){
        $slug = $request->input('slug');
        $page = Page::where('slug', $slug)->first();

        if($page){
            $page->Delete();
            return successResponse("Page Delete Successfully.");
        } else {
            return errorResponse("'{$slug}' doesn't exiest.");
        }
    }
}

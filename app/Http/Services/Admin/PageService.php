<?php

namespace App\Http\Services\Admin;

use App\Http\Resources\PageResource;
use Exception;
use App\Models\Page;
use Illuminate\Support\Str;

class PageService
{
    private function makeData($request)
    {
        return [
            'title'        => $request->input('title'),
            'slug'         => $request->input('slug'),
            'content'      => $request->input('content'),
            'content_type' => $request->input('content_type'),
        ];
    }


    public function Store($request){
        $slug = Str::slug($request->input('slug'));
        $existingPage = Page::where('slug', $slug)->exists();

        if($existingPage){
            return errorResponse("Page Already Exist");
        }
        $content = json_encode($request->input('content'));
        $data = array_merge($this->makeData($request), ['slug' => $slug, 'content' => $content]);

        try{
            $page = Page::create($data);
            return successResponse("Page Successfully Create");

        } catch( Exception $e){
            return errorResponse($e->getMessage());
        }

    }



    public function Udpate($request){
        $page = Page::where(['id' => $request->_id])->first();

        if(!empty($page)){
            $data = $this->makeData($request);

            $content = json_encode($request->input('content'));
            $data['content'] = $content;
            try{
                $page -> update($data);
                return successResponse('Page Successfully Update');
            }catch(Exception $e){
                return errorResponse($e->getMessage());
            }
        }
    }


}

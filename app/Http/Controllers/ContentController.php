<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();
        return view('contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contentTypes = \App\ContentType::all();
        return view('contents.create', compact('contentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # Todo validate start and end date
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'type' => ['required', 'Integer'],
           # 'start' => ['date_format:d/m/Y'],
           # 'end' => ['Date']
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->description = $request->description;
        $content->type = $request->type;
        $content->status = false;

        if(!empty($request->start)) {
            $content->start = $request->start;
        }

        if(!empty($request->end)) {
            $content->end = $request->end;
        }

        $content->save();

        return redirect('/contents');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        $pages = \App\Page::all();
        $contentTypes = \App\ContentType::all();
        return view('contents.edit', compact('content', 'contentTypes', 'pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $pages = \App\Page::all();
        $contentTypes = \App\ContentType::all();
        return view('contents.edit', compact('content', 'contentTypes', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {


        # Todo validate start and end date
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'type' => ['required', 'Integer'],
            'status' => ['Boolean', 'Nullable'],
           # 'start' => ['date_format:d/m/Y'],
           # 'end' => ['Date']
           'pages.*'  => ['required', 'string', 'distinct']
        ]);

        $content->title = $request->title;
        $content->description = $request->description;
        $content->status = boolval($request->status);

        if(!empty($request->start)) {
            $content->start = $request->start;
        }

        if(!empty($request->end)) {
            $content->end = $request->end;
        }

        $content->save();

        /* todo use syncs
        if(is_array($request->pages)) {
            foreach($request->pages as $page) {
                $contentPage = new \App\ContentPage();
                $contentPage->content_id = $content->id;
                $contentPage->page_id = $page;
                $contentPage->save();
            }
        }*/

        return redirect('/contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }
}

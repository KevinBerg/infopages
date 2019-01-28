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
        $contentTypes = \App\ContentType::all();
        return view('contents.index', compact('contents', 'contentTypes'));
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
        request()->validate([
            'title' => ['required', 'min:3', 'unique:contents,title'],
            'description' => 'required',
            'type' => ['required', 'Integer'],
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->description = $request->description;
        $content->type = $request->type;
        $content->status = false;

        $content->save();

        if(isset($content->id)) {
            return redirect('/contents/'.$content->id);
        }

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
        $contentTypeTitle = $this->getContentTypeTitle($content);
        return view('contents.'.$contentTypeTitle.'_edit', compact('content', 'contentTypeTitle', 'pages'));
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
        $contentTypeTitle = $this->getContentTypeTitle($content);
        return view('contents.'.$contentTypeTitle.'_edit', compact('content', 'contentTypeTitle', 'pages'));
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
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'duration' => ['required', 'Integer', 'min:30'],
            'status' => ['Boolean', 'Nullable'],
            'text' => ['String'],
            'runtime' => ['required', 'Integer', 'min:1'],
            'pages.*'  => ['required', 'Integer'],
            'priority' => ['required', 'Integer', 'min:1', 'max:3']
        ]);

        $content->title = $request->title;
        $content->description = $request->description;
        $content->status = boolval($request->status);
        $content->duration = $request->duration;
        $content->runtime = $request->runtime;
        $content->priority = $request->priority;

        if(!empty($request->text)) {
            $content->text = $request->text;
        }

        $content->pages()->sync($request->pages);
        $content->save();

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
        $content->delete();
        return redirect('/contents');
    }

    private function getContentTypeTitle(Content $content) {

        $contentTypeTitle = false;

        if(isset($content->type)) {
            $contentType = \App\ContentType::find($content->type);
            if($contentType) {
                $contentTypeTitle = $contentType->title;
            }
        }

        return $contentTypeTitle;
    }
}

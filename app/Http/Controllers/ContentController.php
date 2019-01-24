<?php

namespace Infopages\Http\Controllers;

use Infopages\Content;
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
        $contentTypes = \Infopages\ContentType::all();
        return view('contents.index', compact('contents', 'contentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contentTypes = \Infopages\ContentType::all();
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
            'duration' => ['required', 'Integer', 'min:30'],
            'text' => ['String'],
           # 'start' => ['date_format:d/m/Y'],
           # 'end' => ['Date']
        ]);

        $content = new Content();
        $content->title = $request->title;
        $content->description = $request->description;
        $content->type = $request->type;
        $content->status = false;
        $content->duration = $request->duration;

        if(!empty($request->text)) {
            $content->text = $request->text;
        }

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
     * @param  \Infopages\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        $pages = \Infopages\Page::all();
        $contentTypes = \Infopages\ContentType::all();
        return view('contents.edit', compact('content', 'contentTypes', 'pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Infopages\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $pages = \Infopages\Page::all();
        $contentTypes = \Infopages\ContentType::all();
        return view('contents.edit', compact('content', 'contentTypes', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Infopages\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        # Todo validate start and end date
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'type' => ['required', 'Integer'],
            'duration' => ['required', 'Integer', 'min:30'],
            'status' => ['Boolean', 'Nullable'],
            'text' => ['String'],
            # 'start' => ['date_format:d/m/Y'],
            # 'end' => ['Date']
           'pages.*'  => ['required', 'Integer']
        ]);

        $content->title = $request->title;
        $content->description = $request->description;
        $content->status = boolval($request->status);
        $content->duration = $request->duration;
        $content->type = $request->type;

        if(!empty($request->text)) {
            $content->text = $request->text;
        }

        if(!empty($request->start)) {
            $content->start = $request->start;
        }

        if(!empty($request->end)) {
            $content->end = $request->end;
        }

        $content->pages()->sync($request->pages);
        $content->save();

        return redirect('/contents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Infopages\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();
        return redirect('/contents');
    }
}

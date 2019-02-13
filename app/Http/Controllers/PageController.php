<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = \App\Page::all();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( ! $request->user()->hasPermissionTo('edit pages')) {
            abort(403);
        }

        request()->validate([
            'title' => ['required', 'min:3', 'alpha'],
            'description' => 'required'
        ]);

        $page = new Page();
        $page->title = $request->title;
        $page->description = $request->description;
        $page->save();

        return redirect('/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Page $page)
    {
        if( ! $request->user()->hasPermissionTo('edit pages')) {
            abort(403);
        }

        $contentTypes = \App\ContentType::all(); # used to render related content types.
        return view('pages.edit', compact('page', 'contentTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Page $page)
    {
        if( ! $request->user()->hasPermissionTo('edit pages')) {
            abort(403);
        }

        $contentTypes = \App\ContentType::all(); # used to render related content types.
        return view('pages.edit', compact('page', 'contentTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        if( ! $request->user()->hasPermissionTo('edit pages')) {
            abort(403);
        }

        request()->validate([
            'description' => 'required'
        ]);

        $page->description = $request->description;
        $page->save();

        return redirect('/pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Page $page)
    {
        if( ! $request->user()->hasPermissionTo('edit pages')) {
            abort(403);
        }

        $page->delete();
        return redirect('/pages');
    }
}

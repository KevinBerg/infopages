<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    /**
     * Returns urls to rendered html pages.
     */
    public function urls() {

        $urls = array();

        $pages = Page::all();
        foreach($pages as $page) {
            $urls[] = url('/render/'.$page->title);
        }

        return $urls;
    }
}

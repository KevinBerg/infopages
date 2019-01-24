<?php

namespace Infopages\Http\Controllers;

use Infopages\Page;
use Illuminate\Http\Request;

class RenderController extends Controller
{
    /**
     * Creates the final view (rendered Page with contents)
     * @param $pageTitle the title of the page object.
     */
    public function render(String $pageTitle) {

        if(ctype_alnum($pageTitle)) {
            $page = \Infopages\Page::where('title', $pageTitle)->first();
            if($page) {
                $contents = $page->contents;
                if($contents) {
                    # Todo use contents queue
                    foreach($contents as $content) {
                        return view('templates.text', compact('content'));
                    }
                }
            }
        }

        abort(404);

    }
}

<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class RenderController extends Controller
{
    /**
     * Creates the final view (rendered Page with contents)
     * @param $pageTitle the title of the page object.
     */
    public function render(String $pageTitle) {

        # just accept alphanumeric strings for page titles.
        if(ctype_alnum($pageTitle)) {

            $page = \App\Page::where('title', $pageTitle)->first();

            if($page) {

                # get the page contents from the content_pages table.
                $contents = $page->contents;

                if($contents) {

                    # filter active contents.
                    $contents = $contents->where('status', 1);

                    # try to find a existing entry in the RenderedPageContent table for this page.
                    $renderedPageContent = \App\RenderedPageContent::where('page_id', $page->id)->first();

                    if($renderedPageContent) {

                        # remember the last rendered content.
                        $lastContentId = $renderedPageContent->content_id;

                        # try to find a content with an higher id than the last rendered content,
                        $content = $contents->where('id', '>', $lastContentId)->sortBy('id')->take(1)->first();

                        if(!$content) {
                            # there is no higher content id to render. Take the lowest id content.
                            $content = $contents->sortBy('id')->take(1)->first();
                        }

                    } else {

                        # there is no entry in the RenderedPageContent table for this page id.
                        # create one and show the first content.
                        $content = $contents->first();
                        $renderedPageContent = new \App\RenderedPageContent();
                        $renderedPageContent->page_id = $page->id;
                        $renderedPageContent->created_at = now();

                    }

                    $renderedPageContent->content_id = $content->id;
                    $renderedPageContent->updated_at = now();
                    $renderedPageContent->save();

                    $template = \App\ContentType::find($content->type)->first();

                    if($template) {
                        return view('templates.'.$template->title, compact('content'));
                    } else {
                        abort(403, 'Sorry, I have no template for this page.');
                    }

                } else {
                    abort(403, 'Sorry, I have no contents for this page.');
                }

            } else {
                abort(403, 'Sorry, I have no page with this title.');
            }

        } else {
            abort(404);
        }
    }
}

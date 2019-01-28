<?php

namespace App\Http\Controllers;

use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RenderController extends Controller
{
    /**
     * Creates the final view (rendered Page with contents)
     * @param $pageTitle the title of the page object.
     */
    public function render(String $pageTitle) {

        # ToDo use content priority!!

        # just accept alphanumeric strings for page titles.
        if(ctype_alnum($pageTitle)) {

            $page = \App\Page::where('title', $pageTitle)->first();

            if($page) {

                # get the page contents from the content_pages table.
                $contents = $page->contents;

                if($contents) {

                    # filter active contents.
                    $contents = $contents->where('status', 1);

                    # find current highest priority
                    $currentHighestPrio = 3;
                    foreach($contents as $key => $content) {
                        if($content->priority < $currentHighestPrio) {
                            $currentHighestPrio = $content->priority;
                            # 1 is the highes priority. Break if exists one content with highes prio.
                            if($currentHighestPrio === 1) {
                                break;
                            }
                        }
                    }

                    # filter by highest priority
                    foreach( $contents as $key => $content) {
                        if($content->priority < $currentHighestPrio) {
                            $contents->forget($key);
                        }
                    }

                    # filter inactives by runtime
                    foreach($contents as $key => $content) {
                        $compareDate = $content->created_at->addDays($content->runtime);
                        if(Carbon::now()->gt($compareDate)){
                           $contents->forget($key);
                        }
                    }
                }

                if($contents->count()) {

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

                    $contentType = \App\ContentType::find($content->type);

                    if($contentType && !empty($contentType->title)) {
                        return view('templates.'.$contentType->title, compact('content'));
                    } else {
                        abort(503, 'Sorry, the content has an invalid type.');
                    }

                } else {
                    abort(503, 'Sorry, I have no contents for this page.');
                }

            } else {
                abort(503, 'Sorry, I have no page with this title.');
            }

        } else {
            abort(404);
        }
    }
}

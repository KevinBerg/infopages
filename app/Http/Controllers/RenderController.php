<?php

namespace App\Http\Controllers;

use App\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RenderController extends Controller
{

    private $currentPage;
    private $currentContent;

    /**
     * Creates the final view (rendered Page with contents)
     * @param $pageTitle the title of the page object.
     */
    public function render(String $pageTitle) {

        # just accept alphanumeric strings for page titles.
        if(ctype_alnum($pageTitle)) {

            $page = \App\Page::where('title', $pageTitle)->first();

            if($page) {

                $this->currentPage = $page;

                # retrieve filtered contents from cache
                $contents = Cache::rememberForever($page->getContentsCacheIndex(), function () {
                    return $this->currentPage->getFilteredContents();
                });

                if(is_object($contents) && $contents->count()) {

                    # try to find a existing entry in the RenderedPageContent table for this page.
                    $renderedPageContent = Cache::rememberForever($page->getRenderedPageCacheIndex(), function () {
                        return \App\RenderedPageContent::where('page_id', $this->currentPage->id)->first();
                    });

                   # $renderedPageContent = \App\RenderedPageContent::where('page_id', $this->currentPage->id)->first();

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

                    $this->currentContent = $content;
                    $renderedPageContent->content_id = $content->id;
                    $renderedPageContent->updated_at = now();
                    $renderedPageContent->save();

                    Cache::forever($page->getRenderedPageCacheIndex(), $renderedPageContent);

                    $contentType = Cache::rememberForever($content->getContentTypeCacheIndex(), function () {
                        return \App\ContentType::find($this->currentContent->type);
                    });

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

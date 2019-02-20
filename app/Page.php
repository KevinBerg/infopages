<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class Page extends Model
{

    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    public function contents()
    {
        return $this->belongsToMany(Content::class)->withTimestamps();
    }

    public function getContentsCacheIndex()
    {
        return $this->title.'_cached_contents';
    }

    public function getFilteredContents()
    {

        # get the page contents from the content_pages table.
        $contents = $this->contents;

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

            return $contents;

        }
    }

}

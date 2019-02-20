<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

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

}

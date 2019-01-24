<?php

namespace Infopages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

}

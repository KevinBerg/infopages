<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contents';

    protected $dates = [
        'created_at',
        'updated_at',
        'start',
        'end'
    ];

    public function pages()
    {
        return $this->belongsToMany('App\Page')->withTimestamps();
    }

    public function type()
    {
        return $this->hasOne('App\ContentType');
    }

}

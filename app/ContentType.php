<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_types';

    protected $fillable = ['title', 'description'];

    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }

}

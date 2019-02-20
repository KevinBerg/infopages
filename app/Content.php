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
        return $this->belongsToMany('App\Page');
    }

    public function type()
    {
        return $this->hasOne('App\ContentType');
    }

    public function getImageStoragePath()
    {
        return public_path().'/uploads/contents/'.$this->id.'/image/';
    }

    public function getImagePath()
    {
        return '/uploads/contents/'.$this->id.'/image/'.$this->image;
    }

    public function getContentTypeCacheIndex()
    {
        return 'content_type_'.$this->id;
    }

}

<?php

namespace Infopages;

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
        return $this->belongsToMany('Infopages\Page');
    }

    public function type()
    {
        return $this->hasOne('Infopages\ContentType');
    }

}

<?php

namespace Infopages;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_types';

    public function contents()
    {
        return $this->belongsToMany('Infopages\Content');
    }

}

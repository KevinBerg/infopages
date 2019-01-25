<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenderedPageContent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rendered_page_contents';

    public function page()
    {
        return $this->hasOne(Page::class);
    }

    public function content()
    {
        return $this->hasOne(Content::class);
    }
}

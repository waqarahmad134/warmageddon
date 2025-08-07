<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQMedia extends Model
{
    protected $table    = 'faq_media';

    public function category()
    {
        return $this->belongsTo(HelpCategory::class);
    }
    public function faq()
    {
        return $this->belongsTo(FAQ::class);
    }
}

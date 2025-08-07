<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faq';

    public function category()
    {
       return $this->belongsTo(HelpCategory::class);
    }
    public function media()
    {
        return $this->hasMany(FAQMedia::class,'faq_id','id');
    }
}

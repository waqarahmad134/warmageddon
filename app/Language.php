<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';

    public function getlangkey()
    {
        return $this->belongsTo(LanguageKey::class,'lang_key','id');
    }
}

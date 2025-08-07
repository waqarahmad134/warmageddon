<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
class LanguageKey extends Model
{
    protected $table = 'language_keys';

    public function getlang()
    {
        $lang                  = Session::get('locale')!=null?Session::get('locale'):'en';
        if ($lang=="en")
        {
            return $this->hasOne(Language::class,'lang_key','id');
        }
        else
        {
            return $this->hasOne(Language::class,'lang_key','id')->where('lang',$lang);
        }

    }
}

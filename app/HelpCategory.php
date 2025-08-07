<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelpCategory extends Model
{
    protected $table = 'help_categories';

    public function faq()
    {
        return $this->hasMany(FAQ::class,'category','id')->where('status','1')->orderBy('order_no','asc');
    }
    public function media()
    {
        return $this->hasMany(FAQMedia::class,'category_id','id');
    }
}

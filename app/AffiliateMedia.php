<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateMedia extends Model
{
    protected $table = 'affiliate_media';

    public function getMediaFiles()
    {
        return $this->hasMany(AffiliateMediaFiles::class,'parent_media','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateMediaFiles extends Model
{
    protected $table = 'affiliate_media_files';

    public function getMedia()
    {
        return $this->belongsTo(AffiliateMedia::class,'parent_media','id');
    }
}

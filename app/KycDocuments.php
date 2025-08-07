<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KycDocuments extends Model
{
    protected $table = 'kyc_documents';

    public function documents()
    {
        return $this->belongsTo(UserDocuments::class);
    }
}

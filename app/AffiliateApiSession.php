<?php

namespace App;
class AffiliateApiSession {
    public $stag             = null;
//    public function __construct($oldsession)
//    {
//        if ($oldsession)
//        {
//            $this->stag             = $oldsession->stag;
//        }
//    }
    public function add($stag)
    {
      $this->stag = $stag;
    }
}

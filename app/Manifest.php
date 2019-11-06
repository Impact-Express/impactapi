<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manifest extends Model
{
    //
    public function apiUser() {
        return $this->belongsTo(ApiUser::class, 'customer_id');
    }
}

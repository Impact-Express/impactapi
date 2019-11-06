<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class ApiUser extends Authenticatable
{
    public function manifests() {
        return $this->hasMany(Manifest::class, 'customer_id');
    }
}

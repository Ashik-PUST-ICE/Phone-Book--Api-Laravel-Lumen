<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $table = 'registration';

    protected $fillable = ['firstname', 'lastname', 'city', 'username', 'password', 'gender'];
}

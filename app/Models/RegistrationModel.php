<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    protected $table='registration';

    protected $primarykey='id';

    public $incrementing ='true';
    protected $keyType='int';

    public $timestamps=false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneBookModel extends Model
{
    protected $table='phone_book_details';

    protected $primarykey='id';

    public $incrementing ='true';
    protected $keyType='int';

    public $timestamps=false;
}

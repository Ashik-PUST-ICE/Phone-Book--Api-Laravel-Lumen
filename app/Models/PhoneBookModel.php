<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneBookModel extends Model
{
    protected $table='phone_book_details';


    public $timestamps = false;
    protected $fillable = ['username', 'phone_number_one', 'phone_number_two', 'name', 'email'];
}




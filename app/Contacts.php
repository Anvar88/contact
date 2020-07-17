<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Contacts extends Model
{
   public $fillable = [

    'name', 'phone' ,'id_group','user_id'

];
}

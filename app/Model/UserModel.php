<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $primaryKey="id";

    protected $table="p_users";

    public $timestamps=false;
  
    protected $guarded = [];
}

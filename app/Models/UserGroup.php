<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'user_groups';
  public $timestamps = false;
    
    protected $fillable = array('user_group_name');

}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    
    protected $table = 'items';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_name'];

    

    
}



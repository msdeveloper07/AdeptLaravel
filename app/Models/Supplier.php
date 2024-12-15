<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    
    protected $table = 'suppliers';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['supplier_name', 'contact_name','email','created_by','updated_by',];

    

    
}



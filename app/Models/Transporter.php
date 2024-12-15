<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    
    protected $table = 'transport_companies';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_name', 'address_line_1', 'address_line_2','city','county','postcode'];

    

    
}



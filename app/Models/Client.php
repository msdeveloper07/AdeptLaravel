<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $table = 'clients_old';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_name', 'contact_name', 'client_address_line_1','client_address_line_2','city','state','county','postcode','phone','fax','email','client_status','created_by','updated_by',];

    

    
}



<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DeliveryLot extends Model
{
    
    protected $table = 'delivery_lots';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id', 'lot_id', 'delivery_id','delivery_details','delivery_type','delivery_status',];

    
 public function Lot() {
         return $this->belongsTo('App\Models\Lot','lot_id','id');
    }
    
}
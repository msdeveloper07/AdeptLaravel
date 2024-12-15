<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    
    protected $table = 'lots';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['lot_id', 'job_id', 'dimension_1','dimension_2','dimension_3','damage_in','location','volume','item_id'];

    
// public function clientId() {
//         return $this->belongsTo('App\Models\Client','client_id');
//    }
     public function Items() {
         return $this->belongsTo('App\Models\Item','item_id');
    }
}



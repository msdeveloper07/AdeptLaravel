<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsIn extends Model
{
    
    protected $table = 'goods_in';
    protected $primaryKey = 'goodsin_id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = ['client_name', 'client_order_number', 'supplier_id','haulage_company_name','project_name','goods_in_date','handling_charge','charge_rate',];

    
 public function clientId() {
         return $this->belongsTo('App\Models\Client','client_id');
    }
    
      public function lots() {
         return $this->hasMany('App\Models\Lot','goodsin_id');
    } 
    public function user() {
         return $this->belongsTo('App\Models\User','created_by');
    }
     
    
    
}



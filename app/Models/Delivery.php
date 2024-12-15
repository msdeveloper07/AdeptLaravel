<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    
    protected $table = 'deliveries';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'goodsin_id', 'transport_order_date','transport_company_id','vehicle_type_id','approximate_weight','agreed_price','collection_date','delivery_date','delivery_address_1','delivery_address_2','delivery_city','delivery_country','delivery_postcode','invoice_value','collection_address_1','collection_address_2','collection_city','collection_country','collection_postcode','damage_out','type_of_note'];

     public function Clientname() {
         return $this->belongsTo('App\Models\Client','client_id');
    }

     public function Transport() {
         return $this->belongsTo('App\Models\Transporter','transport_company_id');
    }
     public function Lots() {
         return $this->hasMany('App\Models\Lot','goodsin_id');
    }
    
}



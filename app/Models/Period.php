<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    
    protected $table = 'periods';
  public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['satrt_date', 'end_date', 'number_of_weeks'];

  
    
}



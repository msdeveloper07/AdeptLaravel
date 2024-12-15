<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GoodsIn;
use App\Models\Delivery;
use App\Http\Requests\InvoiceRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Lot;
use Barryvdh\DomPDF\PDF;
use \Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EmailRequest;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\DeliveryLot;

class InvoiceController extends Controller {

    public function invoice() {
        ZnUtilities::push_js_files('components/goodsin.js');

        $data = array();
        $data['goodsin'] = GoodsIn::all();
        $data['title'] = "Invoice";
        return view('invoice.invoice', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoiceSearch(Request $request) {
        DB::enableQueryLog();



        $client_id = $request->get('client_id');
        $month = $request->get('month');
        $year = $request->get('year');
        $data = array();
        $months = array();
        $goodsin = GoodsIn::where('client_id', $client_id)->get();
          
        //  ZnUtilities::pa($month);die;
        $array = array();
        foreach ($goodsin as $j) {
            $goods = $j->goods_in_date;
             $period = \App\Models\Period::where('year',$year)->where('period_month_id',$month)->first();
                $start_date = $period->start_date;
                $last_date   = $period->end_date;;
           
            $del = Delivery::where('goodsin_id', $j->goodsin_id)->orderBy('id', 'DESC')->first();
            if ($del) {  
               $lots= $j->lots; 
//               ZnUtilities::pa(strtotime($goods) );
//                \App\Libraries\ZnUtilities::pa(strtotime($start_date));
//                if($goods<$start_date){echo 'Yes';}else{echo "NO";}die;
            $deliver_lots = DeliveryLot::where('goodsin_id',$j->goodsin_id)->where('delivery_type','Full')->lists('lot_id')->toArray();
               $count=array();
          foreach($lots as $k=>$l){
           $delivery_lot = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = Delivery::where('goodsin_id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
//          \App\Libraries\ZnUtilities::pa($delivery_date);
         if(!in_array($l->lot_id,$deliver_lots) || strtotime($delivery_date) >=  strtotime($start_date)){
//      
          if($j->goodsin_type!='Daily/Volume'){
               $total_vol = trim($l->volume);
//          if((strtotime($goods) >= strtotime($start_date) && strtotime($goods) <= strtotime($last_date))){
//          ZnUtilities::pa($start_date);
//          ZnUtilities::pa($last_date);die;
//          }
          $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
          if($total_vol!=$deliverd_lot){ 
              if((isset($delivery)?$delivery->delivery_type:''!='Full' && (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods)<strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&&ZnUtilities::format_date($goods, 6)==$year )){
//     
             $count[] = $j->goodsin_id;
           }else if((isset($delivery)?$delivery->delivery_type:''!='Full'&&( ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods) < strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date))) && ZnUtilities::format_date($goods, 6)<$year)){
    
             $count[] = $j->goodsin_id;
           }
               
              }
          }
              else{
           
               if((isset($delivery)?$delivery->delivery_type:''!='Full'&& ZnUtilities::format_date($goods, 7)<=$month )&&( strtotime($goods)< strtotime($start_date)&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
       
             } else if((isset($delivery)?$delivery->delivery_type:''!='Full' && ZnUtilities::format_date($goods, 7)<=$month) &&(strtotime($goods )< strtotime($start_date)&& ZnUtilities::format_date($goods, 6)<$year)){
                
       //\App\Libraries\ZnUtilities::pa($total_vol-$deliverd_lot);
  // \App\Libraries\ZnUtilities::pa($deliverd_lot);
               //   \App\Libraries\ZnUtilities::pa($goods);
                // \App\Libraries\ZnUtilities::pa($goods);die;
             $count[] = $j->goodsin_id;
           }
           
          }
         
         }
          }     
          if(count($count)>0){ 
             $array[] = $j->goodsin_id;
             
         }
       
                $delivery_date = $del->delivery_date;
                if (ZnUtilities::format_date($goods, 6) == $year) {
                    if ((ZnUtilities::format_date($goods, 7)<$month) && ($delivery_date > $last_date || ZnUtilities::format_date($delivery_date, 7)==$month)) {
                        $array[] = $j->goodsin_id;
                    }else if(ZnUtilities::format_date($goods, 7)==$month){
                        $array[] = $j->goodsin_id;
                    }
                } else if (ZnUtilities::format_date($delivery_date, 6) >= $year) {
                    if ($goods < $start_date && ZnUtilities::format_date($delivery_date, 7) >= $month) {
//           
                        $array[] = $j->goodsin_id;
                    }
                }
            } else {
                $delivery_date = '';
                if (ZnUtilities::format_date($goods, 6) == $year) {
                 if (ZnUtilities::format_date($goods, 7) <= $month) {
                        $array[] = $j->goodsin_id;
                    }
                }else if (ZnUtilities::format_date($goods, 6) < $year) {
                   if ($goods < $start_date) {
                     $array[] = $j->goodsin_id;  
                   } 
                    
                }
            }
//              
        }
        $data['client_id'] = $client_id;
        $data['dateY'] = $year;
        $data['dateM'] = $month;
        $data['array'] = $array;

        $data['goodsin'] = $goodsin;
    //   ZnUtilities::pa($array);die();
        ZnUtilities::push_js_files('components/goodsin.js');


        $data['status'] = 'goodsin';

        $data['title'] = "Search Results";
        if (count($array) > 0) {
            return view('invoice.search', $data);
        } else {
            return redirect('/invoicef')->withInput()->with('fail', 'No Job Found For This Month');
        }
    }

    public function invoiceAction(Request $request) {



        $search = $request->get('search');
        if ($search != '') {
            return redirect('/goodsinSearch/' . $search);
        } else {


            //die(Input::get('bulk_action')   );

            $cid = $request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    
                } //end switch
            } // end if statement
            return redirect('/goodsin')->with('fail', 'Please Enter a Keyword');
        }
    }

    public function monthlyInvoice($client_id, $dateM, $dateY) {

        $id = $client_id;
        $month = $dateM;
        $year = $dateY;
        $data = array();

        $months = array();

        $goodsin = GoodsIn::where('client_id',$client_id)->get();
        //$goodsin = GoodsIn::find(9);
        
     
        //  ZnUtilities::pa($month);die;
        $array = array();
        foreach ($goodsin as $j) {
            $goods = $j->goods_in_date;
            $start_date = date($year . '-' . $month . '-01', strtotime('this month'));
            $last_date = date($year . '-' . $month . '-t', strtotime('this month'));
            $del = Delivery::where('goodsin_id', $j->goodsin_id)->orderBy('id', 'DESC')->first();
            if ($del) {     
                $lots= $j->lots; 
              // ZnUtilities::pa($j->lots );die;
            $deliver_lots = DeliveryLot::where('goodsin_id',$j->goodsin_id)->where('delivery_type','Full')->lists('lot_id')->toArray();
               $count=array();
          foreach($lots as $k=>$l){  
              $delivery_lot = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = Delivery::where('goodsin_id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
         if(!in_array($l->lot_id,$deliver_lots)|| strtotime($delivery_date) >=  strtotime($start_date)){

          
      
          if($j->goodsin_type!='Daily/Volume'){
               $total_vol = trim($l->volume);
//
          
          $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
           if($total_vol!=$deliverd_lot){  
              if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods)<strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&&ZnUtilities::format_date($goods, 6)==$year )){
//                      die('here1');
             $count[] = $j->goodsin_id;
           }else if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date))))&& ((strtotime($goods) < strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date))) && ZnUtilities::format_date($goods, 6)<$year)){
                
//        die('here2');
             $count[] = $j->goodsin_id;
           }
               
              }
          }
              else{
           
               if((isset($delivery)?$delivery->delivery_type:''!='Full'&& ZnUtilities::format_date($goods, 7)<=$month )&&( strtotime($goods)< strtotime($start_date)&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
       
             } else if((isset($delivery)?$delivery->delivery_type:''!='Full' && ZnUtilities::format_date($goods, 7)<=$month) &&(strtotime($goods )< strtotime($start_date)&& ZnUtilities::format_date($goods, 6)<$year)){
     
             $count[] = $j->goodsin_id;
           }
           
          }
       
         }
          }     
          if(count($count)>0){ 
             $array[] = $j->goodsin_id;
             
         }
                $delivery_date = $del->delivery_date;
                if (ZnUtilities::format_date($goods, 6) == $year) {
                    if ((ZnUtilities::format_date($goods, 7)<$month) && ($delivery_date > $last_date || ZnUtilities::format_date($delivery_date, 7)==$month)) {
                        $array[] = $j->goodsin_id;
                    }else if(ZnUtilities::format_date($goods, 7)==$month){
                        $array[] = $j->goodsin_id;
                    }
                } else if (ZnUtilities::format_date($delivery_date, 6) >= $year) {
                    if ($goods < $start_date && ZnUtilities::format_date($delivery_date, 7) >= $month) {
//           
                        $array[] = $j->goodsin_id;
                    }
                }
            } else {
                $delivery_date = '';
                if (ZnUtilities::format_date($goods, 6) == $year) {
                 if (ZnUtilities::format_date($goods, 7) <= $month) {
                        $array[] = $j->goodsin_id;
                    }
                }else if (ZnUtilities::format_date($goods, 6) < $year) {
                   if ($goods < $start_date) {
                     $array[] = $j->goodsin_id;  
                   } 
                    
                }
            }
//              
        }
      // \App\Libraries\ZnUtilities::pa($array);die;
       //  \App\Libraries\ZnUtilities::pa($array); 
        $data['client_id'] = $client_id;
        $data['dateY'] = $year;
        $data['dateM'] = $month;
    //  $data['delivery'] = $delivery;
        //$data['lots'] = $lots;
       $data['goodsin'] = $goodsin;
        $data['array'] = $array;
        $data['title'] = 'Monthly Invoice';
      //  $data['goodsin'] = $goodsin;
        ZnUtilities::push_js_files('components/goodsin.js');

//ZnUtilities::pa($data['goodsin']);die;
        $pdf = App::make('dompdf.wrapper');
//      return $pdf->loadView('invoice.monthly_invoice', $data)->stream();

       return $pdf->loadView('invoice.monthly_invoice', $data)->download('MONTHLY_INVOICE.pdf');
    }
    public function detailedPDF($goodsin_id,$client_id, $dateM, $dateY) {

        $id = $client_id;
        $month = $dateM;
        $year = $dateY;
        $data = array();

        $months = array();

        $goodsin = GoodsIn::where('client_id',$client_id)->where('goodsin_id',$goodsin_id)->get();
        //$goodsin = GoodsIn::find(9);
        
     
        //  ZnUtilities::pa($month);die;
        $array = array();
        foreach ($goodsin as $j) {
            $goods = $j->goods_in_date;
            $start_date = date($year . '-' . $month . '-01', strtotime('this month'));
            $last_date = date($year . '-' . $month . '-t', strtotime('this month'));
            $del = Delivery::where('goodsin_id', $j->goodsin_id)->orderBy('id', 'DESC')->first();
            if ($del) {     
                $lots= $j->lots; 
              // ZnUtilities::pa($j->lots );die;
            $deliver_lots = DeliveryLot::where('goodsin_id',$j->goodsin_id)->where('delivery_type','Full')->lists('lot_id')->toArray();
               $count=array();
          foreach($lots as $k=>$l){  
              $delivery_lot = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = Delivery::where('goodsin_id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
         if(!in_array($l->lot_id,$deliver_lots)|| strtotime($delivery_date) >=  strtotime($start_date)){

          
      
          if($j->goodsin_type!='Daily/Volume'){
               $total_vol = trim($l->volume);
//
          
          $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
           if($total_vol!=$deliverd_lot){  
              if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods)<strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&&ZnUtilities::format_date($goods, 6)==$year )){
//                      die('here1');
             $count[] = $j->goodsin_id;
           }else if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods) < strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date))) && ZnUtilities::format_date($goods, 6)<$year)){
                
//        die('here2');
             $count[] = $j->goodsin_id;
           }
               
              }
          }
              else{
           
               if((isset($delivery)?$delivery->delivery_type:''!='Full'&& ZnUtilities::format_date($goods, 7)<=$month )&&( strtotime($goods)< strtotime($start_date)&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
       
             } else if((isset($delivery)?$delivery->delivery_type:''!='Full' && ZnUtilities::format_date($goods, 7)<=$month) &&(strtotime($goods )< strtotime($start_date)&& ZnUtilities::format_date($goods, 6)<$year)){
     
             $count[] = $j->goodsin_id;
           }
           
          }
       
         }
          }     
          if(count($count)>0){ 
             $array[] = $j->goodsin_id;
             
         }
                $delivery_date = $del->delivery_date;
                if (ZnUtilities::format_date($goods, 6) == $year) {
                    if ((ZnUtilities::format_date($goods, 7)<$month) && ($delivery_date > $last_date || ZnUtilities::format_date($delivery_date, 7)==$month)) {
                        $array[] = $j->goodsin_id;
                    }else if(ZnUtilities::format_date($goods, 7)==$month){
                        $array[] = $j->goodsin_id;
                    }
                } else if (ZnUtilities::format_date($delivery_date, 6) >= $year) {
                    if ($goods < $start_date && ZnUtilities::format_date($delivery_date, 7) >= $month) {
//           
                        $array[] = $j->goodsin_id;
                    }
                }
            } else {
                $delivery_date = '';
                if (ZnUtilities::format_date($goods, 6) == $year) {
                 if (ZnUtilities::format_date($goods, 7) <= $month) {
                        $array[] = $j->goodsin_id;
                    }
                }else if (ZnUtilities::format_date($goods, 6) < $year) {
                   if ($goods < $start_date) {
                     $array[] = $j->goodsin_id;  
                   } 
                    
                }
            }
//              
        }
      // \App\Libraries\ZnUtilities::pa($array);die;
       //  \App\Libraries\ZnUtilities::pa($array); 
        $data['client_id'] = $client_id;
        $data['dateY'] = $year;
        $data['dateM'] = $month;
    //  $data['delivery'] = $delivery;
        //$data['lots'] = $lots;
       $data['goodsin'] = $goodsin;
        $data['array'] = $array;
        $data['title'] = 'Print Monthly Invoice';
      //  $data['goodsin'] = $goodsin;
        ZnUtilities::push_js_files('components/goodsin.js');

//ZnUtilities::pa($data['goodsin']);die;
        $pdf = App::make('dompdf.wrapper');
      return $pdf->loadView('invoice.detailed_monthly_invoice', $data)->stream();

//       return $pdf->loadView('invoice.detailed_monthly_invoice', $data)->download('MONTHLY_INVOICE.pdf');
    }

    public function printMonthlyInvoice($client_id, $dateM, $dateY) {

        $client_id = $client_id;
        $month = $dateM;
        $year = $dateY;
        $data = array();
        $months = array();

        $goodsin = GoodsIn::where('client_id', $client_id)->get();
        //  ZnUtilities::pa($month);die;
        $array = array();
         foreach ($goodsin as $j) {
            $goods = $j->goods_in_date;
            $start_date = date($year . '-' . $month . '-01', strtotime('this month'));
            $last_date = date($year . '-' . $month . '-t', strtotime('this month'));
            $del = Delivery::where('goodsin_id', $j->goodsin_id)->orderBy('id', 'DESC')->first();
            if ($del) {
                $lots= $j->lots; 
              // ZnUtilities::pa($j->lots );die;
            $deliver_lots = DeliveryLot::where('goodsin_id',$j->goodsin_id)->where('delivery_type','Full')->lists('lot_id')->toArray();
               $count=array();
          foreach($lots as $k=>$l){
               $delivery_lot = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = Delivery::where('goodsin_id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
         // \App\Libraries\ZnUtilities::pa($delivery_date);
         if(!in_array($l->lot_id,$deliver_lots)|| strtotime($delivery_date) >=  strtotime($start_date)){
         
         
          if($j->goodsin_type!='Daily/Volume'){
               $total_vol = trim($l->volume);
//
          
          $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
          if($total_vol!=$deliverd_lot){  
              if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods)<strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
           }else if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods) < strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date))) && ZnUtilities::format_date($goods, 6)<$year)){
                
        
             $count[] = $j->goodsin_id;
           }
               
              }
          }
              else{
           
               if((isset($delivery)?$delivery->delivery_type:''!='Full'&& ZnUtilities::format_date($goods, 7)<=$month )&&( strtotime($goods)< strtotime($start_date)&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
       
             } else if((isset($delivery)?$delivery->delivery_type:''!='Full' && ZnUtilities::format_date($goods, 7)<=$month) &&(strtotime($goods )< strtotime($start_date)&& ZnUtilities::format_date($goods, 6)<$year)){
     
             $count[] = $j->goodsin_id;
           }
           
          }
       
         }
          }     
          if(count($count)>0){ 
             $array[] = $j->goodsin_id;
             
         }
                $delivery_date = $del->delivery_date;
                if (ZnUtilities::format_date($goods, 6) == $year) {
                    if ((ZnUtilities::format_date($goods, 7)<$month) && ($delivery_date > $last_date || ZnUtilities::format_date($delivery_date, 7)==$month)) {
                        $array[] = $j->goodsin_id;
                    }else if(ZnUtilities::format_date($goods, 7)==$month){
                        $array[] = $j->goodsin_id;
                    }
                } else if (ZnUtilities::format_date($delivery_date, 6) >= $year) {
                    if ($goods < $start_date && ZnUtilities::format_date($delivery_date, 7) >= $month) {
//           
                        $array[] = $j->goodsin_id;
                    }
                }
            } else {
                $delivery_date = '';
                if (ZnUtilities::format_date($goods, 6) == $year) {
                 if (ZnUtilities::format_date($goods, 7) <= $month) {
                        $array[] = $j->goodsin_id;
                    }
                }else if (ZnUtilities::format_date($goods, 6) < $year) {
                   if ($goods < $start_date) {
                     $array[] = $j->goodsin_id;  
                   } 
                    
                }
            }
//              
        }

        $data['client_id'] = $client_id;
        $data['dateY'] = $year;
        $data['dateM'] = $month;
        $data['array'] = $array;
        $data['title'] = 'Print Monthly Invoice';
        $data['goodsin'] = $goodsin;
        ZnUtilities::push_js_files('components/goodsin.js');
       $pdf = App::make('dompdf.wrapper');
       return $pdf->loadView('invoice.monthly_invoice', $data)->stream();
//        return view('invoice.monthly_invoice', $data);
    }

    public function EmailInvoiceCreate($client_id, $dateM, $dateY) {

        $data = array();
        $client_id = $client_id;
        $month = $dateM;
        $year = $dateY;

        ZnUtilities::push_js_files('pekeUpload.js');
        ZnUtilities::push_js_files('components/goodsin.js');
        ZnUtilities::push_js_files('plugins/ckeditor/ckeditor.js');
        $editor_js = '$(function() {
                      CKEDITOR.replace("content");
                      });';
        ZnUtilities::push_js($editor_js);
        $goodsin = GoodsIn::where('client_id', $client_id)->get();
        //  ZnUtilities::pa($month);die;
        $array = array();
    foreach ($goodsin as $j) {
            $goods = $j->goods_in_date;
            $start_date = date($year . '-' . $month . '-01', strtotime('this month'));
            $last_date = date($year . '-' . $month . '-t', strtotime('this month'));
            $del = Delivery::where('goodsin_id', $j->goodsin_id)->orderBy('id', 'DESC')->first();
            if ($del) {
                
               $lots= $j->lots; 
              // ZnUtilities::pa($j->lots );die;
            $deliver_lots = DeliveryLot::where('goodsin_id',$j->goodsin_id)->where('delivery_type','Full')->lists('lot_id')->toArray();
               $count=array();
          foreach($lots as $k=>$l){
               $delivery_lot = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->lists('volume_to_deliver')->toArray();
          
          $delivery = DeliveryLot::where('goodsin_id',$l->goodsin_id)->where('lot_id',$l->lot_id)->orderBy('lot_id','DESC')->first();
          $delivery_date = Delivery::where('goodsin_id',isset($delivery)?$delivery->delivery_id:'')->pluck('delivery_date');
         // \App\Libraries\ZnUtilities::pa($delivery_date);
         if(!in_array($l->lot_id,$deliver_lots)|| strtotime($delivery_date) >=  strtotime($start_date)){
         
         
          if($j->goodsin_type!='Daily/Volume'){
               $total_vol = trim($l->volume);
//
          
          $deliverd_lot = trim(array_sum($delivery_lot));
         //   if($total_vol==$deliverd_lot){exit();}
          if($total_vol!=$deliverd_lot){  
              if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods)<strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
           }else if((isset($delivery)?$delivery->delivery_type:''!='Full'&& (ZnUtilities::format_date($goods, 7)<=$month)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date)))&& ((strtotime($goods) < strtotime($start_date)||(strtotime($goods) >= strtotime($start_date)&&strtotime($goods) <= strtotime($last_date))) && ZnUtilities::format_date($goods, 6)<$year)){
                
        
             $count[] = $j->goodsin_id;
           }
               
              }
          }
              else{
           
               if((isset($delivery)?$delivery->delivery_type:''!='Full'&& ZnUtilities::format_date($goods, 7)<=$month )&&( strtotime($goods)< strtotime($start_date)&&ZnUtilities::format_date($goods, 6)==$year )){
       
             $count[] = $j->goodsin_id;
       
             } else if((isset($delivery)?$delivery->delivery_type:''!='Full' && ZnUtilities::format_date($goods, 7)<=$month) &&(strtotime($goods )< strtotime($start_date)&& ZnUtilities::format_date($goods, 6)<$year)){
     
             $count[] = $j->goodsin_id;
           }
           
          }
       
         }
          }     
          if(count($count)>0){ 
             $array[] = $j->goodsin_id;
             
         }
                $delivery_date = $del->delivery_date;
                if (ZnUtilities::format_date($goods, 6) == $year) {
                    if ((ZnUtilities::format_date($goods, 7)<$month) && ($delivery_date > $last_date || ZnUtilities::format_date($delivery_date, 7)==$month)) {
                        $array[] = $j->goodsin_id;
                    }else if(ZnUtilities::format_date($goods, 7)==$month){
                        $array[] = $j->goodsin_id;
                    }
                } else if (ZnUtilities::format_date($delivery_date, 6) >= $year) {
                    if ($goods < $start_date && ZnUtilities::format_date($delivery_date, 7) >= $month) {
//           
                        $array[] = $j->goodsin_id;
                    }
                }
            } else {
                $delivery_date = '';
                if (ZnUtilities::format_date($goods, 6) == $year) {
                 if (ZnUtilities::format_date($goods, 7) <= $month) {
                        $array[] = $j->goodsin_id;
                    }
                }else if (ZnUtilities::format_date($goods, 6) < $year) {
                   if ($goods < $start_date) {
                     $array[] = $j->goodsin_id;  
                   } 
                    
                }
            }
//              
        }
        $data['goodsin'] = $goodsin;
        $data['client_id'] = $client_id;
        $data['dateM'] = $month;
        $data['dateY'] = $year;
        $data['array'] = $array;
        $data['title'] = "Job Invoice";
        ZnUtilities::push_js_files('components/goodsin.js');


        $path = public_path() . '/pdf/';
        if (!File::exists('pdf')) {
            File::makeDirectory('pdf', 0775, true);
        }



        $pdf = App::make('dompdf.wrapper');
//       return $pdf->loadView('goodsin.invoice_goodsin', $data)->stream();
        $pdf->loadView('invoice.monthly_invoice', $data)->save($path . '/MONTHLY_INVOICE.pdf');
        $data = array();
        $data['filename'] = 'MONTHLY_INVOICE.pdf';
        $data['path'] = $path . 'MONTHLY_INVOICE.pdf';

        $data['title'] = 'Email Invoice';

        $data['clients'] = Client::where('id', $client_id)->first();

        return view('invoice.email_invoice', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function EmailInvoiceStore(InvoiceRequest $request) {

        $new_message = str_replace('{Client_Name}', $request->recipient_name, $request->content);
        Mail::send('emails.blank', array(
            'content' => $new_message), function($message) use($request) {
            $message->to($request->email, "Test")->subject($request->subject)->attach($request->file_path);
        });

        return back()->with('success', 'Email Sent Successfully!');
    }

}

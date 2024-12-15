<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GoodsIn;
use App\Models\Delivery;
use App\Http\Requests\GoodsInRequest;
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
use App\Http\Requests\GoodsInLotRequest;


class GoodsInController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        ZnUtilities::push_js_files('components/goodsin.js');

        $data = array();
        $data['status'] = 'goodsin';
        $data['goodsin'] = GoodsIn::orderBy('goodsin_id', 'DESC')->paginate();
        $data['title'] = "GoodsIn";
        return view('goodsin.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        ZnUtilities::push_js_files('components/goodsin.js');
        $data = array();

        $data['clients'] = Client::all();
        $goodsin = GoodsIn::orderBy('goodsin_id', 'DESC')->first();
        $data['goodsin_number'] = (isset($goodsin)) ? $goodsin->id + 1 : '1';
        $data['suppliers']  = Supplier::all();
        $data['title'] = "Create GoodsIn";

        return view('goodsin.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoodsInRequest $request) {

        $goodsin = new GoodsIn();
        
        $goodsin->client_id = $request->get('client_name');
        $goodsin->client_order_number = $request->get('client_order_number');
        $goodsin->goodsin_type = $request->get('goodsin_type');
        $goodsin->supplier_id = $request->get('supplier_id');
        $goodsin->haulage_company_name = $request->get('haulage_company_name');
        $goodsin->project_name = $request->get('project_name');
        
        $goodsin->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'),11);
       if($request->get('goodsin_type')=='Daily/Volume'){
        $goodsin->total_volume = $request->get('total_volume');
         }
        $goodsin->handling_charge = $request->get('handling_charge');
        $goodsin->charge_rate = $request->get('charge_rate');
        $goodsin->goodsin_status = 'Active';
        $goodsin->created_by = Auth::user()->id;

        $goodsin->save();

        return redirect('goodsin/createLot/' . $goodsin->id)->with('success', 'GoodsIn Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $data = array();
        $data['goodsin'] = GoodsIn::find($id);
        $data['suppliers'] = Supplier::where('id', $data['goodsin']->supplier_id)->pluck('supplier_name');
//        ZnUtilities::pa($data['suppliers']);die;
        $data['goodsin_id'] = $id;
        $data['title'] = "Show GoodsIn";
           $data['lots'] = Lot::where('goodsin_id', $id)->get();
        $data['goodsin_id'] = $id;

        return view('goodsin.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        ZnUtilities::push_js_files('components/goodsin.js');
        ZnUtilities::push_js_files('datetimepicker.js');
//        ZnUtilities::push_css_files('datetimepicker.min.css');

        $goodsin = GoodsIn::find($id);
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();
        $data['goodsin_id'] = $id;
        $data['client'] = Client::all();
        $data['suppliers']  = Supplier::all();
        $data['goodsin'] = $goodsin;
        $data['title'] = "Edit GoodsIn";
         $data['lots'] = Lot::where('goodsin_id', $id)->get();
        $data['goodsin_id'] = $id;


        return view('goodsin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, GoodsInRequest $request) {

        $goodsin = GoodsIn::find($id);
       
        $goodsin->client_id = $request->get('client_name');
        $goodsin->client_order_number = $request->get('client_order_number');
        $goodsin->goodsin_type = $request->get('goodsin_type');
        $goodsin->supplier_id = $request->get('supplier_id');
        $goodsin->haulage_company_name = $request->get('haulage_company_name');
        $goodsin->project_name = $request->get('project_name');
        $goodsin->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'),11);
        if($request->get('goodsin_type')=='Daily/Volume'){
        $goodsin->total_volume = $request->get('total_volume');
         }
        $goodsin->handling_charge = $request->get('handling_charge');
        $goodsin->charge_rate = $request->get('charge_rate');
        $goodsin->updated_by = Auth::user()->id;

        $goodsin->save();

        return Redirect('/goodsin/'.$id.'/edit')->with('success', 'GoodsIn Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function goodsinSearch($search) {

 
        $goodsin = GoodsIn::where("goodsin_id", "like", "%" . $search . "%")
                ->orWhere("client_order_number", "like", "%" . $search . "%")
                ->orWhere("project_name", "like", "%" . $search . "%")
                ->orWhere("goods_in_date", "like", "%" . ZnUtilities::format_date($search,11) . "%")
                ->orderBy('goodsin_id','desc')
                ->paginate();
                        
        $data = array();
     
        $data['goodsin'] = $goodsin;
        $data['title'] = "GoodsIn";
        //Basic Page Settings

        $data['search'] = $search;
        $data['status'] = 'goodsin';
        
        
        return view('goodsin.list', $data);
    
        }

        
    public function GoodsInsSearch(){
        //DB::enableQueryLog();
        $keyword = \Input::get('keyword');
        $date_from = \Input::get('date_from');
        $date_to = \Input::get('date_to');
        $goodsin_status = \Input::get('goodsin_status');
        $client_id = \Input::get('client_id');
        $created_by = \Input::get('created_by');
        
        
          $goodsin  = DB::table('goods_in as j');
               
        //  $goodsin->Join('clients as c','c.id','=','j.client_id');
          
                if($keyword!=''){
                    $keyword = trim($keyword);
                    $goodsin->orWhere(function ($goodsin) use ($keyword) 
                        {
                        
                            
                            $goodsin->where("j.client_order_number","like","%".$keyword."%")
                                    ->orwhere("j.id","like","%".$keyword."%")
                                    ->orwhere("j.supplier_id","like","%".$keyword."%")
                                    ->orwhere("j.haulage_company_name","like","%".$keyword."%")
                                    ->orwhere("j.project_name","like","%".$keyword."%");
                            
                              
                        });
                }
                 if($date_from!='')
                {
                    $date_from_corrected = ZnUtilities::format_date($date_from,11);
                    $goodsin->where('j.goods_in_date','>=',$date_from_corrected);
                    $goodsin->orderBy('j.goods_in_date','asc');
                    
                }
                
                if($date_to!='')
                {
                    $date_to_corrected = ZnUtilities::format_date($date_to,11);
                    $goodsin->where('j.goods_in_date','<=',$date_to_corrected);
                }

                if(in_array($goodsin_status,array('Active','Archive')))
                {
                    $goodsin->where('j.goodsin_status',$goodsin_status);
                }

                if($client_id!='')
                {
                   $goodsin->where('j.client_id',$client_id); 
                }
              

                if($created_by!='')
                {
                   $goodsin->where('j.created_by',$created_by); 
                }

             
                
                    
                 $goodsin->orderBy('j.id','desc');
                   

                // $data['all_goodsin'] = $goodsin->get(array('j.*','c.*'));
                
//                 echo ZnUtilities::lastQuery();
//                
                //ZnUtilities::pa( $data['all_goodsin']);die;
                 
                ZnUtilities::push_js_files('components/goodsin.js');

        
        $data['status'] = 'goodsin';
        $data['goodsin'] = $goodsin->paginate();
        $data['title'] = "Search Results";
        return view('goodsin.search', $data);
                
                 
             
    }    
        
    public function goodsinAction(Request $request) {


      
        $search = $request->get('search');
        if ($search != '') {
            return redirect('/goodsinSearch/' . $search);
        } else {
                    

            //die(Input::get('bulk_action')   );

            $cid = $request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    case 'archive': {
                            foreach ($cid as $id) {
                                DB::table('goods_in')
                                        ->where('goodsin_id', $id)
                                        ->update(array('goodsin_status' => 'Archive'));
                            }

                            return redirect('/goodsin')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
                            foreach ($cid as $id) {
                                DB::table('goods_in')
                                        ->where('goodsin_id', $id)
                                        ->update(array('goodsin_status' => 'Active'));
                            }

                            return redirect('/goodsin')->with('success', 'Rows Updated!');
                            break;
                        }
                } //end switch
            } // end if statement
            return redirect('/goodsin')->with('fail', 'Please Enter a Keyword');
        }
    }

    public function createLot($id) {
        ZnUtilities::push_js_files('components/lots.js');
      //  ZnUtilities::push_js_files('chosen.jquery.js');
        ZnUtilities::push_css_files('chosen.css');
       ZnUtilities::push_js_files('chosen.jquery.min.js');
        $js = "$('#item_id').change(function(){ $('#item_id').chosen();   });";
        ZnUtilities::push_js($js);
        $data = array();
        $data['goodsin_type'] = GoodsIn::where('goodsin_id', $id)->pluck('goodsin_type');
        $data['goodsin'] = GoodsIn::find($id);
        $data['lots'] = Lot::where('goodsin_id', $id)->get();
        
        $lot = Lot::where('goodsin_id', $id)->count();
        $data['items'] = Item::all();

        $data['lot_number'] = (isset($lot)) ? $lot + 1 : '1';

        $data['goodsin_id'] = $id;
        $data['title'] = "Create Lots";

        return view('goodsin.lots', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveLot(GoodsInLotRequest $request) {
        if ($request->get('lot_number') > 40) {

            return redirect()->back()->with('fail', "Lots are Full");
        }
        $id = $request->get('goodsin_id');
        $last_lot = Lot::where('goodsin_id', $id)->orderBy('lot_id','DESC')->first();
        //ZnUtilities::pa($last_lot->lot_id);die;
        if((isset($last_lot)?$last_lot->lot_id:'')!=$request->get('goodsin_type')){
        $lot = new Lot();
        $lot->lot_id = $request->get('lot_number');
        $lot->goodsin_id = $request->get('goodsin_id');
        $lot->goodsin_type = $request->get('goodsin_type');
        $lot->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'),11);
        $lot->dimension_1 = $request->get('dimension_1');
        $lot->dimension_2 = $request->get('dimension_2');
        $lot->dimension_3 = $request->get('dimension_3');
        $lot->damage_in = $request->get('damage_in');
        $lot->item_id = $request->get('item_id');
       
        $lot->location = $request->get('location');
        $lot->volume = $request->get('volume');


        $lot->save();
        }

        return redirect('goodsin/createLot/' . $id . '/')->with('success', 'Lot Created Successfully');
    }

    public function editLot($id) {
        ZnUtilities::push_js_files('components/lots.js');
        ZnUtilities::push_js_files('chosen.jquery.min.js');
        // ZnUtilities::push_js_files('chosen.jquery.js');
        $js = "$(document).ready(function(){ $('#item_id').chosen();   });";
        ZnUtilities::push_js($js);
//        $lot = Lot::find($id);
//        $data = array();
//        $data['goodsin_id'] = $lot->goodsin_id;
//        $data['id'] = $id;
//        
//        $lot = Lot::where('goodsin_id', $id)->pluck('lot_id');
//        $data['goodsin_type'] = GoodsIn::where('goodsin_id', $goodsin)->pluck('goodsin_type');
//        $lots = Lot::where('goodsin_id', $goodsin)->get();
//         $data['items'] = Item::all();
//        
//         $data['goodsin_id'] = $goodsin;
//        $data['lot'] = $lot;
//        $data['lots'] = $lots;
//     $data['goodsin'] = GoodsIn::find($goodsin);
//        $data['title'] = "Edit Lot";
        $lot = Lot::find($id);
        $data = array();
        $data['id'] = $id;
        
        $goodsin_id = Lot::where('id', $id)->pluck('goodsin_id');
        $data['goodsin_type'] = GoodsIn::where('goodsin_id', $goodsin_id)->pluck('goodsin_type');
        $goodsin = Lot::where('goodsin_id', $goodsin_id)->get();
         $data['items'] = Item::all();
        
         $data['goodsin_id'] = $goodsin_id;
        $data['lot'] = $lot;
        $data['lots'] = $goodsin;
     $data['goodsin'] = GoodsIn::find($goodsin_id);
        $data['title'] = "Edit Lot";


        return view('goodsin.lot_edit', $data);
    }

    public function updateLot($id, GoodsInLotRequest $request) {
        $lot = Lot::find($id);

        $lot->lot_id = $request->get('lot_number');
        $lot->goodsin_id = $request->get('goodsin_id');
        $lot->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'),11);
        $lot->dimension_1 = $request->get('dimension_1');
        $lot->dimension_2 = $request->get('dimension_2');
        $lot->dimension_3 = $request->get('dimension_3');
        $lot->damage_in = $request->get('damage_in');
        $lot->item_id = $request->get('item_id');
     
        $lot->location = $request->get('location');
        $lot->volume = $request->get('volume');

        $lot->save();

        return Redirect('goodsin/createLot/' . $request->get('goodsin_id') . '/')->with('success', 'Lot Updated Successfully!');
    }

    public function lotSearch($search, $id) {


        $lot = Lot::where("lot_id", "like", "%" . $search . "%")
                ->orWhere("goodsin_id", "like", "%" . $search . "%")
                ->orWhere("location", "like", "%" . $search . "%")
                ->orWhere("damage_in", "like", "%" . $search . "%");


        $data = array();
        $data['lots'] = $lot;
        $data['title'] = "All Lots";

        //Basic Page Settings

        $data['search'] = $search;

        return view('goodsin.lots', $data);
    }

    public function lotAction(Request $request) {


        $search = $request->get('search');
        if ($search != '') {
            return redirect('/lotSearch/' . $search);
        } else {


            //die(Input::get('bulk_action')   );

            $cid = $request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    case 'blocked': {
                            foreach ($cid as $id) {
                                DB::table('lots')
                                        ->where('goodsin_id', $id)
                                        ->update(array('lot_status' => 'deactive'));
                            }

                            return redirect('/goodsin/lots/{{$id}}')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
                            foreach ($cid as $id) {
                                DB::table('lots')
                                        ->where('goodsin_id', $id)
                                        ->update(array('lot_status' => 'active'));
                            }

                            return redirect('/goodsin/lots/{{$id}}')->with('success', 'Rows Updated!');
                            break;
                        }
                } //end switch
            } // end if statement
            return redirect('/goodsin/lots/{{$id}}')->with('fail', '0Please Enter a Keyword');
        }
    }

    public function invoiceGoodsIn($id) {
        $data = array();
        $goodsin = GoodsIn::find($id);
        $data['goodsin'] = $goodsin;
        $data['client'] = Client::find($data['goodsin']->client_id);
        $data['lots'] = Lot::where('goodsin_id', $id)->get();
        $data['title'] = "GoodsIn Invoice";
        ZnUtilities::push_js_files('components/goodsin.js');

        //ZnUtilities::pa($data);die;
        $pdf = App::make('dompdf.wrapper');
    //  return $pdf->loadView('goodsin.invoice_goodsin', $data)->stream();
  return $pdf->loadView('goodsin.invoice_goodsin', $data)->download('GOODSIN_GIRECEIPT-'.  ZnUtilities::format_date($goodsin->goods_in_date,10).'.pdf');
    }

    public function archivedGoodsIn() {

        ZnUtilities::push_js_files('components/goodsin.js');

        $data = array();
        $data['status'] = 'archiveGoodsIn';
        $data['goodsin'] = GoodsIn::where('goodsin_status', "archive")->OrderBy('goodsin_id', 'DESC')->paginate();
        $data['title'] = "Archive GoodsIn";
        
        return view('goodsin.list', $data);
    }

    public function activeGoodsIn() {
        ZnUtilities::push_js_files('components/goodsin.js');

        $data = array();
        $data['status'] = 'activeGoodsIn';
        $data['goodsin'] = GoodsIn::where('goodsin_status', "active")->OrderBy('goodsin_id', 'DESC')->paginate();
        $data['title'] = "Active GoodsIn";

        return view('goodsin.list', $data);
    }

    public function labelPrint($id) {
        $data = array();
       
        $data['title'] = 'Label Print';
       
        $data['total_lots'] = Lot::where('goodsin_id', $id)->count();
        $data['all_lots'] = Lot::where('goodsin_id',$id)->get();
        $data['goodsin'] = GoodsIn::find($id);
//     ZnUtilities::pa($data['goodsin'] );die;
        ZnUtilities::push_js_files('components/goodsin.js');

//      $path = "pdf_new";

        return $view_content = view('goodsin.label_print', $data);
    }
    
      public function printSingleLot($id) {
        $data = array();
       
        $data['title'] = 'Print Single Lot';
      
        $data['all_lots'] = Lot::find($id);
        $data['goodsin'] = GoodsIn::find($data['all_lots']->goodsin_id);
       $data['total_lots'] = Lot::where('goodsin_id',$data['all_lots']->goodsin_id)->count();
    // ZnUtilities::pa($data['all_lots'] );die;
        ZnUtilities::push_js_files('components/goodsin.js');



        return $view_content = view('goodsin.label_print', $data);
    }
     public function EmailTempCreate($id) {
       
         $data = array();
         
        ZnUtilities::push_js_files('pekeUpload.js');
        ZnUtilities::push_js_files('components/goodsin.js');
        ZnUtilities::push_js_files('plugins/ckeditor/ckeditor.js');
        $editor_js = '$(function() {
                      CKEDITOR.replace("content");
                      });';
        ZnUtilities::push_js($editor_js);
         
        $data['goodsin'] = GoodsIn::find($id);
        $data['client'] = Client::find($data['goodsin']->client_id);
        $data['lots'] = Lot::where('goodsin_id', $id)->get();
        $data['title'] = "GoodsIn Invoice";
        ZnUtilities::push_js_files('components/goodsin.js');

      
      $path = public_path().'/pdf'; 
        if(!File::exists('pdf')){
        File::makeDirectory('pdf', 0775, true);
       }
        
       // return $view_content = view('goodsin.invoice_goodsin', $data);die;
                                           
        
        $pdf = App::make('dompdf.wrapper');
       //return $pdf->loadView('goodsin.invoice_goodsin', $data)->stream();
       $pdf->loadView('goodsin.invoice_goodsin', $data)->save($path.'/GOODSIN_GIRECEIPT.pdf');
           $data = array(); 
           $data['filename'] = 'GOODSIN_GIRECEIPT.pdf';
           $data['path']=$path.'/GOODSIN_GIRECEIPT.pdf';
           
        $data['title'] = 'Email Template';
     $clientid = GoodsIn::where('goodsin_id',$id)->pluck('client_id');
     $data['clients'] = Client::where('goodsin_id',$clientid)->first();
        return view('goodsin.email_template', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function EmailTemplateStore(EmailRequest $request) {
       
$new_message = str_replace('{Client_Name}',$request->recipient_name,$request->content);
 Mail::send('emails.blank', 
                        array(
                            'content'=>  $new_message), 
                        function($message) use($request){
                 $message->to($request->email_template,"demo")
                                    ->subject($request->subject)->attach($request->file_path);
            }
                    );  
                    
                       return redirect('/goodsin')->with('success', 'Email Sent Successfully !');
}
  public function getclientsGoodsIn($client_id)
    {
          $data = array();
        $data = GoodsIn::where('client_id',$client_id)->get()->toJson();
        echo $data;
    }
  public function getGoodsInDelivery($goodsin_id)
    {
          $data = array();
        $data = Delivery::where('goodsin_id',$goodsin_id)->get()->toJson();
        echo $data;
    }
    
    public function ShowDelivery($id) {
     
         $data=array();
         $data['clients'] = Client::all();
         $data['goodsin'] = GoodsIn::all();

           $data['search_by_date'] = 'delivery_number';
           
           
           $data['deliveries'] = Delivery::where('goodsin_id',$id)->orderBy('goodsin_id','DESC')->paginate(10);
           $project_name  = GoodsIn::where('goodsin_id',$id)->pluck('project_name');
           $data['project_name'] = $project_name;
  
        $data['title'] = "Deliveries For ".$project_name." [GoodsIn Id:$id]";
      ZnUtilities::push_js_files('components/delivery.js');
        return view('delivery.list', $data);
    }

     public function printStockList($id) {
        $data = array();

//        $data['title'] = 'Print Stock List';

        $data['goodsin'] = GoodsIn::find($id);
      
      //  $data['lots'] = DeliveryLot::where('goodsin_id', $id)->where('delivery_type','!=','Full')->get();
//      $array = DeliveryLot::where('goodsin_id', $id)->where('delivery_type','full')->lists('goodsin_id');
     $data['deliver_lots'] = DeliveryLot::where('goodsin_id', $id)->where('delivery_type','Full')->lists('lot_id')->toArray();
//        $delivered_lot =  (array) $array;
//        $data['delivered_lot'] = $delivered_lot;
        $data['lots'] = Lot::where('goodsin_id', $id)->get();        
        //ZnUtilities::pa($data['lots']);die;
          ZnUtilities::push_js_files('components/goodsin.js');
       $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('goodsin.printStockList', $data)->stream();
   //return $pdf->loadView('goodsin.printStockList',$data)->download('StockList.pdf');
    // return $view_content = view('goodsin.printStockList', $data);
                     
        
    }
}
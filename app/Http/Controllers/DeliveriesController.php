<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Http\Requests\DeliveryRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\GoodsIn;
use App\Models\Transporter;
use App\Models\DeliveryLot;
use App\Models\Setting;
use App\Http\Requests\DeliveryListRequest;
use App\Models\VehicleType;
use App\Models\Lot;
use App\Models\Item;
use App;


class DeliveriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
       

        
        //************************************
        
        
      
        ZnUtilities::push_js_files('components/delivery.js');
        $data = array();
        $data['clients'] = Client::all();
        $data['goodsin'] = GoodsIn::all();

        $data['search_by_date'] = 'delivery_number';
        $data['deliveries'] = Delivery::orderBy('id', 'DESC')->paginate(10);


        $data['title'] = "Deliveries";

        return view('delivery.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        ZnUtilities::push_js_files('components/delivery.js');
        $data = array();
        $data['clients'] = Client::all();
        $data['goodsin'] = GoodsIn::all();
        $data['transport_company'] = Transporter::all();
        $data['vehicletype'] = VehicleType::all();
//           $delivery = Delivery::orderBy('goodsin_delivery_id', 'DESC')->first();
//         $data['goodsin_delivery_id'] = (!empty($delivery)) ? $delivery->id + 1 : '1';

        $data['title'] = "Create Delivery";

        return view('delivery.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryRequest $request) {




        $delivery = new Delivery();

 
        $delivery->job_delivery_id = $request->get('job_delivery_id');
        $delivery->client_id = $request->get('client_id');
        $delivery->goodsin_id = $request->get('goodsin_id');
        $delivery->transport_order_date = ZnUtilities::format_date($request->get('transport_order_date'),11);
        $delivery->transport_company_id = $request->get('transport_company_id');
        $delivery->vehicle_type_id = $request->get('vehicle_type_id');
        $delivery->approximate_weight = $request->get('approximate_weight');
        $delivery->agreed_price = $request->get('agreed_price');
        $delivery->collection_date = ZnUtilities::format_date($request->get('collection_date'),11);
        $delivery->delivery_date = ZnUtilities::format_date($request->get('delivery_date'),11);
        $delivery->collection_time = $request->get('collection_time');
        $delivery->delivery_time = $request->get('delivery_time');

        $delivery->invoice_value = $request->get('invoice_value');

        $delivery->site_contact_details = $request->get('site_contact_details');
        $delivery->damage_out = $request->get('damage_out');
        $delivery->loading_charge = $request->get('loading_charge');

        $delivery->save();

        return redirect('createDeliveryAddress' . '/' . $delivery->id)->with('success', 'Delivery Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        ZnUtilities::push_js_files('components/delivery.js');

        $delivery = Delivery::find($id);

//        $lotid = Lot::where("goodsin_id",$delivery->goodsin_id)->get();
//        $lot = array();
//        $item= array();
//        foreach($lotid as $l) 
//           {
//           $lot[]=  $l->item_id;
//       }
//       foreach($lot as $p){
//       $item[] = Item::where("id",$p)->get();
//       }
//       ZnUtilities::pa($item);die;
////      
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();
        $data['transport_company'] = Transporter::get();
        $data['clients'] = Client::get();
        $data['delivery_lots'] = DeliveryLot::where('delivery_id', $id)->get();
        $data['goodsin'] = GoodsIn::get();

        $data['vehicletype'] = VehicleType::where('id', $delivery->vehicle_type_id)->pluck('vehicle_type');
        $data['id'] = $id;
        $data['delivery'] = $delivery;
        $data['title'] = "Delivery Details";


        return view('delivery.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {


        ZnUtilities::push_js_files('components/delivery.js');

        $delivery = Delivery::find($id);


//            $d = $users=>id;
//            print_r($users);die;
        $data = array();
        $data['transport_company'] = Transporter::get();
        $data['delivery_lots'] = DeliveryLot::where('delivery_id', $id)->get();
        $data['clients'] = Client::get();
        $data['goodsin'] = GoodsIn::get();
        $data['vehicletype'] = VehicleType::all();

        $data['id'] = $id;
        $data['delivery'] = $delivery;
        $data['title'] = "Edit Delivery";


        return view('delivery.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request) {
        $delivery = Delivery::find($id);
   
        $delivery->job_delivery_id = $request->get('job_delivery_id');
//        $delivery->client_id = $request->get('client_id');
        $delivery->goodsin_id = $request->get('goodsin_id');
        $delivery->transport_order_date = ZnUtilities::format_date($request->get('transport_order_date'),11);
        $delivery->transport_company_id = $request->get('transport_company_id');
        $delivery->vehicle_type_id = $request->get('vehicle_type_id');
        $delivery->approximate_weight = $request->get('approximate_weight');
        $delivery->agreed_price = $request->get('agreed_price');
        $delivery->collection_date = ZnUtilities::format_date($request->get('collection_date'),11);
        $delivery->delivery_date = ZnUtilities::format_date($request->get('delivery_date'),11);
        $delivery->collection_time = $request->get('collection_time');
        $delivery->delivery_time = $request->get('delivery_time');
        
        $delivery->invoice_value = $request->get('invoice_value');

        $delivery->site_contact_details = $request->get('site_contact_details');
        $delivery->damage_out = $request->get('damage_out');
        $delivery->loading_charge = $request->get('loading_charge');


        $delivery->save();
        return Redirect('delivery/'.$id)->with('success', 'Delivery Updated Successfully!');
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

    public function deliverySearch(DeliveryListRequest $request) {

        $goodsin_id = $request->get('goodsin');
        $search_by_date = $request->get('search_by_date');
        $search = $request->get('search');
        $deliverySearch = DB::table('deliveries')
                ->where('goodsin_id', $goodsin_id);

        if ($search_by_date == 'delivery_number') {
            $deliverySearch->where("job_delivery_id", $search);
        }
        if ($search_by_date == 'collection_date') {
            $deliverySearch->where("collection_date", ZnUtilities::format_date($search,11));
        }
        if ($search_by_date == 'delivery_date') {
            $deliverySearch->where("delivery_date", ZnUtilities::format_date($search,11));
        }




        $data = array();
        $data['deliveries'] = $deliverySearch->paginate(10);
        $data['title'] = "Deliveries";
        $data['search_by_date'] = $search_by_date;
        //Basic Page Settings
        $data['clients'] = Client::all();
        $data['search'] = $search;
        $data['goodsin_id'] = $goodsin_id;

        ZnUtilities::push_js_files('components/delivery.js');
        return view('delivery.list', $data);
    }

    public function deliveryAction(Request $request) {

        $search_by_date = $request->search_by_date;
        $search = $request->get('search');

        if ($search != '') {
            return redirect('/deliverySearch/' . $search . '/' . $search_by_date);
        } else {
            return redirect('/delivery/')->with('fail', 'Please Enter A Keyword For Search');
        }
    }

    public function deliveryLots($id) {
        ZnUtilities::push_js_files('components/delivery_lots.js');


        $delivery = Delivery::find($id);



        $data = array();

//        $data['lots'] = $delivery->Lots->details;
//        ZnUtilities::pa($data['lots']);die;

        $data['id'] = $id;
        $data['delivery'] = $delivery;
        $data['title'] = "Select Delivery Lots";
        $goodsin = GoodsIn::find($delivery->goodsin_id);
        $data['lots'] = $goodsin->lots;
        $data['goodsin'] = $goodsin;

        $data['prev_full_lot'] = DeliveryLot::where('goodsin_id', $goodsin->id)->where('delivery_type', 'Full')->lists('lot_id')->toarray();
        //  ZnUtilities::pa($data['prev_full_lot']);die();
        $data['total_lots'] = count($delivery->Lots);
        $delivery_lots = DeliveryLot::where('delivery_id', $id)->get();
        if (count($delivery_lots) > 0) {
            $data['delivery_lots'] = $delivery_lots;
            $all_lots = DeliveryLot::where('delivery_id', $id)->lists('lot_id')->toarray();
            $data['all_lots'] = $all_lots;
//         ZnUtilities::pa($all_lots);die();
        }
        return view('delivery.select_lot', $data);
    }

    public function saveDeliveryLots(Request $request) {
        if (count($request->cid) == 0) {
            return redirect('/delivery/' . $request->delivery_id);
        }
       
        foreach ($request->cid as $k => $c) {
            $old_delivery_id = DeliveryLot::where('delivery_id', $request->delivery_id)->where('goodsin_id', $request->goodsin_id)->where('lot_id', $request->lot_id[$k])->pluck('id');
            if ($old_delivery_id) {
                $delivery_lots = DeliveryLot::find($old_delivery_id);
            } else {
                $delivery_lots = new DeliveryLot();
            }
            $new_vol = trim($request->volume_to_deliver[$k]);
           $old_volume = DeliveryLot::where('delivery_id',"!=", $request->delivery_id)->where('goodsin_id', $request->goodsin_id)->where('lot_id', $request->lot_id[$k])->lists('volume_to_deliver')->toArray();
           $total_volume = Lot::where('goodsin_id', $request->goodsin_id)->where('lot_id', $request->lot_id[$k])->pluck('volume');
           $total_old = array_sum($old_volume);
           //ZnUtilities::pa($total_volume);die;
           $delivery_lots->lot_id = $request->lot_id[$k];
            $delivery_lots->goodsin_id = $request->goodsin_id;
            $delivery_lots->delivery_id = $request->delivery_id;
           // ZnUtilities::pa($request->goods_in_detail[$k]);
            $delivery_lots->goods_in_details = $request->goods_in_detail[$k];
            
            $delivery_lots->delivery_details = trim($request->lot_detail[$k]);
            if($request->goodsin_type=='Weekly/Dimension'){
             if($total_old + $new_vol <= $total_volume &&($request->type_of_note[$k]=='Full' || ((preg_match('/^[0-9]{1,}/',$new_vol )) && $new_vol!=''&&$new_vol!=0))){
            $delivery_lots->volume_to_deliver = $new_vol;
             }else{
               return redirect()->back()->with('fail','Please Enter valid Volume in Lot '.$request->lot_id[$k]);  
             }
            }
//              if($total_old + $new_vol == $total_volume){
//               $delivery_lots->delivery_type = 'Full';   
//              }else{
                  $delivery_lots->delivery_type = $request->type_of_note[$k];
         //     }
               
              
          
            $delivery_lots->delivery_status = 'Active';
            $delivery_lots->save();
        }
        
        return redirect('/delivery/' . $request->delivery_id)->with('success', 'Delivery Lots Saved Successfully');
    }

    public function createDeliveryAddress($id) {

        $data = array();

        $data['id'] = $id;
        $data['title'] = "Create Delivery Address";

        return view('delivery.createAddress', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAddress($id, Request $request) {




        $delivery = Delivery::find($id);

        $delivery->delivery_address_1 = $request->get('delivery_address_1');
        $delivery->delivery_address_2 = $request->get('delivery_address_2');
        $delivery->delivery_city = $request->get('delivery_city');
        $delivery->delivery_county = $request->get('delivery_county');
        $delivery->delivery_postcode = $request->get('delivery_postcode');

        $delivery->collection_address_name = $request->get('collection_address_name');
        $delivery->collection_address_1 = $request->get('collection_address_1');
        $delivery->collection_address_2 = $request->get('collection_address_2');
        $delivery->collection_city = $request->get('collection_city');
        $delivery->collection_country = $request->get('collection_country');
        $delivery->collection_postcode = $request->get('collection_postcode');


        $delivery->save();

        return redirect('delivery/notes/'. $id)->with('success', 'Delivery Address Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAddress($id) {

        $data = array();
        $data['delivery_lots'] = DeliveryLot::where('delivery_id', $id)->get();
        $data['delivery'] = Delivery::find($id);
        $data['id'] = $id;

        $data['title'] = "Edit Delivery Address";


        return view('delivery.editAddress', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAddress($id, Request $request) {
        $delivery = Delivery::find($id);

        $delivery->delivery_address_1 = $request->get('delivery_address_1');
        $delivery->delivery_address_2 = $request->get('delivery_address_2');
        $delivery->delivery_city = $request->get('delivery_city');
        $delivery->delivery_county = $request->get('delivery_county');
        $delivery->delivery_postcode = $request->get('delivery_postcode');

        $delivery->collection_address_name = $request->get('collection_address_name');
        $delivery->collection_address_1 = $request->get('collection_address_1');
        $delivery->collection_address_2 = $request->get('collection_address_2');
        $delivery->collection_city = $request->get('collection_city');
        $delivery->collection_country = $request->get('collection_country');
        $delivery->collection_postcode = $request->get('collection_postcode');

        $delivery->save();
        return Redirect('showAddress' . '/' . $id)->with('success', 'Delivery Address Updated Successfully!');
    }

    public function showAddress($id) {

        $delivery = Delivery::find($id);


//            $d = $users=>id;
//            print_r($users);die;
        $data = array();
        $data['delivery_lots'] = DeliveryLot::where('delivery_id', $id)->get();
        $data['id'] = $id;
        $data['delivery'] = $delivery;
        $data['title'] = "Delivery Address";


        return view('delivery.showAddress', $data);
    }

    public function duplicateDelivery($id) {
        ZnUtilities::push_js_files('components/delivery.js');
        $data = array();

        $delivery = Delivery::find($id);


        $delivery1 = new Delivery();

        //$job_delivery_ids  = Delivery::where('job_delivery_id',$delivery->job_delivery_id)->lists('job_delivery_id');
        $job_delivery_ids = Delivery::where('goodsin_id', $delivery->goodsin_id)->lists('job_delivery_id');
        $job_delivery_id = count($job_delivery_ids) + 1;

        $delivery1->job_delivery_id = $job_delivery_id;
        $delivery1->client_id = $delivery->client_id;
        $delivery1->goodsin_id = $delivery->goodsin_id;
        $delivery1->transport_order_date = $delivery->transport_order_date;
        $delivery1->transport_company_id = $delivery->transport_company_id;
        $delivery1->vehicle_type_id = $delivery->vehicle_type_id;
        $delivery1->approximate_weight = $delivery->approximate_weight;
        $delivery1->agreed_price = $delivery->agreed_price;
        $delivery1->collection_date = $delivery->collection_date;
        $delivery1->collection_time = $delivery->collection_time;
        
        $delivery1->delivery_time = $delivery->delivery_time;
        $delivery1->delivery_date = $delivery->delivery_date;

        $delivery1->invoice_value = $delivery->invoice_value;

        $delivery1->site_contact_details = $delivery->site_contact_details;
        $delivery1->damage_out = $delivery->damage_out;
        $delivery1->loading_charge = $delivery->loading_charge;
        $delivery1->type_of_note = $delivery->type_of_note;
        $delivery1->delivery_address_1 = $delivery->delivery_address_1;
        $delivery1->delivery_address_2 = $delivery->delivery_address_2;
        $delivery1->delivery_city = $delivery->delivery_city;
        $delivery1->delivery_county = $delivery->delivery_county;
        $delivery1->delivery_postcode = $delivery->delivery_postcode;

        $delivery1->collection_address_name = $delivery->collection_address_name;
        $delivery1->collection_address_1 = $delivery->collection_address_1;
        $delivery1->collection_address_2 = $delivery->collection_address_2;
        $delivery1->collection_city = $delivery->collection_city;
        $delivery1->collection_country = $delivery->collection_country;
        $delivery1->collection_postcode = $delivery->collection_postcode;
        $delivery1->collection_note = $delivery->collection_note;
        $delivery1->delivery_note = $delivery->delivery_note;

        $delivery1->save();

        return Redirect('delivery/' . $delivery1->id)->with('success', 'Duplicate Delivery Created Successfully!');
    }

    public function printTransportOrder($id) {
        $data = array();

        $data['title'] = 'Print Transport Order';

//        $data['total_lots'] = Lot::where('goodsin_id', $id)->count();
//        $data['all_lots'] = Lot::where('goodsin_id',$id)->get();
        $delivery = Delivery::find($id);
        $data['delivery'] = $delivery;
        $goodsin_id = $delivery->goodsin_id;

        $data['goodsin'] = GoodsIn::find($goodsin_id);

        $data['lots'] = DeliveryLot::where('delivery_id', $id)->get();
        //ZnUtilities::pa(  $data['lots']);die;
        //  ZnUtilities::push_js_files('components/goodsin.js');
 $pdf = App::make('dompdf.wrapper');
      return $pdf->loadView('delivery.transport_order', $data)->stream();
//  return $pdf->loadView('delivery.transport_order', $data)->download('PrintDelivery.pdf');
//        return $view_content = view('delivery.transport_order', $data);
    }

    public function notes($id) {



        ZnUtilities::push_js_files('plugins/ckeditor/ckeditor.js');
        $editor_js = '$(function() {
                      CKEDITOR.replace("notes");
                      });';
        ZnUtilities::push_js($editor_js);
        ZnUtilities::push_js_files('components/delivery.js');
        $delivery = Delivery::find($id);


        $data = array();

        $data['title'] = "Delivery Notes";
        $data['delivery'] = $delivery;
        $data['id'] = $id;
        return view('delivery.notes', $data);
    }

    public function saveDeliveryNote($id, Request $request) {
        $delivery = Delivery::find($id);
        $data = array();
        $delivery->type_of_note = $request->get('type_of_note');
       $data['note'] = $request->get('notes');
       $data['title'] = 'Print Delivery Notes';
        if ($request->get('type_of_note') == 'delivery_note') {
            $delivery->delivery_note = $request->get('notes');
             $delivery->collection_note ='';
        } else {
            $delivery->delivery_note ='';
            $delivery->collection_note = $request->get('notes');
        }
        $delivery->save();
        
         return view('delivery.printDeliveryNote', $data);   
 }

//     public function printDeliveryNote($id) {
//
//      
//        $delivery = Delivery::find($id);
//         $data = array();
//            if($delivery->delivery_note!=''||$delivery->delivery_note!=NULL){
//               $data['delivery_notes'] = $delivery->delivery_note; 
//            }
//            else if($delivery->collection_note!=''||$delivery->collection_note!=NULL){
//                 $data['delivery_notes'] = $delivery->collection_note; 
//            }
//        $data['title'] = "Print Delivery Notes";
//        $data['delivery'] = $delivery;
//        $data['id'] = $id;
//        return view('delivery.printDeliveryNote', $data);
//    }
 
 
 
 public function printDelivery($id) {
        $data = array();

        $data['title'] = 'Print Delivery';

//        $data['total_lots'] = Lot::where('goodsin_id', $id)->count();
//        $data['all_lots'] = Lot::where('goodsin_id',$id)->get();
        $delivery = Delivery::find($id);
        $data['delivery'] = $delivery;
        $goodsin_id = $delivery->goodsin_id;

        $data['goodsin'] = GoodsIn::find($goodsin_id);

        $data['lots'] = DeliveryLot::where('delivery_id', $id)->get();
        //ZnUtilities::pa(  $data['lots']);die;
        //  ZnUtilities::push_js_files('components/goodsin.js');
  $pdf = App::make('dompdf.wrapper');
      return $pdf->loadView('delivery.print_delivery', $data)->stream();
//  return $pdf->loadView('delivery.print_delivery', $data)->download('PrintDelivery.pdf');
//        return $view_content = view('delivery.print_delivery', $data);
                     
        
    }
 public function printPickingList($id) {
        $data = array();

        $data['title'] = 'Print Picking List';

//        $data['total_lots'] = Lot::where('goodsin_id', $id)->count();
//        $data['all_lots'] = Lot::where('goodsin_id',$id)->get();
        $delivery = Delivery::find($id);
        $data['delivery'] = $delivery;
        $goodsin_id = $delivery->goodsin_id;

        $data['goodsin'] = GoodsIn::find($goodsin_id);

        $data['lots'] = DeliveryLot::where('delivery_id', $id)->get();
        //ZnUtilities::pa(  $data['lots']);die;
        $pdf = App::make('dompdf.wrapper');
      return $pdf->loadView('delivery.print_picking_list', $data)->stream();
//  return $pdf->loadView('delivery.print_picking_list', $data)->download('PrintDelivery.pdf');
//        return $view_content = view('delivery.print_picking_list', $data);
                     
        
    }
 public function printTransportInvoiceRequest($id) {
        $data = array();

        $data['title'] = 'Print Transport Invoice Request';

//        $data['total_lots'] = Lot::where('goodsin_id', $id)->count();
//        $data['all_lots'] = Lot::where('goodsin_id',$id)->get();
        $delivery = Delivery::find($id);
        $data['delivery'] = $delivery;
        $goodsin_id = $delivery->goodsin_id;

        $data['goodsin'] = GoodsIn::find($goodsin_id);
        $client_id = $data['goodsin']->client_id;
        $data['client'] = Client::find($client_id);

        $data['lots'] = DeliveryLot::where('delivery_id', $id)->get();
        //ZnUtilities::pa(  $data['lots']);die;
        //  ZnUtilities::push_js_files('components/goodsin.js');
  $pdf = App::make('dompdf.wrapper');
      return $pdf->loadView('delivery.printTranportInvoice', $data)->stream();
//  return $pdf->loadView('delivery.printTranportInvoice', $data)->download('PrintDelivery.pdf');
     //   return $view_content = view('delivery.printTranportInvoice', $data);
                     
        
    }
    
    
}

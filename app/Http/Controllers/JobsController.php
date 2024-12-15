<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Delivery;
use App\Http\Requests\JobsRequest;
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
use App\Http\Requests\JobLotRequest;

class JobsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        ZnUtilities::push_js_files('components/jobs.js');

        $data = array();
        $data['status'] = 'jobs';
        $data['jobs'] = Job::orderBy('job_id', 'DESC')->paginate();
        $data['title'] = "Jobs";
        return view('jobs.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        ZnUtilities::push_js_files('components/jobs.js');
        $data = array();

        $data['client_names'] = Client::all();
        $data['contact_names'] = Client::all();
        $data['job_types'] = \App\Models\JobType::orderBy('job_type_id', 'ASC')->get();
        $data['service_providers'] = \App\Models\ServiceProvider::orderBy('service_provider', 'ASC')->get();;
        $data['vehicle_types'] = \App\Models\VehicleType::all();
        $job = Job::orderBy('job_id', 'DESC')->first();
        $data['job_number'] = (isset($job)) ? $job->job_id + 1 : '1';
        $data['suppliers'] = Supplier::all();
        $data['title'] = "Create Job";

        return view('jobs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobsRequest $request) {

        $job = new Job();

        $job->client_id = $request->get('client_name');
        $job->client_order_number = $request->get('client_order_number');
        $job->job_type = $request->get('job_type');
        $job->supplier_id = $request->get('supplier_id');
        $job->haulage_company_name = $request->get('haulage_company_name');
        $job->project_name = $request->get('project_name');

        $job->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'), 11);
        if ($request->get('job_type') == 'Daily/Volume') {
            $job->total_volume = $request->get('total_volume');
        }
        $job->handling_charge = $request->get('handling_charge');
        $job->charge_rate = $request->get('charge_rate');
        $job->job_status = 'Active';
        $job->created_by = Auth::user()->id;

        $job->save();

        return redirect('jobs/createLot/' . $job->id)->with('success', 'Job Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $data = array();
        $data['job'] = Job::find($id);
        $data['suppliers'] = Supplier::where('id', $data['job']->supplier_id)->pluck('supplier_name');
//        ZnUtilities::pa($data['suppliers']);die;
        $data['id'] = $id;
        $data['title'] = "Show Job";
        $data['lots'] = Lot::where('job_id', $id)->get();
        $data['job_id'] = $id;

        return view('jobs.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        ZnUtilities::push_js_files('components/jobs.js');
        ZnUtilities::push_js_files('datetimepicker.js');
//        ZnUtilities::push_css_files('datetimepicker.min.css');

        $job = Job::find($id);
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();
        $data['id'] = $id;
        $data['client'] = Client::all();
        $data['suppliers'] = Supplier::all();
        $data['job'] = $job;
        $data['title'] = "Edit Job";
        $data['lots'] = Lot::where('job_id', $id)->get();
        $data['job_id'] = $id;


        return view('jobs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, JobsRequest $request) {

        $job = Job::find($id);

        $job->client_id = $request->get('client_name');
        $job->client_order_number = $request->get('client_order_number');
        $job->job_type = $request->get('job_type');
        $job->supplier_id = $request->get('supplier_id');
        $job->haulage_company_name = $request->get('haulage_company_name');
        $job->project_name = $request->get('project_name');
        $job->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'), 11);
        if ($request->get('job_type') == 'Daily/Volume') {
            $job->total_volume = $request->get('total_volume');
        }
        $job->handling_charge = $request->get('handling_charge');
        $job->charge_rate = $request->get('charge_rate');
        $job->updated_by = Auth::user()->id;

        $job->save();

        return Redirect('/jobs/' . $id . '/edit')->with('success', 'Job Updated Successfully!');
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

    public function jobSearch($search) {


        $job = Job::where("id", "like", "%" . $search . "%")
                ->orWhere("client_order_number", "like", "%" . $search . "%")
                ->orWhere("project_name", "like", "%" . $search . "%")
                ->orWhere("goods_in_date", "like", "%" . ZnUtilities::format_date($search, 11) . "%")
                ->orderBy('id', 'desc')
                ->paginate();

        $data = array();

        $data['jobs'] = $job;
        $data['title'] = "Jobs";
        //Basic Page Settings

        $data['search'] = $search;
        $data['status'] = 'jobs';


        return view('jobs.list', $data);
    }

    public function JobsSearch() {
        //DB::enableQueryLog();
        $keyword = \Input::get('keyword');
        $date_from = \Input::get('date_from');
        $date_to = \Input::get('date_to');
        $job_status = \Input::get('job_status');
        $client_id = \Input::get('client_id');
        $created_by = \Input::get('created_by');


        $jobs = DB::table('goods_in as j');

        //  $jobs->Join('clients as c','c.id','=','j.client_id');

        if ($keyword != '') {
            $keyword = trim($keyword);
            $jobs->orWhere(function ($jobs) use ($keyword) {


                $jobs->where("j.client_order_number", "like", "%" . $keyword . "%")
                        ->orwhere("j.id", "like", "%" . $keyword . "%")
                        ->orwhere("j.supplier_id", "like", "%" . $keyword . "%")
                        ->orwhere("j.haulage_company_name", "like", "%" . $keyword . "%")
                        ->orwhere("j.project_name", "like", "%" . $keyword . "%");
            });
        }
        if ($date_from != '') {
            $date_from_corrected = ZnUtilities::format_date($date_from, 11);
            $jobs->where('j.goods_in_date', '>=', $date_from_corrected);
            $jobs->orderBy('j.goods_in_date', 'asc');
        }

        if ($date_to != '') {
            $date_to_corrected = ZnUtilities::format_date($date_to, 11);
            $jobs->where('j.goods_in_date', '<=', $date_to_corrected);
        }

        if (in_array($job_status, array('Active', 'Archive'))) {
            $jobs->where('j.job_status', $job_status);
        }

        if ($client_id != '') {
            $jobs->where('j.client_id', $client_id);
        }


        if ($created_by != '') {
            $jobs->where('j.created_by', $created_by);
        }




        $jobs->orderBy('j.id', 'desc');


        // $data['all_jobs'] = $jobs->get(array('j.*','c.*'));
//                 echo ZnUtilities::lastQuery();
//                
        //ZnUtilities::pa( $data['all_jobs']);die;

        ZnUtilities::push_js_files('components/jobs.js');


        $data['status'] = 'jobs';
        $data['jobs'] = $jobs->paginate();
        $data['title'] = "Search Results";
        return view('jobs.search', $data);
    }

    public function jobAction(Request $request) {



        $search = $request->get('search');
        if ($search != '') {
            return redirect('/jobSearch/' . $search);
        } else {


            //die(Input::get('bulk_action')   );

            $cid = $request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if ($bulk_action != '') {
                switch ($bulk_action) {
                    case 'archive': {
                            foreach ($cid as $id) {
                                DB::table('jobs')
                                        ->where('id', $id)
                                        ->update(array('job_status' => 'Archive'));
                            }

                            return redirect('/jobs')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
                            foreach ($cid as $id) {
                                DB::table('jobs')
                                        ->where('id', $id)
                                        ->update(array('job_status' => 'Active'));
                            }

                            return redirect('/jobs')->with('success', 'Rows Updated!');
                            break;
                        }
                } //end switch
            } // end if statement
            return redirect('/jobs')->with('fail', 'Please Enter a Keyword');
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
        $data['job_type'] = Job::where('id', $id)->pluck('job_type');
        $data['job'] = Job::find($id);
        $data['lots'] = Lot::where('job_id', $id)->get();

        $lot = Lot::where('job_id', $id)->count();
        $data['items'] = Item::all();

        $data['lot_number'] = (isset($lot)) ? $lot + 1 : '1';

        $data['job_id'] = $id;
        $data['title'] = "Create Lots";

        return view('jobs.lots', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveLot(JobLotRequest $request) {
        if ($request->get('lot_number') > 40) {

            return redirect()->back()->with('fail', "Lots are Full");
        }
        $id = $request->get('job_id');
        $last_lot = Lot::where('job_id', $id)->orderBy('lot_id', 'DESC')->first();
        //ZnUtilities::pa($last_lot->lot_id);die;
        if ((isset($last_lot) ? $last_lot->lot_id : '') != $request->get('job_type')) {
            $lot = new Lot();
            $lot->lot_id = $request->get('lot_number');
            $lot->job_id = $request->get('job_id');
            $lot->job_type = $request->get('job_type');
            $lot->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'), 11);
            $lot->dimension_1 = $request->get('dimension_1');
            $lot->dimension_2 = $request->get('dimension_2');
            $lot->dimension_3 = $request->get('dimension_3');
            $lot->damage_in = $request->get('damage_in');
            $lot->item_id = $request->get('item_id');

            $lot->location = $request->get('location');
            $lot->volume = $request->get('volume');


            $lot->save();
        }

        return redirect('jobs/createLot/' . $id . '/')->with('success', 'Lot Created Successfully');
    }

    public function editLot($id) {
        ZnUtilities::push_js_files('components/lots.js');
        ZnUtilities::push_js_files('chosen.jquery.min.js');
        // ZnUtilities::push_js_files('chosen.jquery.js');
        $js = "$(document).ready(function(){ $('#item_id').chosen();   });";
        ZnUtilities::push_js($js);
        $lot = Lot::find($id);
        $data = array();
        $data['id'] = $id;

        $job = Lot::where('id', $id)->pluck('job_id');
        $data['job_type'] = Job::where('id', $job)->pluck('job_type');
        $job_id = Lot::where('job_id', $job)->get();
        $data['items'] = Item::all();

        $data['job_id'] = $job;
        $data['lot'] = $lot;
        $data['lots'] = $job_id;
        $data['job'] = Job::find($job);
        $data['title'] = "Edit Lot";


        return view('jobs.lot_edit', $data);
    }

    public function updateLot($id, JobLotRequest $request) {
        $lot = Lot::find($id);

        $lot->lot_id = $request->get('lot_number');
        $lot->job_id = $request->get('job_id');
        $lot->goods_in_date = ZnUtilities::format_date($request->get('goods_in_date'), 11);
        $lot->dimension_1 = $request->get('dimension_1');
        $lot->dimension_2 = $request->get('dimension_2');
        $lot->dimension_3 = $request->get('dimension_3');
        $lot->damage_in = $request->get('damage_in');
        $lot->item_id = $request->get('item_id');

        $lot->location = $request->get('location');
        $lot->volume = $request->get('volume');

        $lot->save();

        return Redirect('jobs/createLot/' . $request->get('job_id') . '/')->with('success', 'Lot Updated Successfully!');
    }

    public function lotSearch($search, $id) {


        $lot = Lot::where("lot_id", "like", "%" . $search . "%")
                ->orWhere("job_id", "like", "%" . $search . "%")
                ->orWhere("location", "like", "%" . $search . "%")
                ->orWhere("damage_in", "like", "%" . $search . "%");


        $data = array();
        $data['lots'] = $lot;
        $data['title'] = "All Lots";

        //Basic Page Settings

        $data['search'] = $search;

        return view('jobs.lots', $data);
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
                                        ->where('id', $id)
                                        ->update(array('lot_status' => 'deactive'));
                            }

                            return redirect('/jobs/lots/{{$id}}')->with('success', 'Rows Updated!');

                            break;
                        }
                    case 'active': {
                            foreach ($cid as $id) {
                                DB::table('lots')
                                        ->where('id', $id)
                                        ->update(array('lot_status' => 'active'));
                            }

                            return redirect('/jobs/lots/{{$id}}')->with('success', 'Rows Updated!');
                            break;
                        }
                } //end switch
            } // end if statement
            return redirect('/jobs/lots/{{$id}}')->with('fail', '0Please Enter a Keyword');
        }
    }

    public function invoiceJob($id) {
        $data = array();
        $job = Job::find($id);
        $data['job'] = $job;
        $data['client'] = Client::find($data['job']->client_id);
        $data['lots'] = Lot::where('job_id', $id)->get();
        $data['title'] = "Job Invoice";
        ZnUtilities::push_js_files('components/jobs.js');

        //ZnUtilities::pa($data);die;
        $pdf = App::make('dompdf.wrapper');
        //  return $pdf->loadView('jobs.invoice_job', $data)->stream();
        return $pdf->loadView('jobs.invoice_job', $data)->download('JOB_GIRECEIPT-' . ZnUtilities::format_date($job->goods_in_date, 10) . '.pdf');
    }

    public function archivedJobs() {

        ZnUtilities::push_js_files('components/jobs.js');

        $data = array();
        $data['status'] = 'archiveJobs';
        $data['jobs'] = Job::where('job_status', "archive")->OrderBy('id', 'DESC')->paginate();
        $data['title'] = "Archive Jobs";

        return view('jobs.list', $data);
    }

    public function activeJobs() {
        ZnUtilities::push_js_files('components/jobs.js');

        $data = array();
        $data['status'] = 'activeJobs';
        $data['jobs'] = Job::where('job_status', "active")->OrderBy('id', 'DESC')->paginate();
        $data['title'] = "Active Jobs";

        return view('jobs.list', $data);
    }

    public function labelPrint($id) {
        $data = array();

        $data['title'] = 'Label Print';

        $data['total_lots'] = Lot::where('job_id', $id)->count();
        $data['all_lots'] = Lot::where('job_id', $id)->get();
        $data['job'] = Job::find($id);
//     ZnUtilities::pa($data['job'] );die;
        ZnUtilities::push_js_files('components/jobs.js');

//      $path = "pdf_new";

        return $view_content = view('jobs.label_print', $data);
    }

    public function printSingleLot($id) {
        $data = array();

        $data['title'] = 'Print Single Lot';

        $data['all_lots'] = Lot::find($id);
        $data['job'] = Job::find($data['all_lots']->job_id);
        $data['total_lots'] = Lot::where('job_id', $data['all_lots']->job_id)->count();
        // ZnUtilities::pa($data['all_lots'] );die;
        ZnUtilities::push_js_files('components/jobs.js');



        return $view_content = view('jobs.label_print', $data);
    }

    public function EmailTempCreate($id) {

        $data = array();

        ZnUtilities::push_js_files('pekeUpload.js');
        ZnUtilities::push_js_files('components/jobs.js');
        ZnUtilities::push_js_files('plugins/ckeditor/ckeditor.js');
        $editor_js = '$(function() {
                      CKEDITOR.replace("content");
                      });';
        ZnUtilities::push_js($editor_js);

        $data['job'] = Job::find($id);
        $data['client'] = Client::find($data['job']->client_id);
        $data['lots'] = Lot::where('job_id', $id)->get();
        $data['title'] = "Job Invoice";
        ZnUtilities::push_js_files('components/jobs.js');


        $path = public_path() . '/pdf';
        if (!File::exists('pdf')) {
            File::makeDirectory('pdf', 0775, true);
        }

        // return $view_content = view('jobs.invoice_job', $data);die;


        $pdf = App::make('dompdf.wrapper');
        //return $pdf->loadView('jobs.invoice_job', $data)->stream();
        $pdf->loadView('jobs.invoice_job', $data)->save($path . '/JOB_GIRECEIPT.pdf');
        $data = array();
        $data['filename'] = 'JOB_GIRECEIPT.pdf';
        $data['path'] = $path . '/JOB_GIRECEIPT.pdf';

        $data['title'] = 'Email Template';
        $clientid = Job::where('id', $id)->pluck('client_id');
        $data['clients'] = Client::where('id', $clientid)->first();
        return view('jobs.email_template', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function EmailTemplateStore(EmailRequest $request) {

        $new_message = str_replace('{Client_Name}', $request->recipient_name, $request->content);
        Mail::send('emails.blank', array(
            'content' => $new_message), function($message) use($request) {
            $message->to($request->email_template, "demo")
                    ->subject($request->subject)->attach($request->file_path);
        }
        );

        return redirect('/jobs')->with('success', 'Email Sent Successfully !');
    }

    public function getclientsJobs($client_id) {
        $data = array();
        $data = Job::where('client_id', $client_id)->get()->toJson();
        echo $data;
    }

    public function getJobsDelivery($job_id) {
        $data = array();
        $data = Delivery::where('job_id', $job_id)->get()->toJson();
        echo $data;
    }

    public function ShowDelivery($id) {

        $data = array();
        $data['clients'] = Client::all();
        $data['jobs'] = Job::all();

        $data['search_by_date'] = 'delivery_number';


        $data['deliveries'] = Delivery::where('job_id', $id)->orderBy('id', 'DESC')->paginate(10);
        $project_name = Job::where('id', $id)->pluck('project_name');
        $data['project_name'] = $project_name;

        $data['title'] = "Deliveries For " . $project_name . " [Job Id:$id]";
        ZnUtilities::push_js_files('components/delivery.js');
        return view('delivery.list', $data);
    }

    public function printStockList($id) {
        $data = array();

//        $data['title'] = 'Print Stock List';

        $data['job'] = Job::find($id);

        //  $data['lots'] = DeliveryLot::where('job_id', $id)->where('delivery_type','!=','Full')->get();
//      $array = DeliveryLot::where('job_id', $id)->where('delivery_type','full')->lists('id');
        $data['deliver_lots'] = DeliveryLot::where('job_id', $id)->where('delivery_type', 'Full')->lists('lot_id')->toArray();
//        $delivered_lot =  (array) $array;
//        $data['delivered_lot'] = $delivered_lot;
        $data['lots'] = Lot::where('job_id', $id)->get();
        //ZnUtilities::pa($data['lots']);die;
        ZnUtilities::push_js_files('components/jobs.js');
        $pdf = App::make('dompdf.wrapper');
        return $pdf->loadView('jobs.printStockList', $data)->stream();
        //return $pdf->loadView('jobs.printStockList',$data)->download('StockList.pdf');
        // return $view_content = view('jobs.printStockList', $data);
    }

}

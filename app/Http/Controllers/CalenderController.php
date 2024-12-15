<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Period;
use App\Http\Requests\ClientRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkWeek()
    {
         ZnUtilities::push_js_files('components/calender.js');
        $data =array();
       
      $data['title'] = "Check Week";
      
       return view('calender.check_week',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showWeekDay(Request $request)
    {
        $date = $request->get('select_month');
         
        $datetime = new \DateTime($date);
        $start_date = $datetime->format('01-m-Y');
        $end_date = $datetime->format('t-m-Y');
  $ts1 = strtotime($start_date);
  $ts2 = strtotime($end_date);
     
        $start_date_day = date('D', strtotime($start_date));
        $end_date_day = date('D', strtotime($end_date));

        
            if ($start_date_day == 'Mon') {
                $first_mon_date = $start_date;
            } else {
                $first_mon_date = date('d-m-Y', strtotime('next monday',$ts1));
            }
            
            if ($end_date_day == 'Sun') {
                $last_sun_date = $end_date;
            } else {
                $last_sun_date = date('d-m-Y', strtotime('last sunday',$ts2));
            }
            
        function diff_in_weeks_and_days($from, $to) {
    $day   = 24 * 3600;
    $from  = strtotime($from);
    $to    = strtotime($to) + $day;
    $diff  = abs($to - $from);
    $weeks = floor($diff / $day / 7);
    $days  = $diff / $day - $weeks * 7;
    $out   = array();
    if ($weeks) $out[] = "$weeks Week" . ($weeks > 1 ? 's' : '');
    if ($days)  $out[] = "$days Day" . ($days > 1 ? 's' : '');
    return implode(', ', $out);
}

$week =  diff_in_weeks_and_days($first_mon_date, $last_sun_date); 


 $dates =  $first_mon_date.'-'.$last_sun_date;
$data = array('week'=>$week,'start_date'=>$first_mon_date,'end_date'=>$last_sun_date);
return json_encode($data);
     

//        return redirect('clients')->with('success', 'Client Created Successfully');
    }
    public function getPeriod()
    {
         ZnUtilities::push_js_files('components/calender.js');
        $data =array();
       
      $data['title'] = "Periods";
      $data['periods'] = Period::all();
       return view('calender.periods',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPeriod(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $weeks = $request->get('weeks');
        
       
        $year = $request->get('year');
//        $datetime = new \DateTime($start_date[1]);
//        $year = $datetime->format('Y');
        foreach($start_date as $key=>$s)
        {
        $periods = new Period();    
        $periods->start_date = ZnUtilities::format_date($s,11);
        $periods->end_date = ZnUtilities::format_date($end_date[$key],11);
        $periods->number_of_weeks = $weeks[$key];
        $periods->year = $year;
        $periods->created_by = Auth::user()->id;
        $periods->created_at = date('Y-m-d H:i:s');
        $periods->save();
        
        
        
                
        }
   

        return redirect('periods')->with('success', 'Periods Data Save Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}

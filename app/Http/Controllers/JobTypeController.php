<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobType;
use App\Http\Requests\JobTypeRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ZnUtilities::push_js_files('components/jobtype.js');
         $data=array();
   
   $data['jobtype'] = JobType::orderBy('job_type_id','DESC')->paginate();
          $data['title'] = "Job Types";
          
       return view('jobtype.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data =array();
       
      $data['title'] = "Create Job Type";
      
       return view('jobtype.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobTypeRequest $request)
    {
        
       
        
        
       $jobtype = new JobType();
        $jobtype->job_type = $request->get('job_type');
      
        
        
        $jobtype->save();
        
        return redirect('jobtype')->with('success','Job Type Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
      $jobtype = JobType::find($id);  
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();    
        $data['id'] = $id;
        $data['jobtype'] = $jobtype;
         $data['title'] = "Edit Job Type";
         
           
       return view('jobtype.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, JobTypeRequest $request)
    {
        $jobtype = JobType::find($id);
       
        $jobtype->job_type = $request->get('job_type');
       
        $jobtype->save();
        return Redirect('jobtype')->with('success', 'Job Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
      public function jobTypeSearch($search)
        {
           
               
               $jobtype = JobType::where("job_type","like","%".$search."%")
                        
                            ->paginate(); 
               
               $data = array();
               $data['jobtype'] = $jobtype;
                $data['title'] = "Job Types";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('jobtype.list',$data);
              
           
          
        }
        
        public function jobTypeAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/jobTypeSearch/'.$search);
            }
            else{
                
                
            //die(Input::get('bulk_action')   );
            
            $cid =$request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if($bulk_action!='')
            {
                switch($bulk_action)
                {
                   
                    case 'delete':
                    {
                        
                        
                        foreach($cid as $id)
                        {
                            DB::table('job_types')
                                ->where('job_type_id', $id)
                                ->delete();
                        }
                        
                        return redirect('/jobtype')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/jobtype')->with('fail','Please Enter a Keyword');
            }
        }
}

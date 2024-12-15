<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use App\Http\Requests\VehicleTypeRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ZnUtilities::push_js_files('components/vehicletype.js');
         $data=array();
   
   $data['vehicletype'] = VehicleType::orderBy('id','DESC')->paginate();
          $data['title'] = "Vehicle Type";
          
       return view('vehicletype.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data =array();
       
      $data['title'] = "Create Vehicle Type";
      
       return view('vehicletype.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleTypeRequest $request)
    {
        
       
        
        
       $vehicletype = new VehicleType();
        $vehicletype->vehicle_type = $request->get('vehicle_type');
      
        
        
        $vehicletype->save();
        
        return redirect('vehicletype')->with('success','Vehicle Type Created Successfully');
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
       
      $vehicletype = VehicleType::find($id);  
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();    
        $data['id'] = $id;
        $data['vehicletype'] = $vehicletype;
         $data['title'] = "Edit Vehicle Type";
         
           
       return view('vehicletype.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, VehicleTypeRequest $request)
    {
        $vehicletype = VehicleType::find($id);
       
        $vehicletype->vehicle_type = $request->get('vehicle_type');
       
        $vehicletype->save();
        return Redirect('vehicletype')->with('success', 'Vehicle Type Updated Successfully!');
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
    
      public function vehicleTypeSearch($search)
        {
           
               
               $vehicletype = VehicleType::where("vehicle_type","like","%".$search."%")
                        
                            ->paginate(); 
               
               $data = array();
               $data['vehicletype'] = $vehicletype;
                $data['title'] = "Vehicle Type";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('vehicletype.list',$data);
              
           
          
        }
        
        public function vehicleTypeAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/vehicleTypeSearch/'.$search);
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
                            DB::table('vehicle_type_old')
                                ->where('id', $id)
                                ->delete();
                        }
                        
                        return redirect('/vehicletype')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/vehicletype')->with('fail','Please Enter a Keyword');
            }
        }
}

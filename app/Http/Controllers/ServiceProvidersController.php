<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Http\Requests\ServiceProviderRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        
        
        
        
        
        ZnUtilities::push_js_files('components/serviceprovider.js');
         $data=array();
   
   $data['serviceProviders'] = ServiceProvider::orderBy('service_provider_id','DESC')->paginate();
          $data['title'] = "Service Providers";
          
       return view('serviceprovider.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data =array();
       
      $data['title'] = "Create Service Provider";
      
       return view('serviceprovider.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceProviderRequest $request)
    {
        
       
        
        
       $serviceProviders = new ServiceProvider();
        $serviceProviders->service_provider = $request->get('service_provider');
        $serviceProviders->sp_address_1 = $request->get('sp_address_1');
        $serviceProviders->sp_address_2 = $request->get('sp_address_2');
        $serviceProviders->sp_city = $request->get('sp_city');
        $serviceProviders->sp_postcode = $request->get('sp_postcode');
      
        
        
        $serviceProviders->save();
        
        return redirect('serviceProviders')->with('success','Service Provider Created Successfully');
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
       
      $serviceProviders = ServiceProvider::find($id);  
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();    
        $data['id'] = $id;
        $data['serviceProviders'] = $serviceProviders;
         $data['title'] = "Edit Service Provider";
         
           
       return view('serviceprovider.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, ServiceProviderRequest $request)
    {
        $serviceProviders = ServiceProvider::find($id);
    
       $serviceProviders->service_provider = $request->get('service_provider');
        $serviceProviders->sp_address_1 = $request->get('sp_address_1');
        $serviceProviders->sp_address_2 = $request->get('sp_address_2');
        $serviceProviders->sp_city = $request->get('sp_city');
        $serviceProviders->sp_postcode = $request->get('sp_postcode');
        $serviceProviders->save();
        
        return Redirect('serviceProviders')->with('success', 'Service Provider Updated Successfully!');
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
    
      public function serviceProviderSearch($search)
        {
           
               
               $serviceProviders = ServiceProvider::where("service_provider","like","%".$search."%")
               ->orWhere("service_provider","like","%".$search."%")
               ->orWhere("service_provider","like","%".$search."%")
               ->orWhere("service_provider","like","%".$search."%")
               ->orWhere("service_provider","like","%".$search."%")
                        
                            ->paginate(); 
               
               $data = array();
               $data['serviceProviders'] = $serviceProviders;
                $data['title'] = "Service Providers";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('serviceprovider.list',$data);
              
           
          
        }
        
        public function serviceProviderAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/serviceProviderSearch/'.$search);
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
                            DB::table('service_providers')
                                ->where('service_provider_id', $id)
                                ->delete();
                        }
                        
                        return redirect('/serviceProviders')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/serviceProviders')->with('fail','Please Enter a Keyword');
            }
        }
}

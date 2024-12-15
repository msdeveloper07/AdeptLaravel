<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Http\Requests\ClientRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ZnUtilities::push_js_files('components/clients.js');
         $data=array();
   
   $data['clients'] = Client::orderBy('id','DESC')->paginate();
          $data['title'] = "Clients";
          
       return view('clients.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data =array();
       
      $data['title'] = "Create Client";
      
       return view('clients.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        
       
        
        
       $client = new Client();
        $client->client_name = $request->get('client_name');
        $client->contact_name = $request->get('contact_name');
        $client->client_address_line_1 = $request->get('client_address_line_1');
        $client->client_address_line_2 = $request->get('client_address_line_2');
        $client->city = $request->get('city');
        $client->county = $request->get('county');
        $client->postcode = $request->get('postcode');
        $client->phone = $request->get('phone');
      
        $client->email = $request->get('email');
        $client->client_status = $request->get('client_status');
        $client->created_by = Auth::User()->id;
        
        
        $client->save();
        
        return redirect('clients')->with('success','Client Created Successfully');
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
       
      $client = Client::find($id);  
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();    
        $data['id'] = $id;
        $data['client'] = $client;
         $data['title'] = "Edit Client";
         
           
       return view('clients.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,  ClientRequest $request)
    {
        $client = Client::find($id);
       
        $client->client_name = $request->get('client_name');
        $client->contact_name = $request->get('contact_name');
        $client->client_address_line_1 = $request->get('client_address_line_1');
        $client->client_address_line_2 = $request->get('client_address_line_2');
        $client->city = $request->get('city');
        $client->county = $request->get('county');
        $client->postcode = $request->get('postcode');
        $client->phone = $request->get('phone');
      
        $client->email = $request->get('email');
        $client->client_status = $request->get('client_status');
        $client->updated_by = Auth::User()->id;
        
        $client->save();
        return Redirect('clients')->with('success', 'Client Updated Successfully!');
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
    
      public function clientSearch($search)
        {
           
               
               $client = Client::where("client_name","like","%".$search."%")
                            ->orWhere("contact_name","like","%".$search."%")
                            ->orWhere("email","like","%".$search."%")
                           
                            ->orWhere("phone","like","%".$search."%")
                          
                            ->paginate(); 
               
               $data = array();
               $data['clients'] = $client;
                $data['title'] = "Clients";
                //Basic Page Settings
               
               $data['search'] = $search;
            
              return view('clients.list',$data);
              
           
          
        }
        
        public function clientAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/clientSearch/'.$search);
            }
            else{
                
                
            //die(Input::get('bulk_action')   );
            
            $cid =$request->get('cid');
            $bulk_action = $request->get('bulk_action');
            if($bulk_action!='')
            {
                switch($bulk_action)
                {
                    case 'blocked':
                    {
                        foreach($cid as $id)
                        {
                            DB::table('clients')
                                ->where('id', $id)
                                ->update(array('client_status' =>  'deactive'));
                        }
                       
                       return redirect('/clients')->with('success', 'Rows Updated!');

                        break;
                    }
                    case 'active':
                    {
                        foreach($cid as $id)
                        {
                            DB::table('clients')
                                ->where('id', $id)
                                ->update(array('client_status' =>  'active'));
                        }
                        
                       return redirect('/clients')->with('success', 'Rows Updated!');
                       break;
                    }
                    case 'delete':
                    {
                        
                        
                        foreach($cid as $id)
                        {
                            DB::table('clients')
                                ->where('id', $id)
                                ->delete();
                        }
                        
                        return redirect('/clients')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/clients')->with('fail','Please Enter a Keyword');
            }
        }
}

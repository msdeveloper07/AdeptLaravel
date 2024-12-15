<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transporter;
use App\Http\Requests\TransporterRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ZnUtilities::push_js_files('components/transporter.js');
         $data=array();
   
   $data['transporter'] = Transporter::orderBy('id','DESC')->paginate();
          $data['title'] = "Transport Companies";
          
       return view('transporter.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data =array();
       
      $data['title'] = "Create Transport Company";
      
       return view('transporter.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransporterRequest $request)
    {
        
         
       $transporter = new Transporter();
        $transporter->company_name = $request->get('company_name');
        $transporter->address_line_1 = $request->get('address_line_1');
        $transporter->address_line_2 = $request->get('address_line_2');
        $transporter->city = $request->get('city');
        $transporter->county = $request->get('county');
       
        $transporter->postcode = $request->get('postcode');
       
        $transporter->save();
        
        return redirect('transporter')->with('success','Transport Company Created Successfully');
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
       
      $transporter = Transporter::find($id);  

        $data = array();    
        $data['id'] = $id;
        $data['transporter'] = $transporter;
         $data['title'] = "Edit Transport Company";
         
           
       return view('transporter.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, TransporterRequest $request)
    {
        $transporter = Transporter::find($id);
       
        $transporter->company_name = $request->get('company_name');
        $transporter->address_line_1 = $request->get('address_line_1');
        $transporter->address_line_2 = $request->get('address_line_2');
        $transporter->city = $request->get('city');
        $transporter->county = $request->get('county');
     
        $transporter->postcode = $request->get('postcode');
       
        
        $transporter->save();
        
        return Redirect('transporter')->with('success', 'Transport Company Updated Successfully!');
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
    
      public function transporterSearch($search)
        {
           
               
               $transporter = Transporter::where("company_name","like","%".$search."%")
                           
                            ->paginate(); 
               
               $data = array();
               $data['transporter'] = $transporter;
                $data['title'] = "Transport Companies";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('transporter.list',$data);
              
           
          
        }
        
        public function transporterAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/transporterSearch/'.$search);
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
                            DB::table('transport_companies')
                                ->where('id', $id)
                                ->delete();
                        }
                        
                        return redirect('/transporter')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/transporter')->with('fail','Please Enter a Keyword');
            }
        }
}

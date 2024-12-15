<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();        
        $data['title'] = "Suppliers";
        
        ZnUtilities::push_js_files('components/supplier.js');
       
   
        $data['suppliers'] = Supplier::orderBy('id','DESC')->paginate();
         
       return view('suppliers.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['title'] = "Create Supplier";
        
        return view('suppliers.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
           
        $supplier = new Supplier();
        $supplier->supplier_name = $request->get('supplier_name');
        $supplier->contact_name = $request->get('contact_name');
        $supplier->email = $request->get('email');
//        $supplier->supplier_status = $request->get('supplier_status');
        $supplier->created_by = Auth::User()->id;
        
        
        $supplier->save();
        
        return redirect('suppliers')->with('success','Supplier Created Successfully');
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
       
       
      $supplier = Supplier::find($id);  

      //print_r($supplier); die()
      
        $data = array();    
        $data['id'] = $id;
        $data['supplier'] = $supplier;
        
        $data['title'] = "Edit Supplier";
           
       return view('suppliers.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,  SupplierRequest $request)
    {
        $supplier = Supplier::find($id);
       
        $supplier->supplier_name = $request->get('supplier_name');
        $supplier->contact_name = $request->get('contact_name');
        $supplier->email = $request->get('email');
//        $supplier->supplier_status = $request->get('supplier_status');
        $supplier->updated_by = Auth::User()->id;
        
        $supplier->save();
        return Redirect('suppliers')->with('success', 'Supplier Updated Successfully!');
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
    
      public function supplierSearch($search)
        {
               $supplier = Supplier::where("supplier_name","like","%".$search."%")
                            ->orWhere("contact_name","like","%".$search."%")
                            ->orWhere("email","like","%".$search."%")
                            ->paginate(); 
               
               $data = array();
               $data['suppliers'] = $supplier;
                //Basic Page Settings
               
               $data['title'] = "Search Results";
               
               $data['search'] = $search;

              return view('suppliers.list',$data);
              
           
          
        }
        
        public function supplierAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/supplierSearch/'.$search);
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
                            DB::table('suppliers')
                                ->where('id', $id)
                                ->update(array('supplier_status' =>  'deactive'));
                        }
                       
                       return redirect('/suppliers')->with('success', 'Rows Updated!');

                        break;
                    }
                    case 'active':
                    {
                        foreach($cid as $id)
                        {
                            DB::table('suppliers')
                                ->where('id', $id)
                                ->update(array('supplier_status' =>  'active'));
                        }
                        
                       return redirect('/suppliers')->with('success', 'Rows Updated!');
                       break;
                    }
                    case 'delete':
                    {
                        
                        
                        foreach($cid as $id)
                        {
                            DB::table('suppliers')
                                ->where('id', $id)
                                ->delete();
                        }
                        
                        return redirect('/suppliers')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/suppliers')->with('fail','Please Enter a Keyword');
            }
        }
}

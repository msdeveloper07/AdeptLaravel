<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Http\Requests\ItemRequest;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ZnUtilities::push_js_files('components/items.js');
         $data=array();
   
   $data['items'] = Item::orderBy('item_name')->paginate();
          $data['title'] = "Items";
          
       return view('items.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data =array();
       
      $data['title'] = "Create Item";
      
       return view('items.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        
       
        
        
       $items = new Item();
        $items->item_name = $request->get('item_name');
      
        
        
        $items->save();
        
        return redirect('items')->with('success','Item Created Successfully');
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
       
      $item = Item::find($id);  
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();    
        $data['id'] = $id;
        $data['item'] = $item;
         $data['title'] = "Edit Item";
         
           
       return view('items.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,  ItemRequest $request)
    {
        $item = Item::find($id);
       
        $item->item_name = $request->get('item_name');
       
        $item->save();
        return Redirect('items')->with('success', 'Item Updated Successfully!');
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
    
      public function itemSearch($search)
        {
           
               
               $items = Item::where("item_name","like","%".$search."%")
                        
                           ->orderBy('item_name')->paginate(); 
               
               $data = array();
               $data['items'] = $items;
                $data['title'] = "Items";
                //Basic Page Settings
               
               $data['search'] = $search;

              return view('items.list',$data);
              
           
          
        }
        
        public function itemAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/itemSearch/'.$search);
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
                            DB::table('items')
                                ->where('id', $id)
                                ->delete();
                        }
                        
                        return redirect('/items')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/items')->with('fail','Please Enter a Keyword');
            }
        }
}

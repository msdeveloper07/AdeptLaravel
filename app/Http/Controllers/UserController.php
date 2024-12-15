<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Eloquent\Collection;
use \App\Libraries\ZnUtilities;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ZnUtilities::push_js_files('components/users.js');
         $data=array();
   
   $data['users'] = User::orderBy('id','DESC')->paginate();
   $data['title'] = "Users";
//         echo "<pre>";
//         print_r($data['users']);
//         die();
       return view('users.list',$data);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data=array();
        
       
     
    
   $data['usergroup'] = UserGroup::all();
     
        $data['title'] = "Create User";
       return view('users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
       $activation_code= ZnUtilities::random_string('alphanumeric','50');
        
        
       $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_group_id = $request->get('user_group_id');
        $user->user_status = $request->get('user_status');
        $user->activation_code  = $activation_code;
        $user->save();
        
        Mail::send('emails.newUserActivation', 
                        array(
                            'name'=>$request->get('name'),
                            'activation_code'=>$activation_code), 
                        function($message) use ($request) {
                            $message->to($request->get('email'), $request->get('name'))
                                    ->subject('Your account has been created');
                            }
                    );
        
        return redirect('users')->with('success','User Created Successfully');
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
       $usergroup = UserGroup::all();
      
       
      $user = User::find($id);  
//            $d = $users=>id;
//            print_r($users);die;
        $data = array();    
        $data['id'] = $id;
        $data['user'] = $user;
        $data['usergroup'] = $usergroup;
         $data['title'] = "Edit User";
       return view('users.edit',$data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,  UserRequest $request)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->user_group_id = $request->get('user_group_id');
        $user->user_status = $request->get('user_status');
        $user->save();
        return Redirect('users')->with('success','User Updates Successfully');
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
    public function userSearch($search)
        {
           
               
               $user = User::where("name","like","%".$search."%")
                            ->orWhere("email","like","%".$search."%")
                            ->paginate(); 
               
               $data = array();
               $data['users'] = $user;
                //Basic Page Settings
               
               $data['search'] = $search;
                 $data['title'] = "Users";
              
              return view('users.list',$data);
               
           
          
        }
        
        public function userAction(Request $request)
        {
            
            
            $search = $request->get('search');
            if($search!='')
            {
                return redirect('/userSearch/'.$search);
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
                            DB::table('users')
                                ->where('id', $id)
                                ->update(array('user_status' =>  'deactive'));
                        }
                       
                       return redirect('/users')->with('success', 'Rows Updated!');

                        break;
                    }
                    case 'active':
                    {
                        foreach($cid as $id)
                        {
                            DB::table('users')
                                ->where('id', $id)
                                ->update(array('user_status' =>  'active'));
                        }
                        
                       return redirect('/users')->with('success', 'Rows Updated!');
                       break;
                    }
                    case 'delete':
                    {
                        
                        
                        foreach($cid as $id)
                        {
                            DB::table('users')
                                ->where('id', $id)
                                ->delete();
                        }
                        
                        return redirect('/users')->with('success', 'Row Deleted Successfully!');
                        break;
                    }
                } //end switch
            } // end if statement
            return redirect('/users')->with('fail','Please Enter a Keyword');
            }
        }
}

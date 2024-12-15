<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Setting;
use App\Libraries\ZnUtilities;

class SettingsController extends Controller
{
    
        public function index()
	{
            // Check if user has permission to access this page
         
            
            $data = array();
            $data['settings'] = Setting::orderBy('id','DESC')->get();
             $data['title'] = "All Settings";
             
              ZnUtilities::push_js_files('plugins/ckeditor/ckeditor.js');
        $editor_js = '$(function() {
                      CKEDITOR.replace("#.ckeditor");
                      });';
        ZnUtilities::push_js($editor_js);
          
            return View('settings.list',$data);
	}
        
        public function store(Request $request)
        {
            
           
                $setting = new Setting();
                $setting->setting_name = $request->get('setting_name');
                if($request->get('is_editor')==0){
                $setting->setting_value = strip_tags($request->get('setting_value'));
                }
                else{
                  $setting->setting_value = $request->get('setting_value');  
                }
                $setting->is_editor = $request->get('is_editor');
                $setting->save();
                 
                return Redirect($_SERVER['HTTP_REFERER'])->with('success', 'New Setting Saved Successfully!');
            
             
        }
        
        public function update(Request $request)        {
            // Check if user has permission to access this page
           
                foreach($request->get('setting_value') as $key=>$s)
                {
                    $setting = Setting::find($key);
                    if($setting->is_editor==0){
                        $setting->setting_value = strip_tags($s[0]);
                    }
                    else{
                      $setting->setting_value = $s[0];  
                    }
                    
                    $setting->save();
                }
               
                 
                return Redirect('settings')->with('success', 'Setting Updated Successfully!');
            
        }
        
              

}


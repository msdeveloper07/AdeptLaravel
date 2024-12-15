<?php


namespace App\Libraries;


class ZnUtilities {

     //Print Array
    public static function pa($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    public static function push_js($js) {
        
        
        if ($js != '') {
           // $_SESSION['JS_script'][] = $js;
           \Illuminate\Support\Facades\Session::push('JS_script', $js);
        }
    }
    
    public static function load_js() {
        if (\Illuminate\Support\Facades\Session::has('JS_script'))
        {
            foreach (\Illuminate\Support\Facades\Session::get('JS_script') as $js) {
                echo '<script type="text/javascript">' . $js . '</script>' . "\n";
            }
            
            \Illuminate\Support\Facades\Session::forget('JS_script');
        }
    }
      public static function push_js_files($file) {
        if ($file != '') {
           // $_SESSION['JS'][] = $file;
           \Illuminate\Support\Facades\Session::push('JS', $file);
        }
    }
    public static function load_js_files() {
        
         if (\Illuminate\Support\Facades\Session::has('JS'))
        {
            foreach (\Illuminate\Support\Facades\Session::get('JS') as $js) {
              if (strpos($js, 'http') === FALSE) {
                    echo '<script src="' . url() . "/assets/js/" . $js . '" type="text/javascript"></script>' . "\n";
                } else {
                    echo '<script src="' . $js . '" type="text/javascript"></script>' . "\n";
                }
            }
            
            \Illuminate\Support\Facades\Session::forget('JS');
        }
    }
     public static function push_css_files($file) {
        if ($file != '') {
            //$_SESSION['CSS'][] = $file; 
            \Illuminate\Support\Facades\Session::push('CSS', $file);
        }
        
    }

    public static function load_css_files() {
        /*if ((isset($_SESSION['CSS'])) && count($_SESSION['CSS']) > 0) {
            foreach ($_SESSION['CSS'] as $css) {
                echo '<link href="' . base_url() . "css/" . $css . '" type="text/stylesheet" rel="stylesheet" />' . "\n";
            }
        }
        unset($_SESSION['CSS']);
        */
        
         if (\Illuminate\Support\Facades\Session::has('CSS'))
        {
            foreach (\Illuminate\Support\Facades\Session::get('CSS') as $css) {
              if (strpos($css, 'http') === FALSE) {
                    echo '<link href="' . url() . "/assets/css/" . $css . '" rel="stylesheet" type="text/stylesheet" />' . "\n";
                } else {
                    echo '<link href="' . $css . '" rel="stylesheet" type="text/css" />' . "\n";
                }
            }
            
            \Illuminate\Support\Facades\Session::forget('CSS');
        }
        
        
    }
    
      
    public static function format_date($date,$type=null)
{
    switch($type)
    {
        case 1:
        default:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('Y-m-d');// return a date in format like JAN 01 2009
                break;
            }
        case 2:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('M d, Y');// return a date in format like JAN 01 2009
                break;
            }
        case 3:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('M d, Y H:i A ');// return a date in format like 14:45 JAN 01
                break;
            }
        case 4:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('H:i A ');// return a date in format like 14:45 JAN 01
                break;
            }
        case 5:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('Y-m-d');// return a date in format like 2015-12-27
                break;
            }
        case 6:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('Y');// return a date in format like 2015-12-27
                break;
            }
        case 7:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('m');// return a date in format like 2015-12-27
                break;
            }
        case 8:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('M');// return a date in format like 2015-12-27
                break;
            }
        case 9:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('d');// return a date in format like 2015-12-27
                break;
            }
        case 10:
            {
                $datetime = new \DateTime($date);
                $new_date = $datetime->format('d-m-Y');// return a date in format like 27-12-2015
                break;
            }
        case 11:
            {
                  $datetime = new \DateTime($date);
                 // $date2 = preg_replace('/\D/','/',$date);// return 12-27-2015 to 2015-12-27
                $new_date = $datetime->format('Y-m-d');// return a date in format like 2015-12-27
                //$new_date = date('Y-m-d',strtotime($new_date));
           
                 break;
            }
       
    }

    return $new_date;
}

public static function lastQuery()
{
    
    $queries = \DB::getQueryLog();
    
    
    $last_query = end($queries);
            
    $bindings = array();
    
    foreach($last_query['bindings'] as $b)
    {
        $bindings[] = "'".$b."'";
    }
    
    return str_replace_array('\?',$bindings, $last_query['query']);
    //echo str_replace_array('\?', "'".$last_query['bindings']."'", $last_query['query']);
}


 public static function random_string($type = "string", $random_string_length = '8') {
        $alphabets = 'abcdefghijklmnopqrstuvwxyz';
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $numbers = '0123456789';
        $sentance = 'abcdefghijklmnopqrstuvwxyz0123456789 .,-';


        $string = '';
        for ($i = 0; $i < $random_string_length; $i++) {

            if (($type == "string") || ($type == "alphabets"))
                $string .= $alphabets[rand(0, strlen($alphabets) - 1)];
            elseif ($type == "alphanumeric")
                $string .= $characters[rand(0, strlen($characters) - 1)];
            elseif ($type == "email")
                $string .= $characters[rand(0, strlen($characters) - 1)];
            elseif ($type == "sentance")
                $string .= $sentance[rand(0, strlen($sentance) - 1)];
            elseif ($type == "numbers")
                $string .= $numbers[rand(0, strlen($numbers) - 1)];
}

        if ($type == "email") {
            $string .= "@gmail.com";
        }
        return $string;
    }

}
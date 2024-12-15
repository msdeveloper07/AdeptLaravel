$(document).ready(function(){
  $("#bulk_action").change(function(){
     if($("input:checkbox:checked").length>0) 
     {
        if( $('#bulk_action').val()=="delete")
        {
          var confirm_action =  confirm("Do you really want to delete selected rows");
          if(confirm_action==true){
              $("#actions_form").submit();
          }
          else
           {
                $('#bulk_action').val('');
           }
              
        }
        else
        {    
            $("#actions_form").submit();
        }    
      }  
     else{
         $('#bulk_action').val('');
         alert("No row selected");
     }
  });
});


//Toggle checkboxes state
$(document).ready(function(){   
    
    
    // add multiple select / deselect functionality
    $("#checkall").click(function () {
          $('.check').prop('checked', this.checked);
    });

    
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".check").click(function(){
 
        if($(".check").length == $(".check:checked").length) {
            $("#checkall").prop("checked", "checked");
        } else {
            //$("#checkall").removeAttr("checked");
            $("#checkall").prop("checked",'');
        }
 
    });
});


function confirm_delete(root_url,id)
{
   // alert(id);
    var confirm_action =  confirm("Do you really want to delete this user");
    if(confirm_action==true){
      location.href=root_url+'/users/delete/'+id;
    }
    
}

$(function()
{
    $('#goods_in_date').datepicker({dateFormat: 'dd-mm-yy'});
    //$('#date_to').datepicker({dateFormat: 'M dd, yy'});
}); 

$( "#handling_charge" ).blur(function() {
    
    var amount = parseFloat($("#handling_charge").val());
    console.log(amount);
    if((amount !== null||amount !== undefined)&& $.isNumeric(amount)){
  $("#handling_charge").val(amount.toFixed(2));
    }
    else{
      $("#handling_charge").val('0.00');  
    }
    
});
$( "#charge_rate" ).blur(function() {
  //  $("#charge_rate").val('0'); 
    var amount1 = parseFloat($("#charge_rate").val());
    if((amount1 !== undefined || amount1 !== null)&& $.isNumeric(amount1)){
  $("#charge_rate").val(amount1.toFixed(2));
    }
    else{
      $("#charge_rate").val('0.00');  
    }
});
$( "#total_volume" ).blur(function() {
  //  $("#charge_rate").val('0'); 
    var total_vol= parseFloat($("#total_volume").val());
    if((total_vol !== undefined || total_vol !== null)&& $.isNumeric(total_vol)){
  $("#total_volume").val(total_vol.toFixed(2));
    }else{
       $("#total_volume").val(''); 
    }
    
});

$(document).ready(function(){  
  $('#goodsin_type').change(function(){
var type;
type = $("#goodsin_type").val();
var daily = $("#daily_charge_rate").val();
var weekly = $("#weekly_charge_rate").val();

    if(type=='Daily/Volume')
    {
        $("#total_vol").show();
        $("#charge_rate").val(daily);
      
    }
    else if(type=='Weekly/Dimension'){
          $("#total_vol").hide();
          $("#charge_rate").val(weekly);
        
       
       }
});
});

window.onload = function(){
var type;
type = $("#job_type").val();
    if(type=='Weekly/Dimension'){
          $("#total_vol").hide();
         
       }
}; 

//function isNumberKey(evt){
//   
//    var charCode = (evt.which) ? evt.which : event.keyCode
//     if (    ( charCode != 46 || $(this).val().indexOf('.') != -1 ) 
//        && (charCode > 31 && (charCode < 48 || charCode > 57)) 
//        || ( $(this).val().indexOf('.') == 0) 
//      )
//  
//        return false;
//    
//    return true;
//}
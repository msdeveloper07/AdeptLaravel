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


$(document).ready(function(){   
var type;
type = $("#goodsin_type").val();
    if(type=='Daily/Volume')
    {
        $("#dimensions").hide();
      
    }
    else if(type=='Weekly/Dimension'){
        $("#dimensions").show();
       
       }
});

$( "#dimension_1").blur(function() {
   
//   if($("#dimension_1").val()<1000&& $("#dimension_2").val()> -1){
//       $("#dimension_1").val('1000');
//   }
   
    var dimension_1 = $("#dimension_1").val();
    var dimension_2 = $("#dimension_2").val();
    var dimension_3 = $("#dimension_3").val();

    var volume = $("#volume").val();
     if(dimension_1 === undefined || dimension_1 === null||dimension_1 == 0){
         dimension_1 = 1;
     }
     if(dimension_2 === undefined || dimension_2 === null||dimension_2 == 0){
         dimension_2 = 1;
     }
     if(dimension_3 === undefined || dimension_3 === null||dimension_3 == 0){
         dimension_3 = 1;
     }
       
   var volume = (dimension_1 * dimension_2 * dimension_3 / 1000000000).toFixed(2);

     if((volume >=1) && $.isNumeric(volume)){
        $('#volume').val(parseFloat(volume).toFixed(2));
    }
    else{
      $('#volume').val(parseFloat('1').toFixed(2))  
    }
    });
$( "#dimension_2").blur(function() {
   
  
//   if($("#dimension_2").val()<1000 && $("#dimension_2").val()> -1){
//       $("#dimension_2").val('1000')
//   }
   
    var dimension_1 = $("#dimension_1").val();
    var dimension_2 = $("#dimension_2").val();
    var dimension_3 = $("#dimension_3").val();
    
    var volume = $("#volume").val();
     if(dimension_1 === undefined || dimension_1 === null||dimension_1 == 0){
         dimension_1 = 1;
     }
     if(dimension_2 === undefined || dimension_2 === null||dimension_2 == 0){
         dimension_2 = 1;
     }
     if(dimension_3 === undefined || dimension_3 === null||dimension_3 == 0){
         dimension_3 = 1;
     }
    
   var volume = (dimension_1 * dimension_2 * dimension_3 / 1000000000).toFixed(2);

     if((volume >=1) && $.isNumeric(volume)){
        $('#volume').val(parseFloat(volume).toFixed(2));
    }
    else{
      $('#volume').val(parseFloat('1').toFixed(2))  
    }
    });
$( "#dimension_3").blur(function() {
   
   
//   if($("#dimension_3").val()<1000 && $("#dimension_3").val()> -1){
//       $("#dimension_3").val('1000');
//   }
    var dimension_1 = $("#dimension_1").val();
    var dimension_2 = $("#dimension_2").val();
    var dimension_3 = $("#dimension_3").val();
    
    var volume = $("#volume").val();
     if(dimension_1 === undefined || dimension_1 === null||dimension_1 == 0){
         dimension_1 = 1;
     }
     if(dimension_2 === undefined || dimension_2 === null||dimension_2 == 0){
         dimension_2 = 1;
     }
     if(dimension_3 === undefined || dimension_3 === null||dimension_3 == 0){
         dimension_3 = 1;
     }
 
    var volume = (dimension_1 * dimension_2 * dimension_3 / 1000000000).toFixed(2);
//        alert(volume);
     if((volume >=1) && $.isNumeric(volume)){
        $('#volume').val(parseFloat(volume).toFixed(2));
    }
    else{
      $('#volume').val(parseFloat('1').toFixed(2))  
    }
    });

$('#volume').blur(function(){
    var volume = $("#volume").val();
    if((volume >=1) && $.isNumeric(volume)){
        $('#volume').val(parseFloat(volume).toFixed(2));
    }
    else{
      $('#volume').val(parseFloat(volume).toFixed(2))  
    }
});
 
 
 $( "#loading_charge" ).blur(function() {
    
    var amount = parseFloat($("#loading_charge").val());
    
    if(amount !== undefined || amount !== null){
  $("#loading_charge").val(amount.toFixed(2));
    }
    
});
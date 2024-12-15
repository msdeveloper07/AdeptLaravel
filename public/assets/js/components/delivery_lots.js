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
    $('#transport_order_date').datepicker({dateFormat: 'dd-mm-yy'});
    $('#collection_date').datepicker({dateFormat: 'dd-mm-yy'});
    $('#delivery_date').datepicker({dateFormat: 'dd-mm-yy'});
   $('#search_date').datepicker({ changeMonth:true,changeYear:true, dateFormat: 'dd-mm-yy'});
//    $('#delivery_date').datepicker({minDate : 0,dateFormat: 'yy-mm-dd'});
 
}); 

  $(document).ready(function(){

    $('#client_id').change(function(){
    
          //alert($(this).val());
       var val = $(this).val();
     
        $.getJSON( "/ajax/clients/goodsin/"+val, function( data ) {
           
           $('#goodsin_id').empty();
            $('#goodsin_delivery_id').empty();
           $.each(data,function(index,value){
               if(index ==0){
               $.getJSON( "/ajax/goodsin/delivery/"+value.id, function( data1 ) {
           console.log(data1);
           if(data1.length == 0){
           
           $('#goodsin_delivery_id').val('1');
           }
           else{
               var count = data1.length + 1;
                $('#goodsin_delivery_id').val(count);
           }
         });
     }   
               var opt = $('<option>'); 
               opt.val(value.id);
            opt.text(value.id);
            
            $('#goodsin_id').append(opt); 
           });
         });
              
    })

}); 
$(document).ready(function(){

    $('#goodsin_id').change(function(){
    
    
      //  alert($(this).val());
       var val = $(this).val();
     
        $.getJSON( "/ajax/goodsin/delivery/"+val, function( data ) {
           console.log(data);
           if(data.length == 0){
           
           $('#goodsin_delivery_id').val('1');
           }
           else{
               var count = data.length + 1;
                $('#goodsin_delivery_id').val(count);
           }
         });
              
    })

}); 
$( "#loading_charge" ).blur(function() {
    
    var amount = parseFloat($("#loading_charge").val());
    
    if((amount !== undefined || amount !== null)&& $.isNumeric(amount)){
  $("#loading_charge").val(amount.toFixed(2));
    }
    else{
      $("#loading_charge").val('0.00');  
    }
    
});
$( "#invoice_value" ).blur(function() {
    
    var amount1 = parseFloat($("#invoice_value").val());
   
    if((amount1 !== undefined || amount1 !== null)&& $.isNumeric(amount1)){
  $("#invoice_value").val(amount1.toFixed(2));
    }
    else{
      $("#invoice_value").val('0.00');  
    }
});
$( "#agreed_price" ).blur(function() {
    
    var amount2 = parseFloat($("#agreed_price").val());
    
    if((amount2 !== undefined || amount2 !== null)&& $.isNumeric(amount2)){
  $("#agreed_price").val(amount2.toFixed(2));
    }
    else{
      $("#agreed_price").val('0.00');  
    }
});

function Radio(radio,lot){
    
    if(radio==='Full'){
      var goodsIn =  document.getElementById("goods_in_detail_"+lot).value;
        document.getElementById("lot_detail_"+lot).value = goodsIn;
         document.getElementById("volume_to_deliver_"+lot).value = "";
//        document.getElementById("lot_detail_"+lot).readOnly = true;
//         document.getElementById("volume_to_deliver_"+lot).readOnly =true;
    }
    else{
        document.getElementById("lot_detail_"+lot).value = "";
//         document.getElementById("volume_to_deliver_"+lot).value = "";
        document.getElementById("lot_detail_"+lot).readOnly = false;
        document.getElementById("volume_to_deliver_"+lot).readOnly =false;
    }
    
}

function Check(val,lot){
    if(document.getElementById("check_"+lot).checked == true){
         document.getElementById("lot_detail_"+lot).disabled = false;
         document.getElementById("lot_detail_"+lot).value = "";
       //  document.getElementById("volume_to_deliver_"+lot).value = "";
         document.getElementById("volume_to_deliver_"+lot).disabled =false;
         var radios =  document.getElementsByClassName("radio_"+lot);
        for(var i = 0; i< radios.length;  i++){
           radios[i].disabled = false;
       } 
       document.getElementById("Part_"+lot).checked = true;
        document.getElementById("lot_detail_"+lot).readOnly = false;
           document.getElementById("volume_to_deliver_"+lot).readOnly =false;
      // document.getElementById("Full_"+lot).checked = true;
    }
    else{
       
          var radios =  document.getElementsByClassName("radio_"+lot);
        for(var i = 0; i< radios.length;  i++){
           radios[i].disabled = true;
       }
         document.getElementById("lot_detail_"+lot).disabled = true;
         document.getElementById("volume_to_deliver_"+lot).disabled =true;
     
       
    }
}

//var dates = $("#collection_date, #delivery_date").datepicker({
//    defaultDate: "+1w",
//    changeMonth: true,
//    changeYear: true,
//    dateFormat: 'yy-mm-dd',
//    numberOfMonths: 1,
//    onSelect: function(selectedDate) {
//        var option = this.id == "collection_date" ? "minDate" : "maxDate",
//            instance = $(this).data("datepicker"),
//            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
//        dates.not(this).datepicker("option", option, date);
//    }
//});

function Search(value){
    
    if(value == 'delivery_number'){
//      alert('yes');
        document.getElementById('search_date').disabled = true;
            document.getElementById('search').readOnly = false;
          document.getElementById('search').value = "";
    }       
    else{
//        alert('no');
     document.getElementById('search_date').disabled = false;
     var search_val = document.getElementById('search_date').value;
        document.getElementById('search').readOnly = true;
        document.getElementById('search').value = search_val;
        
    }
    
}

function Datechange(val){
    
    if(val!=''){
//y     alert('yes');
        var date = document.getElementById('search_date').value;
            document.getElementById('search').value = date;
         
    }       
   
        
    
}




 $(document).ready(function(){

    $('#clients').change(function(){
    
//          alert($(this).val());
       var val = $(this).val();
     
        $.getJSON( "/ajax/clients/goodsin/"+val, function( data ) {
           
           $('#goodsin').empty();
//            $('#goodsin_delivery_id').empty();
var goodsinId = '';
           $.each(data,function(index,value){
               if(index ==0){
                   goodsinId = value.id;
               $.getJSON( "/ajax/goodsin/delivery/"+value.id, function( data1 ) {
           console.log(data1);
           if(data1.length == 0){
           
//           $('#goodsin_delivery_id').val('1');
           }
           else{
               var count = data1.length + 1;
//                $('#goodsin_delivery_id').val(count);
           }
         });
     }   
     
               var opt = $('<option>'); 
               opt.val(value.id);
            opt.text(value.id);
            
            $('#goodsin').append(opt); 
           });
      
         });
              
    });

}); 

$(document).ready(function(){

    $('#search').numeric();
    
});

//$(document).ready(function(){
//
//    $('#goodsin').change(function(){
//    
//    
////  alert($(this).val());
//       var val = $(this).val();;
//      
//        $.getJSON( "/ajax/goodsin/delivery/"+val, function( data ) {
//           $('#delivery_table tbody').empty();
//            var row='';
//            $.each(data,function(index,value){
//                
//               row+="<tr><td>"+value.goodsin_delivery_id+"</td><td>"+value.collection_date+"</td><td>"+value.delivery_date+"</td><td><a href='/delivery/"+value.id+"/edit' title='Edit'><i class='fa fa-pencil-square fa-lg'></i>&nbsp;Edit><i class='fa fa-pencil'></i>edit</a><a href='/delivery/"+value.id+"/edit' title='Duplicate'><i class='fa fa-pencil-square fa-lg'></i>&nbsp;Duplicate><i class='fa fa-pencil'></i>edit</a></td></tr>";
//         });
//       
//        $('#delivery_table').append(row);
//        
//     });      
//    });
//
//}); 









function Typeofnote(value){
    
    if(value=='delivery_note'){
     
      var del = document.getElementById("delivery_note").value;
      document.getElementById("notes").value = del ;
    }
    else if(value=='collection_note') {
         
     var col = document.getElementById("collection_note").value;
     document.getElementById("notes").value = col ;
    }
    
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

window.onload = function () {

    var type =  document.getElementById("goodsin_type_daily").value;
     // alert(type);
     if(type=='Daily/Volume'){
      //    alert(type);
       $('.volume_div').hide();
     }else{
   //alert(type);
     $('.volume_div').show(); 
     }
};


$(document).ready(function() {

    $('.StartDate').datepicker({dateFormat: 'dd-mm-yy'});
     $('.EndDate').datepicker({dateFormat: 'dd-mm-yy'});
    });

    
       
 
$(document).ready(function() {

    $('.checkWeekDate').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'MM yy',
        onClose: function() {

            var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();

            var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

            $(this).datepicker('setDate', new Date(iYear, iMonth, 1));

        },
        beforeShow: function() {

            if ((selDate = $(this).val()).length > 0)

            {

                iYear = selDate.substring(selDate.length - 4, selDate.length);

                iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5),
                        $(this).datepicker('option', 'monthNames'));

                $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));

                $(this).datepicker('setDate', new Date(iYear, iMonth, 1));

            }

        }

    });

});


$(document).on('click',".submitForm",function(e){
   e.preventDefault();
    var token = $("#token").val();
    var sel_date = $(".checkWeekDate").val();
    if(sel_date != '')
    {
          $.ajax({
            type: "POST",
            url: "/checkWeek",
            data: "_token="+token+"&select_month="+sel_date,
            cache: false,
            success: function(result)
            {
                   var data = jQuery.parseJSON(result);
                   $("#show_data").show();
                   $("#total_week").val(data.week );
                   $("#start_date").val(data.start_date );
                   $("#end_date").val(data.end_date);
                 
               
               
                
            }
        });  
    }
    else
    {
        alert('Please Select Date');
    }
    
   });
$(document).on('click',".resetForm",function(e){
   e.preventDefault();
  
               $(".checkWeekDate").val('');
                   $("#total_week").val('');
                   $("#start_date").val('');
                   $("#end_date").val('');
                   $("#show_data").hide();
                  $("#checkWeek").reset();
               
                
     
    
   });





//
//$(function() {
//     $('.checkWeek').datepicker( {
//        changeMonth: true,
//        changeYear: true,
//        showButtonPanel: true,
//        dateFormat: 'MM yy',
//        onClose: function(dateText, inst) { 
//            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
//        }
//    });
////});
////    $('.checkWeek').datepicker( {
////        changeMonth: true,
////        changeYear: true,
////        showButtonPanel: true,
////        dateFormat: 'MM yy',
////        onClose: function(dateText, inst) { 
////            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
////        }
////    });
//    
////    $(".checkWeek").datepicker( {
////    dateFormat: 'MM yy',
////    changeMonth: true,
////    changeYear: true,
////    changeDate: false,
////    viewMode: "months", 
////    minViewMode: "months"
////});
//});
//
//

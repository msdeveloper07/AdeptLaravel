<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::controllers([
	'auth'      => 'Auth\AuthController',
	'password'  => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function($router) {

    
  Route::get('/home', function () {
     
    return view('home');
});
  Route::get('/', function () {
    
    return view('home');
});
//Route::get('activate/{activation_code}','GoodsInController@');

Route::get('goodsinsSearch','GoodsInController@GoodsInsSearch');


   //    -------- Users Route---------
   $router->resource('users','UserController');
   $router->post('userAction','UserController@userAction');
   $router->get('userSearch/{search}','UserController@userSearch');
 
   Route::get('ajax/clients/goodsin/{id}', 'GoodsInController@getclientsGoodsIn');
   Route::get('ajax/goodsin/delivery/{id}', 'GoodsInController@getGoodsInDelivery');
   
   //    -------- UserGroups Route---------
   $router->resource('userGroups','UserGroupController'); 
   $router->post('userGroupAction','UserGroupController@userGroupAction');
   $router->get('userGroupSearch/{search}','UserGroupController@userGroupSearch');
    
   //    -------- userGroupPermissions Route---------
   $router->resource('userGroupPermissions','UserGroupPermissionController'); 
   $router->post('userGroupPermissionAction','UserGroupPermissionController@userGroupPermissionAction');
   $router->get('userGroupPermissionSearch/{search}','UserGroupPermissionController@userGroupPermissionSearch');
  
   //    -------- Permissions Route---------    
   $router->resource('permissions','PermissionsController'); 
   $router->post('permissionAction','PermissionsController@permissionAction');
   $router->get('permissionSearch/{search}','PermissionsController@permissionSearch');
  
   //    -------- Transport Companies Route---------    
   $router->resource('transporter','TransporterController'); 
   $router->post('transporterAction','TransporterController@transporterAction');
   $router->get('transporterSearch/{search}','TransporterController@transporterSearch');
   
   //    -------- Settings Route---------    
   $router->resource('settings', 'SettingsController');
   $router->post('settings/update', 'SettingsController@update');

   //    -------- Client Route---------
   $router->resource('clients','ClientsController');
   $router->post('clientAction','ClientsController@clientAction');
   $router->get('clientSearch/{search}','ClientsController@clientSearch');
  
   //    -------- Client Route---------
   $router->resource('goodsin','GoodsInController');
   $router->post('goodsinAction','GoodsInController@goodsinAction');
   $router->get('goodsinSearch/{search}','GoodsInController@goodsinSearch');
  
   $router->get('archiveGoodsIn','GoodsInController@archivedGoodsIn');
   $router->get('activeGoodsIn','GoodsInController@activeGoodsIn');
   
   $router->get('goodsin/createLot/{id}','GoodsInController@createLot');
   $router->post('goodsin/createLot/saveLot','GoodsInController@saveLot');
   $router->post('lotAction','GoodsInController@lotAction');
   $router->get('lotSearch/{search}/{id}','GoodsInController@lotSearch');
   $router->get('goodsin/editLot/{id}','GoodsInController@editLot');
   $router->post('goodsin/editLot/updateLot/{id}','GoodsInController@updateLot');
   $router->get('goodsin/lots/{id}','GoodsInController@showLot');
   $router->get('goodsin/invoiceGoodsIn/{id}','GoodsInController@invoiceGoodsIn');
   $router->get('goodsin/labelPrint/{id}','GoodsInController@labelPrint');
   $router->get('goodsin/printSingleLot/{id}','GoodsInController@printSingleLot');
   $router->get('goodsin/emailTemp/{id}','GoodsInController@EmailTempCreate');
   $router->post('goodsin/emailTemplates','GoodsInController@EmailTemplateStore');
   $router->get('goodsin/show/delivery/{id}','GoodsInController@ShowDelivery');
   
   $router->get('goodsin/printStockList/{id}','GoodsInController@printStockList');
  

    //  -------Suppliers Route-----
    $router->resource('suppliers','SuppliersController');
    $router->post('supplierAction','SuppliersController@supplierAction');
    $router->get('supplierSearch/{search}','SuppliersController@supplierSearch');

         //    -------- Delivery Route---------
    $router->resource('delivery','DeliveriesController');
    $router->post('deliveryAction','DeliveriesController@deliveryAction');
    $router->post('deliverySearch','DeliveriesController@deliverySearch');
    $router->get('delivery/lots/{id}','DeliveriesController@deliveryLots');
    $router->post('delivery/lots/save','DeliveriesController@saveDeliveryLots');

    $router->get('duplicateDelivery/{id}','DeliveriesController@duplicateDelivery');
    
    $router->get('createDeliveryAddress/{id}','DeliveriesController@createDeliveryAddress');
    $router->post('storeAddress/{id}','DeliveriesController@storeAddress');
    $router->get('editAddress/{id}','DeliveriesController@editAddress');
    $router->post('updateAddress/{id}','DeliveriesController@updateAddress');
    $router->get('showAddress/{id}','DeliveriesController@showAddress');
    
    $router->get('/delivery/notes/{id}','DeliveriesController@notes');
    $router->post('/saveDeliveryNote/{id}','DeliveriesController@saveDeliveryNote');
    $router->get('/printDeliveryNote/{id}','DeliveriesController@printDeliveryNote');
    
    $router->get('printTransportOrder/{id}','DeliveriesController@printTransportOrder');
    $router->get('printDelivery/{id}','DeliveriesController@printDelivery');
    $router->get('printPickingList/{id}','DeliveriesController@printPickingList');
    $router->get('printTransportInvoiceRequest/{id}','DeliveriesController@printTransportInvoiceRequest');
    
    

     //    -------- Items Route---------
   $router->resource('items','ItemsController');
   $router->post('itemAction','ItemsController@itemAction');
   $router->get('itemSearch/{search}','ItemsController@itemSearch');
   
   //    --------Vehicle Type Route---------
   $router->resource('vehicletype','VehicleTypeController');
   $router->post('vehicleTypeAction','VehicleTypeController@vehicleTypeAction');
   $router->get('vehicleTypeSearch/{search}','VehicleTypeController@vehicleTypeSearch');
   
     //    --------Invoice Route---------
   $router->resource('invoice','InvoiceController');
   $router->post('invoiceAction','InvoiceController@invoiceAction');
   $router->get('invoiceSearch/','InvoiceController@invoiceSearch');
   $router->get('invoicef','InvoiceController@invoice');
   
   
   $router->get('monthlyInvoice/{client_id}/{dateM}/{dateY}','InvoiceController@monthlyInvoice');
   $router->get('printMonthlyInvoice/{client_id}/{dateM}/{dateY}','InvoiceController@printMonthlyInvoice');
   $router->get('emailInvoice/{client_id}/{dateM}/{dateY}','InvoiceController@emailInvoiceCreate');
   $router->post('emailInvoiceStore/','InvoiceController@EmailInvoiceStore');
   
   $router->get('detailedpdf/{job_id}/{client_id}/{dateM}/{dateY}','InvoiceController@detailedPDF');
   
   //-----------Check Week-----------
   $router->get('checkWeek','CalenderController@checkWeek');
   $router->post('checkWeek','CalenderController@showWeekDay');
   $router->get('periods','CalenderController@getPeriod');
   $router->post('periods','CalenderController@postPeriod');
   
   //    --------Job Type Route---------
   $router->resource('jobtype','JobTypeController');
   $router->post('jobTypeAction','JobTypeController@jobTypeAction');
   $router->get('jobTypeSearch/{search}','JobTypeController@jobTypeSearch');
   
   //    --------SERVICE Provideer Route---------
   $router->resource('serviceProviders','ServiceProvidersController');
   $router->post('serviceProviderAction','ServiceProvidersController@serviceProviderAction');
   $router->get('serviceProviderSearch/{search}','ServiceProvidersController@serviceProviderSearch');
   
    //    -------- Client Route---------
   $router->resource('jobs','JobsController');
   $router->post('goodsinAction','GoodsInController@goodsinAction');
   $router->get('goodsinSearch/{search}','GoodsInController@goodsinSearch');
  });

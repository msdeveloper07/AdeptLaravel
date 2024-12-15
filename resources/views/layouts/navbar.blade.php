<nav class="navbar navbar-fixed-top">
        <div class="navbar-header">
          
          <a class="navbar-brand visible-xs" id="menu-xs" href="#"><i class="fa fa-navicon"></i></a>
          <a class="navbar-brand hidden-xs" id="menu-sm" href="#"><i class="fa fa-navicon"></i></a>
        </div>
        
    <div class='navbar-header'>
        <a href="{!! \App\Models\Setting::where('setting_name','site_url')->first()->setting_value !!}" class="logo">{!! \App\Models\Setting::where('setting_name','site_name')->first()->setting_value !!}</a>
    
    </div>
    
     <form id="header-search">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <span class="input-group-btn">
                <button class="btn" type="button"><i class="fa fa-search"></i></button>
              </span>
            </div><!-- /input-group -->
        </form><!--/.form-->
        
          
      
            
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <i class="fa fa-user"></i>
                <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
               
                
                
                <li role="presentation"><a role="menuitem" tabindex="-1" href="/auth/logout">Log Out</a></li>
              </ul>
            </li>
          </ul>
         <div class="nav navbar-nav navbar-right" style="padding-top:20px;">
           <span>  <a  style="padding-left: 5px; padding-right: 5px;" href="/users" title="User"><i class="fa fa-user-plus visible-xl-inline "></i></a></span>
        <span> <a  style="padding-left: 5px; padding-right: 5px;" href="/userGroups" title="User Group"><i class="fa fa-group visible-xl-inline "></i></a></span>
      <span> <a style="padding-left: 5px; padding-right: 5px;" href="/permissions" title="Permission"><i class="fa fa-lock visible-xl-inline "></i></a> </span>
      <span> <a style="padding-left: 5px; padding-right: 55px;" href="/userGroupPermissions" title="User Group Permission"><i class="fa fa-user-secret visible-xl-inline "></i></a></span>
      <span>  <a  style="padding-left: 5px; padding-right: 5px;"  href="/settings" title="Settings"><i class="fa fa-gears visible-xl-inline " ></i> Settings</a></span>
           
         </div>
  <button class="close-btn" id="close-btn"><i class="fa fa-search"></i></button>
  
      
        
    </nav><!--/.top-nav-->
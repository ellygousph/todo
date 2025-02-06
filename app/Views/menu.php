
<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
    <img src="<?php echo base_url('images/'.$setting->logo) ?>" style="width: 120px; height: auto; display: block; margin: 0 auto;">

    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            
                
                <li class='sidebar-title'>Main Menu</li>
                
            
                
                <li class="sidebar-item <?= ($currentMenu == 'dashboard') ? 'active' : '' ?>">

                    <a href="<?= base_url("home")?>" class='sidebar-link'>
                        <i data-feather="home" width="20"></i> 
                        <span>DASHBOARD</span>
                    </a>

                    
                </li>
                
            
                <?php
if(session()->get('level') == 1) 
{
?> 
                <li class="sidebar-item has-sub <?= ($currentMenu == 'user' ) ? 'active' : '' ?>">

<a href="#" class='sidebar-link'>
<i data-feather="grid" width="20"></i> 
<span>MASTER DATA</span>
</a>

    
<ul class="submenu ">

<li>
<a href="<?= base_url("home/user")?>">USER</a>
</li> 




</ul>
    
</li>
                    <?php
    }else{

    }?> 

<?php
if(session()->get('level') == 1 || session()->get('level')==2) 
{
?>
                    
               

                    <li class="sidebar-item <?= ($currentMenu == 'todo') ? 'active' : '' ?>">

<a href="<?= base_url("home/todo_list")?>" class='sidebar-link'>
    <i data-feather="check-square" width="20"></i> 
    <span>TODO LIST</span>
</a>
   
    
</li>
<?php
    }else{

    }?> 


<?php
if(session()->get('level') == 1) 
{
?> 

<li class="sidebar-item <?= ($currentMenu == 'setting') ? 'active' : '' ?>">

<a href="<?= base_url("home/setting")?>" class='sidebar-link'>
    <i data-feather="settings" width="20"></i> 
    <span>SETTING</span>
</a>
   
    
</li>



<li class="sidebar-item <?= ($currentMenu == 'log') ? 'active' : '' ?>">

<a href="<?= base_url("home/log")?>" class='sidebar-link'>
                        <i data-feather="globe" width="20"></i> 
                        <span>ACTIVITY LOG</span>
                    </a>

    
   
    
</li>
                
            
                
                
                
<li class="sidebar-item has-sub <?= ($currentMenu == 'restore_user' || $currentMenu == 'restore_todo' ) ? 'active' : '' ?>">
    

                <a href="#" class='sidebar-link'>
        <i data-feather="trash" width="20"></i> 
        <span>RESTORE</span>
    </a>

                    
    <ul class="submenu ">
    
    <li>
        <a href="<?= base_url("home/restore_user") ?>">USER</a>
    </li> 

    <li>
        <a href="<?= base_url("home/restore_todo_list")?>">TODO LIST</a>
    </li> 
   
    
</ul>
                    
                </li>
                
            
                
                <?php
    }else{

    }?> 
        
        </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        
                       
                    <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                
                                 <div class="d-none d-md-block d-lg-inline-block">Hi, <?= session()->get('lengkap')?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="<?= base_url("home/profile/". session()->get('id') )?>"><i data-feather="user"></i>ACCOUNT</a>
                               
                              
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url("home/logout")?>"><i data-feather="log-out"></i>LOGOUT</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            

           

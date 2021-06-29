<?php
    if ($modul == 'home'){
        include "home.php"; 
    }
    elseif ($modul =='masterBiaya'){
        include "Pages/Master/MasterBiaya.php"; 
    }
    elseif ($modul=='masterBiayaDetail'){
        include "Pages/Master/MasterBiayaDetail.php"; 
    }
    elseif ($modul=='404'){
        include "Pages/HTTPSTatus/404.php"; 
    }
?>
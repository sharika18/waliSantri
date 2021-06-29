<?php
    //FIELD
    $Id         = "";
    $biaya_id   = "";
    $jenjang    = "";
    $gelombang  = "";
    $nominal    = "";
    $ketentuan  = "";
    $startdate  = "";
    $enddate    = "";
    $CreatedBy  = "";
    $CreatedDate= "";

    //OTHERS
    $act = "";
    $actUrl = "";
    IF(isset($_GET['act']))
    {
        $act = $_GET['act'];
        $actUrl = $act.'BiayaDetail';
    }
    else
    {
        redirect('HTTPStatus/PageNotFound');
    }

    $deleteControllerPath = base_url()."BiayaDetail/HapusBiayaDetail/";
    $deleteHrefParam = "?modul=".$modul."&act=HapusBiayaDetail";
    $idDataTable ="#dgMasterBiayaDetail";

    $biayaDetailIsNotNull = false;
    if($biayaDetail)
    {
        $biayaDetailIsNotNull = true;
    } 

    IF(($act=='Edit') && $editBiayaDetail)
    {
        $Id   = $editBiayaDetail[0]['Biaya_Detail_ID'];
        $biaya_id  = $editBiayaDetail[0]['Biaya_ID'];
        
        $jenjang    = $editBiayaDetail[0]['Jenjang'];
        
        $gelombang    = $editBiayaDetail[0]['Gelombang']; 
        $nominal    = $editBiayaDetail[0]['Nominal']; 
        
        $ketentuan  = $editBiayaDetail[0]['Ketentuan'];

        $startdate  = $editBiayaDetail[0]['StartDate'];
        $enddate  = $editBiayaDetail[0]['EndDate'];
        
        $CreatedBy  = $editBiayaDetail[0]['CreatedBy'];
        $CreatedDate= $editBiayaDetail[0]['CreatedDate'];
    }
?>
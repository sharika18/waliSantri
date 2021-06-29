<?php
    //FIELD
    $Id   = "";
    $deskripsi  = "";
    $CreatedBy  = "";
    $CreatedDate= "";

    //OTHERS
    $act = "";
    $actUrl = "";
    IF(isset($_GET['act']))
    {
        $act = $_GET['act'];
        $actUrl = $act.'Biaya';
    }
    else
    {
        redirect('HTTPStatus/PageNotFound');
    }

    $deleteControllerPath = base_url()."Biaya/HapusBiaya/";
    $deleteHrefParam = "?modul=".$modul."&act=HapusBiaya";
    $idDataTable ="#dgMasterBiaya";

    $biayaIsNotNull = false;
    if($biaya)
    {
        $biayaIsNotNull = true;
    }   

    IF(($act=='Edit') && $editBiaya)
    {
        $Id   = $editBiaya[0]['Biaya_ID'];
        $deskripsi  = $editBiaya[0]['Deskripsi'];
        $CreatedBy  = $editBiaya[0]['CreatedBy'];
        $CreatedDate= $editBiaya[0]['CreatedDate'];
    }
?>
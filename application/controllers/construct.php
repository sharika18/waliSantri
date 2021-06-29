<?php
    parent::__construct();
    $this->API  = "http://localhost/rest_ci2/";//"http://www.devrestapi.arrisalahlubuklinggau.com/";
    $this->key  = "arrisalah123"; # variable key
    $this->load->library('session');
    $this->load->library('curl');
    $this->load->helper('form');
    $this->load->helper('url');
    date_default_timezone_set('Asia/Jakarta');
    //dp
    

    //ALERT MESSAGE
    $this->successPost = "Data Berhasil Disimpan";
    $this->errorPost = "Data Tidak Berhasil Disimpan";

    $this->successPut = "Data Berhasil Diubah";
    $this->errorPut = "Data Tidak Berhasil Diubah";

    $this->successDelete = "Data Berhasil Dihapus";
    $this->errorDelete = "Data Tidak Berhasil Dihapus";
    
    //PATH
    $this->uploadPath = "./assets/uploads/";
    $this->folderBuktiPembayaran = 'BuktiPembayaran/';
    $this->yearupload = date('Y');
    $this->folderUangpangkal = 'folder2';
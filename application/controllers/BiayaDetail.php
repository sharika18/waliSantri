<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/Biaya.php");


class BiayaDetail extends Biaya
{
    public function __construct()
    {
        include "construct.php";
    }

  function index()
  {
    $data['biaya'] = $this->GetBiaya();
    $data['biayaDetail'] = $this->GetBiayaDetail();
    $data['modul'] = "masterBiayaDetail";
    $this->load->view('media', $data);
  }

  function GetID($Biaya_Detail_ID = '')
  {
    $get_apiEditBiayaDetail = json_decode($this -> curl -> simple_get ($this->API.'/VwBiayaDetail/', array('AR-KEY'=>$this->key, 'id'=>$Biaya_Detail_ID) ),true);
    $data['editBiayaDetail'] = null;
    if($get_apiEditBiayaDetail)
    {
      $data['editBiayaDetail'] = $get_apiEditBiayaDetail['data'];
    }
    $data['biaya'] = $this->GetBiaya();
    $data['biayaDetail'] = $this->GetBiayaDetail();
    $data['modul'] = "masterBiayaDetail";
    $this->load->view('media', $data);
  }

  function TambahBiayaDetail()
  {
    $now = date('Y-m-d H:i:s');
    $data = [
        'Biaya_ID'      => $this->input-> post ('txtBiaya'),
        'Jenjang'       => $this->input-> post ('txtJenjang'),
        'Gelombang'     => $this->input-> post ('txtGelombang'),
        'Nominal'       => $this->input-> post ('txtNominal'),
        'Ketentuan'     => $this->input-> post ('txtKetentuan'),
        'StartDate'     => $this->input-> post ('txtStartDate'),
        'EndDate'       => $this->input-> post ('txtEndDate'),
        'CreatedBy'     => "DEPRA", //$this->input-> post ('CreatedBy'),
        'CreatedDate'   => $now,
        'ModifiedBy'    => $this->input-> post ('ModifiedBy'), //belum diset
        'ModifiedDate'  => $now,
        'Status'        => 1,
        'AR-KEY'        => $this->key,
    ];
    $insert = $this->curl->simple_post($this->API.'/biaya_detail/', $data, array(CURLOPT_BUFFERSIZE => 10)); 
    if($insert)
    {
        $this->session->set_flashdata('success',$this->successPost);
    }else
    {
        $this->session->set_flashdata('error',$this->errorPost);
    }
    redirect('BiayaDetail?act=Tambah');
    }

    function EditBiayaDetail()
    {
      $now = date('Y-m-d H:i:s');
      $data = array(
          'id'            => $this->input-> post ('txtID'),
          'Biaya_ID'      => $this->input-> post ('txtBiaya'),
          'Jenjang'       => $this->input-> post ('txtJenjang'),
          'Gelombang'     => $this->input-> post ('txtGelombang'),
          'Nominal'       => $this->input-> post ('txtNominal'),
          'Ketentuan'     => $this->input-> post ('txtKetentuan'),
          'StartDate'     => $this->input-> post ('txtStartDate'),
          'EndDate'       => $this->input-> post ('txtEndDate'),
          'CreatedBy'     => "DEPRA", //$this->input-> post ('CreatedBy'),
          'CreatedDate'   => $now,
          'ModifiedBy'    => $this->input-> post ('ModifiedBy'), //belum diset
          'ModifiedDate'  => $now,
          'Status'        => "1",
          'AR-KEY'        => $this->key,
      );
      // print_r($data);
      $update = $this->curl->simple_put($this->API.'/biaya_detail/', $data, array(CURLOPT_BUFFERSIZE => 10)); 
      if($update)
      {
          $this->session->set_flashdata('success',$this->successPut);
      }else
      {
          $this->session->set_flashdata('error',$this->errorPut);
      }
      redirect('BiayaDetail?act=Tambah');
    }

    function HapusBiayaDetail($Biaya_Detail_ID)
    {
        $delete =  $this->curl->simple_delete
        ($this->API.'/biaya_detail/', array('AR-KEY'=>$this->key, 'id'=>$Biaya_Detail_ID));
        if($delete)
        {
            $this->session->set_flashdata('success',$this->successDelete);
        }else
        {
            $this->session->set_flashdata('error',$this->errorDelete);
        }
        redirect('BiayaDetail?act=Tambah');
    }
}
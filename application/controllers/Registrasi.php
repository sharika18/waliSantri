<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {
	
	public $fileNameToSave = '';
	public function __construct()
	{
		include "construct.php";
	}
	
	public function UploadBiayaPendaftaran()
    {
        $this->load->view('Pages/Registrasi/CobaUpload', array('error' => ' ' ));
    }

	function FormulirRegistrasi($jenjang='', $status='')
	{
		$status = '1';
		$Api_GetBiayaDetailByJenjang = json_decode($this -> curl -> simple_get ($this->API.'/VwBiayaDetail/', array('AR-KEY'=>$this->key, 'jenjang'=>$jenjang, 'status'=>$status) ),true);
		$data['biayaDetail'] = null;
		if($Api_GetBiayaDetailByJenjang)
		{
			$data['biayaDetail'] = $Api_GetBiayaDetailByJenjang['data'];
			//print_r($data);
		}
		$this->load->view('Pages/Registrasi/Registrasi', $data);
	}

	function DownloadFile($folderPath='', $fileName='')
	{
		$folderPath ='BuktiPembayaran';
		$tanggalUpload = '20210528';
		$fileName ='CobaLagi.PNG';
		$data = [
			'AR-KEY'			=>$this->key,
			'folderPath' 		=> $folderPath,
			'tanggalUpload' 	=> $tanggalUpload,
			'fileName' 			=> $fileName
		];
		$result = json_decode($this -> curl -> simple_get ($this->API.'/uploader/download', $data ),true);
		$imgData=$result['data'];
		$contentType =$result['contentType'];
		$src = 'data: '.$contentType.';base64,'.$imgData;
		//echo $result['status'];
		echo '<img src="'.$src.'"/>';
	}

	function UploadFile($newFileName, $files)
	{
		
		$filePath = $files['file']['tmp_name'];
		$type=$files['file']['type'];

		$fileName = $files['file']['name'];
		$path_parts = pathinfo($fileName);
		$extension = $path_parts['extension'];
		$fileName = $newFileName.".".$extension;
		
		$data = [
			'file' 			=> curl_file_create($filePath, $type, $fileName),
			'fileFolder' 	=> 'BuktiPembayaran'
		];

		$url = $this->API.'/uploader/upload/';
		$curl = curl_init($url); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'AR-KEY: '.$this->key,
			'Content-Type: multipart/form-data'
			]);  
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		// Execute cURL request with all previous settings
		$response = curl_exec($curl);
		$result = json_decode($response);
		curl_close($curl);
	}
	function Upload()
	{ 
		$fileNameToSave ="CobaLagi";
		$this->UploadFile($fileNameToSave, $_FILES);
	}
	function TambahRegistrasi()
	{ 
		// $uploadFile = $this->curl->simple_post($this->API.'/registrasi/upload/', $dataUpload, array(CURLOPT_BUFFERSIZE => 10));
		// if (!file_exists($this->uploadPath.$this->folderBuktiPembayaran.$this->yearupload)) {
		// 	mkdir($this->uploadPath.$this->folderBuktiPembayaran.$this->yearupload);
	  	// }

		//$fileBuktiPembayaran = $_FILES['fileBuktiPembayaran'];
		$nik = $this->input-> post('inputNIKSantri');
		
		$tanggalPendaftaran = date("Ymd");
		$fileNameToSave = $tanggalPendaftaran."-".$nik."-Pendaftaran";
		$this->UploadFile($fileNameToSave, $_FILES);
		$data = [
			'Biaya_Detail_ID' 	=> $this->input-> post('Biaya_Detail_ID'),
			'DeskripsiBiaya' 	=> $this->input-> post('txtDeskripsiBiaya'),
			'Jenjang' 			=> $this->input-> post('txtJenjang'),
			'NamaLengkap' 		=> $this->input-> post('inputNamaLengkapSantri'),
			'NamaPanggilan' 	=> $this->input-> post('inputNamaPanggilan'),
			'TempatLahir' 		=> $this->input-> post('inputTempatLahirSantri'),
			'TanggalLahir' 		=> $this->input-> post('dateTanggalLahirSantri'),
			'NIK' 				=> $this->input-> post('inputNIKSantri'),
			'JenisKelamin' 		=> $this->input-> post('radioJenisKelaminSantri'),
	       	'AnakKe' 			=> $this->input-> post('inputAnakKe'),
			'DariBerapaSaudara' => $this->input-> post('inputDariBerapaSaudara'),
			'TinggiBadan' 		=> $this->input-> post('inputTinggiBadan'),
			'BeratBadan' 		=> $this->input-> post('inputBeratBadan'),
			'AlamatSantri' 		=> $this->input-> post('inputAlamatSantri'),
			'AsalSekolah' 		=> $this->input-> post('inputAsalSekolah'),
			'UkuranBaju' 		=> $this->input-> post('selectUkuranBaju'),
			'UkuranCelana' 		=> $this->input-> post('selectUkuranCelana'),
			'UkuranJilbab' 		=> $this->input-> post('selectUkuranJilbab'),
			'AyahNama' 			=> $this->input-> post('inputNamaLengkapAyah'),
			'AyahNIK' 			=> $this->input-> post('inputNIKAyah'),
			'AyahTempatLahir' 	=> $this->input-> post('inputTempatLahirAyah'),
			'AyahTanggalLahir' 	=> $this->input-> post('dateTanggalLahirAyah'),
			'AyahPendidikan' 	=> $this->input-> post('selectPendidikanAyah'),
			'AyahPekerjaan' 	=> $this->input-> post('selectPekerjaanAyah'),
			'AyahPenghasilan' 	=> $this->input-> post('selectPenghasilanAyah'),
			'AyahHP' 			=> $this->input-> post('inputNomorHPAyah'),
			'IbuNama' 			=> $this->input-> post('inputNamaLengkapIbu'),
			'IbuNIK' 			=> $this->input-> post('inputNIKIbu'),
			'IbuTempatLahir' 	=> $this->input-> post('inputTempatLahirIbu'),
			'IbuTanggalLahir' 	=> $this->input-> post('dateTanggalLahirIbu'),
			'IbuPendidikan' 	=> $this->input-> post('selectPendidikanIbu'),
			'IbuPekerjaan' 		=> $this->input-> post('selectPekerjaanIbu'),
			'IbuPenghasilan' 	=> $this->input-> post('selectPenghasilanIbu'),
			'IbuHP' 			=> $this->input-> post('inputNomorHPIbu'),
			'WaliNama' 			=> $this->input-> post('inputNamaLengkapWali'),
			'WaliNIK' 			=> $this->input-> post('inputNIKWali'),
			'WaliTempatLahir' 	=> $this->input-> post('inputTempatLahirWali'),
			'WaliTanggalLahir' 	=> $this->input-> post('dateTanggalLahirWali'),
			'WaliPendidikan' 	=> $this->input-> post('selectPendidikanWali'),
			'WaliPekerjaan' 	=> $this->input-> post('selectPekerjaanWali'),
			'WaliPenghasilan' 	=> $this->input-> post('selectPenghasilanWali'),
			'WaliHP' 			=> $this->input-> post('inputNomorHPWali'),
			'WaliAlamat' 		=> $this->input-> post('inputAlamatWali'),
			'Status' 			=> "",
			'Bukti_Pembayaran'	=> $fileNameToSave,
			'AR-KEY'        	=> $this->key,
		];
		$insert = $this->curl->simple_post($this->API.'/registrasi/', $data, array(CURLOPT_BUFFERSIZE => 10)); 
		if($insert)
		{
			$this->session->set_flashdata('success',$this->successPost);
		}else
		{
			$this->session->set_flashdata('error',$this->errorPost);
		}
		$this->load->view('Pages/Registrasi/UploadSuccess', $data);
	}
	public function index()
	{
		// $data['biayaDetail'] = $this->GetBiayaDetail();
		// print_r($data);
		// $this->load->view('register', $data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class HTTPSTatus extends CI_Controller{
 
  public function __construct()
  {
    include "construct.php"; 
  }
 
  function index()
  {
  }

  function PageNotFound(){
    $modul['modul'] = "404";
    $this->load->view('media', $modul);
}

}
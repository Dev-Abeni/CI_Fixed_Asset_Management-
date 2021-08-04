<?php if ( ! defined('BASEPATH')) exit('No direct script access allowd'); 

require_once dirname(__FILE__) . '/tcpdf.php';

class Pdf extends TCPDF{
    public function __construct(){
        parent::__construct();
    }
}
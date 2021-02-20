<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Test_jam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }
    function index()
    {

        $format = "%Y-%m-%d %h:%i %a";
        echo @mdate($format);
        die;
    }
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author      studentdeng 
 * @link        <studentdeng.github.com> 
 * @datetime    Jul 24, 2013 
 */
require APPPATH . '/libraries/CUREST_Controller.php';

class Account extends CUREST_Controller
{

    public function index_get()
    {
        //$this->HTTPBaseAuth();

        $result = array();
        $result[] = 1;
        $result[] = 10;
        $this->responseArray($result);
    }

    public function test()
    {}
    

}
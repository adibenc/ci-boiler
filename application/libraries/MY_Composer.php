<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Composer 
{
     function __construct() 
     {
         // COMPSER VENDOR DIRECTORY
         include(APPPATH.'libraries/vendor/autoload.php');
     }
}

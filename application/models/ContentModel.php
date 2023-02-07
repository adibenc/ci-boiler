<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(__DIR__."/BaseModel.php");

class ContentModel extends BaseModel{
	public $table = "kms_content";
}
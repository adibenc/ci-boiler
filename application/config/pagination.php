<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$config['full_tag_open'] = '<ul class="pagination pagination-blog justify-content-center">';
	$config['full_tag_close'] = '</ul>';
	$config['num_tag_open'] = '<li class="page-item ">';
	$config['num_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
	$config['cur_tag_close'] = '</a></li>';
	$config['prev_tag_open'] = '<li class="page-item">';
	$config['prev_tag_close'] = '</li>';
	$config['first_tag_open'] = '<li class="page-item">';
	$config['first_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li class="page-item">';
	$config['last_tag_close'] = '</li>';
	$config['attributes'] = array('class' => 'page-link');

	$config['prev_link'] = 'Sebelumnya';


	$config['first_link'] = 'Pertama ';
	$config['last_link'] = 'Terakhir ';
	$config['next_link'] = 'Selanjutnya ';
	$config['next_tag_open'] = '<li class="page-item">';
	$config['next_tag_close'] = '</li>';
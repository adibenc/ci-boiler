<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$active_group = 'default';
$active_record = TRUE;

$db['default'] = array(
	'dsn'	=> SecretConst::DB_DSN,
	'hostname' => SecretConst::DB_HOSTNAME,
	'username' => SecretConst::DB_USERNAME,
	'password' => SecretConst::DB_PASSWORD,
	'database' => SecretConst::DB_DATABASE,
	'dbdriver' => SecretConst::DB_DBDRIVER,
	'port' => SecretConst::DB_PORT,
	'dbprefix' => SecretConst::DB_DBPREFIX,
	'pconnect' => SecretConst::DB_PCONNECT,
	'db_debug' => SecretConst::DB_DB_DEBUG,
	'cache_on' => SecretConst::DB_CACHE_ON,
	'cachedir' => SecretConst::DB_CACHEDIR,
	'char_set' => SecretConst::DB_CHAR_SET,
	'dbcollat' => SecretConst::DB_DBCOLLAT,
	'swap_pre' => SecretConst::DB_SWAP_PRE,
	'encrypt' => SecretConst::DB_ENCRYPT,
	'compress' => SecretConst::DB_COMPRESS,
	'stricton' => SecretConst::DB_STRICTON,
	'failover' => SecretConst::DB_FAILOVER,
	'save_queries' => SecretConst::DB_SAVE_QUERIES
);

$db['sqlite'] = [
// $db['default'] = [
	'dsn'      => '',
	'hostname' => '',
	'username' => '',
	'password' => '',
	'database' => './application/database/data.db',
	'dbdriver' => 'sqlite3',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => true,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
];

$active_group = 'default';
$active_record = TRUE;
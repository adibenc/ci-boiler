<?php

/*
 * Helper functions for building a DataTables server-side processing SQL query
 *
 * The static functions in this class are just helper functions to help build
 * the SQL used in the DataTables demo server-side processing scripts. These
 * functions obviously do not represent all that can be done with server-side
 * processing, they are intentionally simple to show how it works. More complex
 * server-side processing operations will likely require a custom script.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

// REMOVE THIS BLOCK - used for DataTables test environment only!
//$file = $_SERVER['DOCUMENT_ROOT'].'/datatables/mysql.php';
//if ( is_file( $file ) ) {
//	include( $file );
//}


class Datatables_mdl
{
	function query($sql)
	{
		$CI =& get_instance();
		$this -> CI = $CI;
		return $this -> CI -> db -> query($sql);
	}
	
	function datatablesGetCount($baseSql,$where=NULL)
	{
		$sql = "
			SELECT 
				count(*) as count 
			FROM
				($baseSql";
		if($where){
			$sql.=" $where";
		}
		$sql.=") f";
		$res = $this->query($sql)->row_array();
		if($res) return $res['count'];
		return 0;
	}

	function runDatatablesSql($sql)
	{
		$res	= $this->query($sql);
		$return	= array();
		
		foreach($res->result_array() as $row){
			$return[] = $row;
		}
		if(!empty($return)) return $return;
		return false;
	}

}

<?php
require_once 'include/ripcord/ripcord.php';

$url		=	'https://192.168.50.150;8069';
$db			=	'odoo_testing';
$username	=	'admin';
$password	=	'blacksheep90-';


$common		=	ripcord::client($url.'/xmlrpc/2/common');
$uid		=	$common->authenticate($db,$username,$password,array());
$models		=	ripcord::client("$url/xmlrpc/2/object");
$partners	=	$models->execute_kw(
		$db,
		$uid,
		$password,
		'res.partner',
		'search',
		array(
				array(
						array('is_company','=',true),
						array('customer','=',true)
					)
			)	
		);

echo ('RESULT:<br/>');
foreach ($partners as $partner){
	echo $partner."<br/>";	
}
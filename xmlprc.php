<?php
require_once('include/ripcord/ripcord.php');

$url	=	"https://192.168.50.150:8069";
$db		=	"odoo_testing";
$username=	"Administrator";
$password=	"blacksheep90-";

$info	=	ripcord::client('http://192.168.50.150:8069')->start();
list($url, $db, $username, $password)	=	array($info['host'], $info['database'], $info['user'], $info['password']);



$common	=	ripcord::client("$url/xmlrpc/2/common");
$ui		=	$common->authenticate($db,$username,$password,array());
$common->version();

$models		=	ripcord::client("$url/xmlrpc/2/object");
$models->execute_kw($db,$uid,$password,'res.partner','check_access_rights',array('read'),array('raise_exception'=> false));






?>
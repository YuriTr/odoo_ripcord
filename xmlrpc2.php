<?php

function EchoResult($result, $start_str="") {
       if (is_array($result) ) {
           foreach ($result as $key => $value) {
			   if (is_array($value) )  {
				   echo "$start_str $key => array <br/>";
				   EchoResult($value, $start_str.' '.$key.' =>');
				   //echo "<br/>";
			   } else {
				   echo "$start_str $key => $value <br/>";
			   }
           }    
       } else {
		   echo "$start_str $result";
           //var_dump($result);
       }
}	




require_once 'include/ripcord/ripcord.php';

$url	=	"http://10.1.1.5:8069";
$db		=	"system_test_db";
$username=	"rpcuser@test.email.net";
$password=	"rpcuser123";

echo 'Connect to '.$url.'/xmlrpc/2/common <br>';
$common		=	ripcord::client($url.'/xmlrpc/2/common');
echo '<br>authenticate: Username:'.$username;
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
						array('is_company','=',true) /*,
						array('customer','=',true)*/
					)
			)	
		);

echo ('<br>RESULT:<br/>');
var_dump($partners);
echo '<br>';
foreach ($partners as $partner){
	echo $partner."<br/>";	
}
echo '<br> Read ids from res.partner:<br>';
$records = $models->execute_kw($db, $uid, $password,
    'res.partner', 'read', 
	array($partners),
	array('fields'=>array('display_name','sale_order_count', 'write_uid', 'contact_address', 
	'property_stock_customer', 'property_product_pricelist','commercial_company_name' ))
	);

var_dump($records);
echo '<br>';

EchoResult($records);

echo '<tr> Read id=1 from mrp.workorder:';
$records = $models->execute_kw($db, $uid, $password,
    'mrp.workorder', 'search_read',
    array(array(array('id', '=', 1))),
    array( 'limit'=>5));	

var_dump($records);
echo '<br>';
EchoResult($records);

	
	
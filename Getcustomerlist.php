<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");
//if ($models) {
	//print_r("model accepted");
	//die(print_r($models));
//}
//$partners = $models->execute_kw($db, $uid, $password, 'res.partner', 'search_read', array(array(array('is_company', '=', true))), array('fields'=>array('name', 'country_id', 'comment'), 'limit'=>5));

$partners= $models->execute_kw($db, $uid, $password, 'res.partner', 'search_read', array(array()), 
array('fields'=>array('display_name', 'phone', 'email','user_id','activity_ids','city','country_id'), 'limit'=>5));

die(json_encode($partners));
foreach ($partners as $partner) {
    echo $partner.'<br/>';
}
<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$partner= $models->execute_kw($db, $uid, $password,
    'product.template', 'search_read',
    array(array()),array('offset'=>10, 'limit'=>5));
	
die(json_encode($partner));
foreach ($partners as $partner) {
    echo print_r($partner).'</br>';
}
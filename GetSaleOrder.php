<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$partners = $models->execute_kw($db, $uid, $password, 'sale.order', 'search_read', 
array(array()), 
array('fields'=>array('name','commitment_date','expected_date','website_id','partner_id','user_id','amount_total',
'delivery_status')));

die(json_encode($partners));
//die(json_encode($test));
foreach ($partners as $partner) {
    echo print_r($partner).'</br>';
}
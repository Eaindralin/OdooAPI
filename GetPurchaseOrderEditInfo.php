<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");
$order_id='P00111';

$partners = $models->execute_kw($db, $uid, $password, 'purchase.order', 'search_read', 
array(array(array('name', '=', $order_id))), 
array('fields'=>array('partner_id','partner_ref','date_approve','date_planned','picking_type_id','currency_id'),
'limit'=>5));

die(json_encode($partners));
foreach ($partners as $partner) {
    echo print_r($partner).'</br>';
}
<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$partners= $models->execute_kw($db, $uid, $password, 'purchase.order', 'search_read', 
array(array()), array('fields'=>array('name', 'date_approve', 'partner_id','user_id',
'activity_ids','origin','amount_total','invoice_status','date_planned'),'limit'=>5));

die(json_encode($partners));
foreach ($partners as $partner) {
    echo $partner.'<br/>';
}
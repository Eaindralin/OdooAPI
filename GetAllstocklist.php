<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$partners= $models->execute_kw($db, $uid, $password, 'product.product', 'search_read',array(),
array('fields'=>array('display_name', 'avg_cost', 'total_value','qty_available','free_qty','incoming_qty','outgoing_qty','uom_id'),'limit'=>5));

die(json_encode($partners));
foreach ($partners as $partner) {
    echo $partner.'<br/>';
}
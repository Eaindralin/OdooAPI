<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");
$warehouse_id=1;

$partners= $models->execute_kw($db, $uid, $password, 'stock.quant', 'search_read', 
array(array(array('warehouse_id', '=', $warehouse_id))), array('fields'=>array('location_id', 'product_id', 'package_id','lot_id',
'owner_id','inventory_quantity_auto_apply','reserved_quantity','product_uom_id','value')));

die(json_encode($partners));
foreach ($partners as $partner) {
    echo $partner.'<br/>';
}
<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$order_id='S00075';

$ids = $models->execute_kw($db, $uid, $password,
    'sale.order.line', 'search_read',
    array(array(array('order_id', '=',$order_id))),
	array('fields'=>array('product_template_id','name','product_uom_qty','qty_delivered','qty_invoiced','product_uom',
	'product_packaging_qty','product_packaging_id','price_unit','tax_id','discount','price_subtotal')
    ));
	
$records = $models->execute_kw($db, $uid, $password,
    'res.partner', 'read', array($ids));

die(json_encode($ids));
//die(json_encode($test));
foreach ($partners as $partner) {
    echo print_r($partner).'</br>';
}
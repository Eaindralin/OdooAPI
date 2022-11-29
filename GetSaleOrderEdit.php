<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$sale_order="S00199";
 
$partners= $models->execute_kw($db, $uid, $password, 'sale.order', 'search_read', 
									 array(array(array('name', '=', $sale_order))), 
									array('fields'=>array('partner_id','partner_invoice_id','partner_shipping_id','date_order','pricelist_id',
                                'team_id'),
    'limit'=>5));

//$partners=filter_var($sale_order_name, FILTER_DEFAULT );									

print_r(json_encode($partners));
die();
foreach ($partners as $partner) {
    print_r(json_encode($partners));
}

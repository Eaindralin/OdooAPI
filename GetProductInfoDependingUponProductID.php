<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

//$partners = $models->execute_kw($db, $uid, $password,'product.template', 'search_read', [[],['fields'=>[]]]);
$product_id=1009;
$partners = $models->execute_kw($db, $uid, $password, 'product.template', 'search_read', 
									array(array(array('product_id', '=', $product_id))), 
									array('fields'=>array(
									'name',
									'detailed_type',
									'list_price',
									'public_categ_ids',
									'default_code',
									'product_tag_ids',
									'optional_product_ids',
									'accessory_product_ids',
									'alternative_product_ids',
									'website_id',
									'website_sequence',
									'allow_out_of_stock_order',
									'show_availability',
									'image_1920'
									), 'limit'=>5));

die(json_encode($partners));
foreach ($partners as $partner) {
    echo print_r($partner).'</br>';
}
<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$delivery_status="pending";
$invoice_status="to invoice";

$partner_id = 80; //customer_id
$order_id = $models->execute_kw($db, $uid, $password,
    'sale.order',
    'create', // Function name
    array(//Values-array
        array(// First record
            'partner_id'=>$partner_id,
            'partner_invoice_id'=> 80,
            'partner_shipping_id'=> 80, 	// Delivery Address
            'validity_date'=>'2022-11-11',  // Expiration Date
			'date_order'=>'2022-11-11', 	// Order Date
			'pricelist_id'=>6, 				// MMK or $
            'payment_term_id'=> 1, 			//Immediate Payment
			'delivery_status'=> 'pending',	// Delivery status
			'invoice_status'=> 'to invoice', //Invoice status
			'state'=> 'sale',
			'expected_date'=>"2022-11-11",  //expected_date 
			'commitment_date'=>"2022-11-11", //delivery date
			'website_id'=>1,
			'effective_date'=>'2022-11-01',
		)
));

$saleOrderId= $order_id;
$product_id= 51;
$product_name= 'Decogen 250mg';
$quantity= 10;
$qty_delivered=10;
$price= 1000;
$subTotal=$quantity * $price;
$uom_id=27;

$sale_order_line = $models->execute_kw($db, $uid, $password,
    'sale.order.line',
    'create', // Function name
    array(// Values-array
        array(// First record
			'order_id'=> (int)$saleOrderId, 
			'product_id'=>$product_id,
            'product_template_id'=>(int)$product_id, 
			'name'=> $product_name,
			'product_uom_qty'=> $quantity, 
			'qty_delivered'=>$qty_delivered,
			'product_uom'=>$uom_id,
			'price_unit'=> $price ,
			'price_subtotal'=> $subTotal,
			'warehouse_id'=>1,
			'company_id'=>1,
			'currency_id'=>'115',
			'state'=>'sale',
			'display_type'=>false,
			'create_date'=> '2022-11-01',
			'is_delivery'=>true,
			'write_date'=>'2022-11-01',
			'scheduled_date'=>'2022-11-01',
			'__last_update'=>'2022-11-01',			
			'qty_delivered_method'=>'stock_move',
			'analytic_precision'=>2,
			'analytic_distribution'=> false,
			'is_downpayment'=>false,
			'is_expense'=>false,	
			'salesman_id'=>80,
    )
));


if(is_int($order_id)){	
	$printsaleorder= $models->execute_kw($db, $uid, $password, 'sale.order', 'search_read', array(array(array('id', '=', $order_id))), 
	array('fields'=>array('name','commitment_date','expected_date','website_id','partner_id','user_id','amount_total',
	'delivery_status','invoice_status'), 'limit'=>5));	
	
	$printsaleorderline=$models->execute_kw($db, $uid, $password, 'sale.order.line', 'search_read', array(array(array('id', '=', $order_id))), 
	array('fields'=>array('product_template_id','name','product_uom_qty','qty_delivered','qty_invoiced','product_uom','price_unit',
	'price_subtotal'), 'limit'=>5));	
	
	print_r(json_encode($printsaleorder));
	print_r(json_encode($printsaleorderline));
}
else{
    print("<p>Error: ");
    print($order_id['faultString']);
    print("</p>");
}
//print($sale_order_line);

//die(json_encode($new_partner_id));

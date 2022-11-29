<?php
$url = 'https://pstest-mymedicine.odoo.com';
$db = 'pstest-mymedicine';
$username = 'htooeaindra.lin@mymedicine.com.mm';
$password = '70a383c59fba2ab88a065c4818085f552084a81d';

require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$uid = $common->authenticate($db, $username, $password, array());

$models = ripcord::client("$url/xmlrpc/2/object");

$partner_name = "Test Partner";
$new_partner_id = $models->execute_kw($db, $uid, $password,
    'res.partner',
    'create', // Function name
    array( // Values-array
        array( // First record
            'name'=>$partner_name,
            'function'=>"Marketing Director",
            'is_company'=>True,
            'phone'=>"123456780",
			'mobile'=>"123456780",
            'email'=>"mail@example.com",
			'website'=>"https://pstest-mymedicine.odoo.com",
            
    )
));

if(is_int($new_partner_id)){
    print("Partner '${partner_name}' created with id '${new_partner_id}'");
}
else{
    print("<p>Error: ");
    print($new_partner_id['faultString']);
    print("</p>");
}
//die(json_encode($new_partner_id));

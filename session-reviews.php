<?php 
session_start();          // Start the session
$post_id = $_POST['post_id'];
$data_tax = $_POST['data_tax'];
$display_type = $_POST['display_type'];

if( $post_id !=''){
	$_SESSION['post_review_id'] = $post_id; 
}
if( $data_tax !=''){
	$_SESSION['data_tax_reviews'] = $data_tax;
}
if( $display_type !=''){
	$_SESSION['display_type'] = $display_type;
}

echo $_SESSION['post_review_id'];
echo $_SESSION['data_tax_reviews'];
echo $_SESSION['display_type'];
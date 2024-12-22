<?php 
session_start();          // Start the session
$product_type = $_POST['product_type'];

$cred_limit = $_POST['cred_limit'];
$cred_day_period = $_POST['cred_day_period'];

$percent_limit = $_POST['percent_limit'];
$cashback_number = $_POST['cashback_number'];

$cred_limit_ins = $_POST['cred_limit_ins'];
$cred_day_period_ins = $_POST['cred_day_period_ins'];

$summ_limit = $_POST['summ_limit'];
$cred_summ_period = $_POST['cred_summ_period'];

$z_sum = $_POST['z_sum'];
$z_time = $_POST['z_time'];

if( $product_type !='' && $product_type == 'credit_inputs_range'){
	$_SESSION['filter_credit_card'] = array(); 
	array_push($_SESSION['filter_credit_card'], $cred_limit );
	array_push($_SESSION['filter_credit_card'], $cred_day_period );
	echo '/bankcard/creditcard';
}

if( $product_type !='' && $product_type == 'debet_inputs_range'){
	$_SESSION['filter_debetcard_card'] = array(); 
	array_push($_SESSION['filter_debetcard_card'], $percent_limit );
	array_push($_SESSION['filter_debetcard_card'], $cashback_number );
	echo '/bankcard/debetcard';
}

if( $product_type !='' && $product_type == 'install_inputs_range'){
	$_SESSION['filter_installmentcard_card'] = array(); 
	array_push($_SESSION['filter_installmentcard_card'], $cred_limit_ins );
	array_push($_SESSION['filter_installmentcard_card'], $cred_day_period_ins );
	echo '/bankcard/installmentcard';
}

if( $product_type !='' && $product_type == 'kredity_inputs_range'){
	$_SESSION['filter_kredity'] = array(); 
	array_push($_SESSION['filter_kredity'], $summ_limit );
	array_push($_SESSION['filter_kredity'], $cred_summ_period );
	echo '/kredity/';
}

if( $product_type !='' && $product_type == 'zaimy_inputs_range'){
	$_SESSION['filter_zaimy'] = array(); 
	array_push($_SESSION['filter_zaimy'], $z_sum );
	array_push($_SESSION['filter_zaimy'], $z_time );
	echo '/zaimy/';
}


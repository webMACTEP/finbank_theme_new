<?php session_start();          // Start the session
require( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

// Добавление карт в сессию
if(isset($_POST['post_id'])):
	$post_id = $_POST['post_id'];
	$tax = $_POST['post_tax'];
	$text = get_the_title( $post_id );

echo $text;
else:
echo 'empty';
endif; ?>

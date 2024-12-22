<?php 

session_start();          // Start the session

function del_from_array(&$array, $needle, $all = true){
        if(!$all){
            if(FALSE !== $key = array_search($needle,$array)) unset($array[$key]);
            return;
        }
        foreach(array_keys($array,$needle) as $key){
            unset($array[$key]);
        }
}


if(empty($_SESSION['cred_cards'])){
	$_SESSION['cred_cards']=array(); 
}
if(empty($_SESSION['debet_cards'])){
	$_SESSION['debet_cards']=array(); 
}
if(empty($_SESSION['installment_cards'])){
	$_SESSION['installment_cards']=array(); 
}
if(empty($_SESSION['kredity'])){
	$_SESSION['kredity']=array(); 
}
if(empty($_SESSION['zaimy'])){
	$_SESSION['zaimy']=array(); 
}

// Добавление карт в сессию
if(isset($_POST['post_id'])){
	$post_id = $_POST['post_id'];
	$tax = $_POST['post_tax'];

	if(!in_array($post_id, $_SESSION['cred_cards']) && $tax == 'creditcard' && count($_SESSION['cred_cards']) < 4 ){
		array_push($_SESSION['cred_cards'], $post_id );
	} elseif(in_array($post_id, $_SESSION['cred_cards'])) {
		del_from_array($_SESSION['cred_cards'], $post_id);
	}

	if(!in_array($post_id, $_SESSION['debet_cards']) && $tax == 'debetcard' && count($_SESSION['debet_cards']) < 4 ){
		array_push($_SESSION['debet_cards'], $post_id );
	} elseif(in_array($post_id, $_SESSION['debet_cards'])) {
		del_from_array($_SESSION['debet_cards'], $post_id);
	}

	if(!in_array($post_id, $_SESSION['installment_cards']) && $tax == 'installmentcard' && count($_SESSION['installment_cards']) < 4 ){
		array_push($_SESSION['installment_cards'], $post_id );
	} elseif(in_array($post_id, $_SESSION['installment_cards'])) {
		del_from_array($_SESSION['installment_cards'], $post_id);
	}
	
	if(!in_array($post_id, $_SESSION['kredity']) && $tax == 'kredity' && count($_SESSION['kredity']) < 4 ){
		array_push($_SESSION['kredity'], $post_id );
	} elseif(in_array($post_id, $_SESSION['kredity'])) {
		del_from_array($_SESSION['kredity'], $post_id);
	}

	if(!in_array($post_id, $_SESSION['zaimy']) && $tax == 'zaimy' && count($_SESSION['zaimy']) < 4 ){
		array_push($_SESSION['zaimy'], $post_id );
	} elseif(in_array($post_id, $_SESSION['zaimy'])) {
		del_from_array($_SESSION['zaimy'], $post_id);
	}
}

// Удаление карт из сессии
if(isset($_POST['card_index'])){
	$card_index = $_POST['card_index'];
	$card_type = $_POST['card_type'];
	if($card_type == 'creditcard'){
		array_splice($_SESSION['cred_cards'], $card_index, 1);
	}
	if($card_type == 'debetcard'){
		array_splice($_SESSION['debet_cards'], $card_index, 1);
	}
	if($card_type == 'installmentcard'){
		array_splice($_SESSION['installment_cards'], $card_index, 1);
	}
	if($card_type == 'kredity'){
		array_splice($_SESSION['kredity'], $card_index, 1);
	}
	if($card_type == 'zaimy'){
		array_splice($_SESSION['zaimy'], $card_index, 1);
	}
}


?>

<?php 
$count_compare_item = count($_SESSION['cred_cards']) + count($_SESSION['debet_cards']) + count($_SESSION['installment_cards']) + count($_SESSION['kredity']) + count($_SESSION['zaimy']);
if(count($_SESSION['cred_cards']) > 0 || count($_SESSION['debet_cards'])>0 || 
	      count($_SESSION['installment_cards'])>0 || count($_SESSION['kredity'])>0 || count($_SESSION['zaimy'])>0):
echo $count_compare_item;
else:
echo 'empty';
endif; ?>

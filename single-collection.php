<?php

	$term = get_queried_object();
	$ID = get_queried_object()->ID;
	$type = get_field('coll-type');


//    if($_GET['test']){
//        print_r2($type);
//    }

    if( current_user_can('administrator')){
        echo '<div style="margin-top: 3rem; color:reсd;">';
        echo $type . ' TYPE OF PAGE';
        echo '</div>';
    }

    if($_REQUEST['change_template']){
        get_template_part( 'template-parts/new-collection-kredity' );
    }else{
        // kredity
        switch ($type) {
            case 'creditcard':
                get_template_part( 'template-parts/collection-creditcard' );
                break;
            case 'debatcard':
                get_template_part( 'template-parts/collection-debatcard' );
                break;
            case 'installmentcard':
                get_template_part( 'template-parts/collection-installmentcard' );
                break;
            case 'kredity':
                get_template_part( 'template-parts/collection-kredity' );
                break;
            case 'zaimy':
                get_template_part( 'template-parts/collection-zaimy' );
                break;
            default:
                get_template_part( 'template-parts/collection-all' );
                break;
        }
    }

    //// kredity
	//switch ($type) {
	//	case 'creditcard':
	//		get_template_part( 'template-parts/collection-creditcard' );
	//		break;
	//	case 'debatcard':
	//		get_template_part( 'template-parts/collection-debatcard' );
	//		break;
	//	case 'installmentcard':
	//		get_template_part( 'template-parts/collection-installmentcard' );
	//		break;
	//	case 'kredity':
    //
    //        if($_REQUEST['test']){
    //            get_template_part( 'template-parts/new-collection-kredity' );
    //        }else{
    //            get_template_part( 'template-parts/collection-kredity' );
    //        }
    //
    //
	//		break;
	//	case 'zaimy':
	//		get_template_part( 'template-parts/collection-zaimy' );
	//		break;
    //
	//	default:
	//		get_template_part( 'template-parts/collection-all' );
	//		break;
	//}
	
?>
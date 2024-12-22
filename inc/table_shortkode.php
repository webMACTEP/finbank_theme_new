<?php

$plus_and_minus_tab = $args;

?>

<style>
    .tabs-table-custom-article .tabs-table .content{
        /*border: 1px solid #DFDFE6;*/
    }
    .tabs-table-custom-article .tabs-table .item{
        border: 1px solid #DFDFE6;
        /*border-bottom: 0;*/
        margin-top: -1px;
        margin-left: -1px;
    }

    .tabs-table-custom-article .item-wrap {
        border:none;
    }
</style>
<div style="display: block;" class="tab-pane tabs-table-custom-article" id="tab4">

        <div class='tabs-table'>
            <div class="mobile">
                <div data-class-item="item-plus" class="left active">Преимущества</div>
                <div data-class-item="item-minus"  class="right">Недостатки</div>
            </div>
            <div class="content">

                <? foreach($plus_and_minus_tab as $item):?>

                    <div class="item-wrap">

                        <? if(isset($item['plus'])):?>
                            <div class="item item-plus show">
                                <div data-click="0" class="btn__collmore_cat">
                                    <span class="btn__collmore-icon"></span>
                                </div>
                                <div><?= $item['plus']?></div>
                            </div>
                        <? endif;?>

                        <?if(isset($item['minus'])):?>
                            <div class="item item-minus">
                                <div data-click="0" class="btn__collmore_cat btn__collmore_visible">
                                    <span class="btn__collmore-icon"></span>
                                </div>
                                <div><?= $item['minus']?></div>
                            </div>
                        <? endif;?>

                    </div>

                <? endforeach;?>


            </div>


        </div>



    </div>

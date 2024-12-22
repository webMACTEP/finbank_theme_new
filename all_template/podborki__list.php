<!-- podborki -->
<?
$podborki = get_field('podborki', get_the_ID());

$need = 7;

if($podborki){
    $podborki1 = array_slice($podborki,0, $need);
    $podborki2 = array_slice($podborki,$need );
}


?>
<?php if($podborki): ?>


<!-- credit cards -->
<div class="section">
    <div class="section__header d-flex justify-content-between align-items-center">
        <h2 class="title mb-0">Подбор <?php echo $args; ?></h2>
    </div>
    <div class="tags__main mt-4 mb-5 pb-2 horizontal__scroll">
        <div class="horizontal__scroll-container justify-content-between">
            <? foreach ($podborki1 as $item):?>
                <a href="<?php echo the_permalink($item); ?>" class="tag__item"><span class="tag__item-title"><?= get_the_title($item) ?></span></a>
            <? endforeach; ?>

            <? if($podborki2): ?>

                <a href="" class="tag__item primary btn__view-all"><span class="tag__item-title">ещё +</span></a>

                <? foreach ($podborki2 as $item):?>
                    <a href="<?php echo the_permalink($item); ?>" class="tag__item"><span class="tag__item-title"><?= get_the_title($item) ?></span></a>
                <? endforeach; ?>

            <?php endif; ?>

        </div>
    </div>
</div
<!-- / credits cards -->


<?php endif; ?>
<!-- / podborki -->
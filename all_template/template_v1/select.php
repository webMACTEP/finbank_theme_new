<?php
?>

<select name="" class="styledSelect cred-order-select">
    <option value="" selected disabled>Сортировать</option>
    <option value="">Сортировать</option>

    <option value="ratings_average">По рейтингу</option>

    <option value="views">По количеству заявок</option>


<?php
$type = $args['type'];

?>

<?php if($type == 'creditcard'):?>

    <option value="card_cred_limit">По Лимиту</option>
    <option value="card_period">По дня без %</option>
    <option value="card_stavka">По процентной ставке</option>

<?php endif; ?>


<?php if($type == 'installmentcard'):?>

    <option value="card_cred_limit">По Лимиту</option>
    <option value="card_period">По дня без %</option>
    <option value="card_stavka">По процентной ставке</option>


<?php endif; ?>


<?php if($type == 'debetcard'):?>

    <option value="card_cred_limit">По обслуживанию</option>

    <option value="card_cashback">По кэшбеку</option>
    <option value="card_cost">По стоимости</option>
    <option value="card_stavka_ostatok">По % на остаток</option>

<?php endif; ?>


<?php if($type == 'kredity'):?>

    <option value="credit_min_sum">По сумме</option>

    <option value="credit_max_sum">По процентной ставке</option>

    <option value="opisanie_psk">По ПСК</option>

<?php endif; ?>



<?php if($type == 'zaimy'):?>

    <option value="z_sum">По сумме</option>

    <option value="z_stavka">По процентной ставке</option>

    <option value="z_time">По сроку</option>

<?php endif; ?>


</select>



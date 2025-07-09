<div class="d-flex">
    <div class="card__rating d-flex align-items-center mr-3">
        <div class="mr-2">
            <svg width="18" height="17">
                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#starLine"></use>
            </svg>
        </div>
        <?php echo $rating; ?>
    </div>
    <div class="card__icon d-flex align-items-center">
        <div class="mr-2">
            <svg width="18" height="17">
                <use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/img/icons.svg#commentLine"></use>
            </svg>
        </div>
        <?php echo $cnt; ?>
    </div>
    <div class="card__date d-none d-md-block ml-auto">
        <?php echo "{$date} / {$time}"; ?>
    </div>
</div>
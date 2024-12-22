<?php

$items = $args['DATA'];

?>

<section class="faq">

    <?php if($args['title']): ?>

        <div class="h2"><?php echo $args['title']; ?></div>

    <?php endif; ?>

    <?php foreach($items as $item):?>

        <div class="question-wrapper">
            <div class="quest filter__btn collapsed">
                <?php echo $item['name']; ?>
                <div class="filter__btn-icon">
                    <svg width="12" height="6" viewBox="0 0 12 6" xmlns="http://www.w3.org/2000/svg"><path d="M6 6h-.4C4.4 5.8 3.5 5 2 3.5L.3 1.7C-.1 1.3-.1.7.3.3c.4-.4 1-.4 1.4 0l1.7 1.8C4.6 3.2 5.3 3.9 5.8 4h.4c.5-.1 1.2-.8 2.4-1.9L10.3.3c.4-.4 1-.4 1.4 0 .4.4.4 1 0 1.4L10 3.5C8.5 5 7.6 5.8 6.4 6H6Z"></path></svg>
                </div>
            </div>
            <div class="answer-faq ">
                <?php echo $item['content']; ?>
            </div>
        </div>

    <?php endforeach;?>

</section>


<style>
    .faq  {
        margin-bottom: 56px;
    }
    .faq .h2 {
        margin-bottom: 38px;
    }
    .question-wrapper {
        margin-bottom: 5px;
        border-radius: 12px;
        background: var(--white);
        padding-top: 18px;
        padding-bottom: 18px;
    }
    .question-wrapper .quest {
        padding-left: 36px;
        color:var(--black);
        font-size:18px;
        font-weight:600;
        cursor: pointer;
        border-radius: 12px;
        padding-top: 0px;
        padding-bottom: 0px;
    }
    .question-wrapper .answer-faq {
        display:none;
        /*border-top: 1px solid var(--gray-400);*/
        padding: .5rem 2rem;
        color: var(--footer-link);
        border-radius: 12px;
        /*margin-top: 5px;*/
    }
</style>


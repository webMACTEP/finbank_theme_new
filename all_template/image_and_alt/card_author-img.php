<?php
$author_id = $args;

?>

<img loading="lazy"
src="<?php echo the_field('expert_logo', $author_id ) ?>"
alt="<?php echo get_the_title($author_id) ?>">

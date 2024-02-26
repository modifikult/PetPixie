<?php
    $our_likes = get_field('our_likes');
    $our_dislikes = get_field('our_dislikes');
?>

<?php if($our_likes || $our_dislikes) :?>
    <section class="our-likes-dislikes">
        <div class="container">
            <div class="our-likes-dislikes__wrap">
                <?php if ($our_likes) : ?>
                    <div class="likes">
                        <div class="likes-title d-flex align-items-center">
                            <img
                                src="<?php echo get_template_directory_uri() . '/public/images/icon-thumbs-up.svg'; ?>"
                                alt="icon">
                            <span><?php _e('Our Likes'); ?></span>
                        </div>
                        <ul class="likes-list list-unstyled">
                            <?php foreach ($our_likes as $like) : ?>
                                <li><?php echo $like['item']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if ($our_dislikes) : ?>
                    <div class="dislikes">
                        <div class="dislikes-title d-flex align-items-center">
                            <img
                                src="<?php echo get_template_directory_uri() . '/public/images/icon-thumbs-down.svg'; ?>"
                                alt="icon">
                            <span><?php _e('Our Dislikes'); ?></span>
                        </div>
                        <ul class="dislikes-list list-unstyled">
                            <?php foreach ($our_dislikes as $dislike) : ?>
                                <li><?php echo $dislike['item']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

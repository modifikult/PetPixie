<?php
    $title = get_the_title();
    $link = get_the_permalink();
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
    $thumbnailCaption = get_the_post_thumbnail_caption() ? get_the_post_thumbnail_caption() : get_the_title();
    $specialization = get_the_terms(get_the_ID(),'team_specialization');
?>

<div class="team__list-item">
<!--    <a href="--><?php //echo $link;?><!--">-->
        <div class="item__top d-flex flex-column align-items-center">
            <?php if(is_product()) :?>
                <div class="item__text">
                    <?php _e('Picked by');?>
                </div>
            <?php endif; ?>
            <?php if($thumbnail) :?>
                <div class="item__image">
                    <img src="<?php echo get_the_post_thumbnail_url();?>" alt="<?php echo $thumbnailCaption;?>">
                </div>
            <?php endif; ?>
            <div class="item__title">
                <h5>
                    <?php echo $title;?>
                </h5>
            </div>
        </div>
        <div class="item__bottom">
            <div class="item__special text-center">
                <?php echo $specialization[0]->name;?>
            </div>
        </div>
<!--    </a>-->
</div>

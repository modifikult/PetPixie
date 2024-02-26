<?php
    $title = get_the_title();
    $content = get_the_content();
    $thumbnail = get_the_post_thumbnail();
    $thumbnailCaption = get_the_post_thumbnail_caption() ? get_the_post_thumbnail_caption() : get_the_title();
?>
<div class="col">
    <div class="card p-3 d-flex flex-row align-items-start">
        <?php if ($thumbnail) : ?>
            <img
                src="<?php echo get_the_post_thumbnail_url() ?>"
                alt="<?php echo $thumbnailCaption; ?>"
                class="card-icon">
        <?php endif; ?>
        <div>
            <span class="card-title"><?php echo $title; ?></span>

            <?php if ($content) : ?>
                <p class="mb-0 card-desc"><?php echo $content; ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

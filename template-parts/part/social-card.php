<?php
    $list = $args['list'];

    $icon = $list['item_icon'];
    $link = $list['item_link'];
?>
<li class="social-media__list-item">
    <?php if ($link) : ?>
        <a href="<?php echo esc_url($link['url']); ?>" target="_blank"
           class="item__link d-flex align-items-center">
            <?php if ($icon) : ?>
                <img
                    src="<?php echo $icon['url']; ?>"
                    alt="<?php echo $icon['alt'] ? $icon['alt'] : $icon['title']; ?>"
                    class="item__icon">
            <?php endif; ?>
            <?php if ($link['title']) : ?>
                <div class="item__text">
                    <div class="item__text-label">
                        <?php _e('Connect On'); ?>
                    </div>
                    <div class="item__text-title">
                        <?php echo $link['title']; ?>
                    </div>
                </div>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</li>

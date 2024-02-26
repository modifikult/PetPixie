<?php
    $video_from = get_field('video_from');
    $video_poster = get_field('video_poster');
    $video_file = get_field('video_file');
    $video_link = get_field('video_link');
    $video_amazon = get_field('video_amazon');
?>

<?php if ($video_from === 'media_gallery' && $video_file) : ?>
    <section class="video">
        <div class="container">
            <div class="video__wrap">
                <div class="video__player">
                    <video src="<?php echo $video_file['url']; ?>" controls
                           poster="<?php echo $video_poster['url']; ?>" class="lazyload"></video>
                    <span class="video-src"></span>
                </div>
            </div>
        </div>
    </section>
<?php elseif ($video_from === 'amazon' && $video_amazon) : ?>
    <section class="video">
        <div class="container">
            <div class="video__wrap">
                <div class="video__player">
                    <video src="<?php echo $video_amazon; ?>" controls poster="<?php echo $video_poster['url']; ?>"
                           class="lazyload"></video>
                    <span class="video-src"></span>
                </div>
            </div>
        </div>
    </section>
<?php elseif ($video_from === 'link' && $video_link): ?>
    <section class="video">
        <div class="container">
            <div class="video__wrap">
                <div class="video__player">
                    <?php echo $video_link; ?>
                    <span class="video-src"></span>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

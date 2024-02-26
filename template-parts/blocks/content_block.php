<?php
    $content = get_sub_field('content');
?>

<?php if ($content) : ?>
    <section class="content-block">
        <div class="container">
            <div class="content-block__wrap">
                <?php echo $content; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php
    if (isset($args)) {
        $item = $args['item'];

        $rating = $item['rating'];
        $title = $item['title'];
        $location_date = $item['location_date'];
        $review = $item['review'];
    }
?>

<?php if ($review && $rating) : ?>
    <div class="review-card">
        <div class="review-card__top d-flex flex-wrap align-items-center">
            <?php if ($rating || $rating === 0) : ?>
                <?php $i = 0; ?>

                <div class="review-card__rating d-flex align-items-center">
                    <?php while ($i < 5) : ?>
                        <i class="<?php echo $i < $rating ? 'bi bi-star-fill rating-color' : 'bi bi-star rating-color'; ?> "></i>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php if ($title) : ?>
                <div class="review-card__title">
                    <?php echo $title; ?>
                </div>
            <?php endif; ?>
            <?php if ($location_date) : ?>
                <div class="review-card__subtitle w-100">
                    <?php echo $location_date; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="review-card__text">
            <?php echo $review; ?>
        </div>
    </div>
<?php endif; ?>


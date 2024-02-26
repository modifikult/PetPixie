<?php
    $faq_title = get_field('faq_title');
    $faq_subtitle = get_field('faq_subtitle');
    $faq_list = get_field('faq_list');
?>

<?php if ($faq_list) : ?>
    <section class="product-faq">
        <div class="container">
            <div class="product-faq__wrap">
                <div class="product-faq__col">
                    <?php if ($faq_title) : ?>
                        <div class="product-faq__title">
                            <h2><?php echo $faq_title; ?></h2>
                        </div>
                    <?php endif; ?>

                    <?php if ($faq_subtitle) : ?>
                        <div class="product-faq__subtitle">
                            <?php echo $faq_subtitle; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="product-faq__col">
                    <div class="product-faq__list">
                        <?php foreach ($faq_list as $faq_item) : ?>
                            <?php
                            $answer = $faq_item['answer'];
                            $question = $faq_item['question'];
                            ?>
                            <div class="product-faq__list-item dropdown" itemprop="mainEntity"
                                 itemtype="https://schema.org/Question">
                                <div class="list-item__title dropdown-title" itemprop="name"><?php echo $question; ?></div>
                                <div class="list-item__content dropdown-content" itemscope itemprop="acceptedAnswer"
                                     itemtype="https://schema.org/Answer">
                                    <div itemprop="text">
                                        <?php echo $answer; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

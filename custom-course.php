<?php

/* Template Name: Special Course Page */

get_header(vibe_get_header());

if (have_posts()) : while (have_posts()) : the_post();

?>
        <style>
            .special-courses-inner {
                position: relative;
            }

            .special-course-single-inner {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }

            .special-course-main {
                max-width: 1200px;
                margin: auto;
                position: relative;
            }

            .loader-bg {
                position: absolute;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, .5);
                left: 0;
                top: 0;
                border-radius: 10px;
                display: none;
            }

            .oe-course-search {
                max-width: 1200px;
                margin: auto;
                text-align: left;
            }

            .special-course-single {
                background: #fff;
                padding: 15px 20px;
                border-radius: 4px;
                margin-bottom: 20px;
            }

            #content,
            .no.content {
                background: #F5F4FF;
            }

            .special-course-img {
                width: 315px;
            }

            .special-course-price-qty {
                width: 200px;
            }

            .special-course-details {
                width: calc(100% - 515px);
                padding: 0px 40px;
            }

            .special-course-img img {
                border: 1px solid #D7E4EC;
                border-radius: 12px 0px 0px 12px;
            }

            .special-course-title h2 {
                font-weight: 700;
                font-size: 20px;
                color: #2B354E;
            }

            .special-course-reviews {
                display: flex;
                justify-content: flex-start;
                align-items: center;
            }

            .special-course-reviews p {
                margin: 0 !important;
            }

            .qty-wrapper {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-template-rows: 1fr;
                align-items: center;
                grid-gap: 10px;
                grid-row-gap: 25px;
                justify-content: space-between;
            }

            .qty-minus,
            .course-qty,
            .qty-plus {
                display: grid;
                align-items: center;
                margin: auto;
            }

            .buy-now {
                grid-column: 1 / -1;
            }

            input.course-qty {
                width: 55px;
                height: 55px;
                text-align: center;
                -moz-appearance: textfield;
                background: #F8FAFC;
                border: 1px solid #E2E8F0;
                border-radius: 53px;
                font-family: 'Plus Jakarta Sans';
                font-weight: 800;
                font-size: 16px;
                color: #2B354E;
            }

            input.course-qty::-webkit-outer-spin-button,
            input.course-qty::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            button.qty-minus,
            button.qty-plus {
                width: 35px;
                height: 35px;
                border-radius: 50%;
                border: 1px solid #F1F5F9;
                background: #FFFFFF;
                color: #2B354E;
                font-size: 20px;
            }

            button.qty-minus {
                font-size: 25px;
                line-height: 1;
            }

            a.buy-now {
                background: #625FFF;
                border-radius: 4px;
                font-family: 'Plus Jakarta Sans';
                font-weight: 600;
                font-size: 18px;
                color: #FFFFFF;
                display: block;
                padding: 12px;
                text-align: center;
            }

            .loadmore-btn-wrapper {
                text-align: center;
            }

            #ajax-loader {
                display: none;
                position: absolute;
                left: 50%;
                bottom: 230px;
                transform: translateX(-50%);
                z-index: 1;
                width: 150px;
                height: 150px;
                margin: -75px 0 0 -75px;
                border: 16px solid #f3f3f3;
                border-top: 16px solid #3498db;
                border-radius: 50%;
                animation: spin 2s linear infinite;
            }

            button#load-more img {
                margin-right: 8px;
            }

            button#load-more {
                border: 1px solid #625FFF;
                border-radius: 3px;
                background: none;
                font-weight: 500;
                font-size: 15px;
                line-height: 19px;
                color: #625FFF;
                padding: 12px 30px;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: auto;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .oe-course-search-inner {
                margin-bottom: 25px;
                background: #FFFFFF;
                box-shadow: 0px 2.97561px 7.43902px rgb(0 0 0 / 5%);
                border-radius: 4px;
                padding: 15px 25px;
            }

            input.oe-course-search {
                width: 100%;
                font-size: 16px !important;
                position: relative;
                border: none;
                padding: 10px 0;
            }

            input#oe-course-search::before {
                content: "";
                position: absolute;
                width: 20px;
                height: 20px;
                background: url("<?php echo get_theme_file_uri(); ?>/assets/img/search-normal.svg");
            }

            .search-course-wrapper {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                margin-bottom: 10px;
            }

            .search-img {
                margin-right: 10px;
            }

            .search-img img {
                max-width: 100px;
            }

            .search-title h3 {
                margin: 0;
                font-size: 22px;
                text-transform: capitalize;
            }

            span.sc-avg-rating {
                font-size: 15px;
                font-weight: 600;
                color: #4B5162;
                margin: 0 8px;
            }

            span.sc-review-count {
                font-size: 15px;
                font-weight: 500;
                color: #4B5162;
            }

            .custom-rating-wrapper {
                margin-top: 5px;
            }

            span.search-highlight {
                position: relative;
                z-index: 1;
                background-color: #625FFF;
                color: #fff;
            }


            @media only screen and (min-width: 768px) and (max-width: 991px) {
                .special-course-img {
                    width: 200px;
                }

                .special-course-price-qty {
                    width: 165px;
                }

                .special-course-details {
                    width: calc(100% - 365px);
                    padding: 0px 20px;
                }
            }

            @media only screen and (max-width: 767px) {
                .special-course-img {
                    width: 200px;
                }

                .special-course-details {
                    width: calc(100% - 350px);
                    padding: 0px 20px;
                }

                .special-course-price-qty {
                    width: 150px;
                }

                .qty-wrapper {
                    grid-row-gap: 10px;
                }

                .qty-wrapper a.buy-now {
                    font-size: 15px;
                    padding: 10px 15px;
                }
            }

            @media only screen and (max-width: 767px) {
                .special-course-reviews {
                    display: unset;
                }

                span.sc-avg-rating {
                    margin-left: 0;
                }
            }

            @media only screen and (max-width: 650px) {

                .special-course-single-inner {
                    display: unset;
                }

                .special-course-img {
                    width: 100%;
                    text-align: center;
                }

                .special-course-details {
                    width: 100%;
                    text-align: center;
                }

                .special-course-price-qty {
                    max-width: 200px;
                    margin: auto;
                    margin-top: 25px;
                }

                .special-course-img img {
                    border-radius: 0;
                }

            }
        </style>
        <section id="title">
            <?php do_action('wplms_before_title'); ?>
            <div class="<?php echo vibe_get_container(); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pagetitle">
                            <?php
                            $breadcrumbs = get_post_meta(get_the_ID(), 'vibe_breadcrumbs', true);
                            if (vibe_validate($breadcrumbs) || empty($breadcrumbs))
                                vibe_breadcrumbs();

                            $title = get_post_meta(get_the_ID(), 'vibe_title', true);
                            if (vibe_validate($title) || empty($title)) {
                            ?>
                                <h1><?php the_title(); ?></h1>
                            <?php the_sub_title();
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php

        $v_add_content = get_post_meta($post->ID, '_add_content', true);

        ?>
        <section id="content">
            <div class="<?php echo vibe_get_container(); ?>">
                <div class="row">
                    <div class="col-md-12">

                        <div class="<?php echo vibe_sanitizer($v_add_content, 'text'); ?> content">
                            <div class="oe-course-search">
                                <div class="oe-course-search-inner">
                                    <input type="text" class="oe-course-search" id="course-search-input" placeholder="Microsoft Excel Complete Course">
                                    <div id="course-search-results"></div>
                                </div>
                            </div>


                            <div class="special-course-main">
                                <?php
                                //echo wp_count_posts('course');
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                $course_query = new WP_Query([
                                    'post_type' => 'course',
                                    'posts_per_page' => 2,
                                    'orderby' => 'date',
                                    'order' => 'DESC',
                                    'paged' => $paged,
                                ]);
                                ?>

                                <div class="special-courses-inner">
                                    <div class="loader-bg"></div>
                                    <?php if ($course_query->have_posts()) : ?>
                                        <?php
                                        while ($course_query->have_posts()) : $course_query->the_post();

                                        ?>
                                            <div class="special-course-single">
                                                <div class="special-course-single-inner">
                                                    <div class="special-course-img">
                                                        <?php the_post_thumbnail(); ?>
                                                    </div>

                                                    <div class="special-course-details">
                                                        <div class="special-course-title">
                                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                        </div>
                                                        <?php
                                                        $course_id = get_the_ID();
                                                        $product_id = get_post_meta($course_id, 'vibe_product', true);
                                                        $product = wc_get_product($product_id);

                                                        $average_rating = get_post_meta(get_the_ID(), 'average_rating', true);
                                                        $count = get_post_meta(get_the_ID(), 'rating_count', true);
                                                        $breakup = wplms_get_rating_breakup();
                                                        $ratings = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0);
                                                        foreach ($breakup as $value) {
                                                            $ratings[$value->val] = intval($value->count);
                                                        }

                                                        ?>

                                                        <div class="special-course-reviews">
                                                            <div class="custom-rating-wrapper">
                                                                <?php
                                                                echo '<div class="modern-star-rating">';
                                                                if (function_exists('bp_course_display_rating')) {
                                                                    echo bp_course_display_rating($average_rating);
                                                                } else {
                                                                    for ($i = 1; $i <= 5; $i++) {
                                                                        if ($average_rating >= 1) {
                                                                            echo '<span class="fa fa-star"></span>';
                                                                        } elseif (($average_rating < 1) && ($average_rating >= 0.3)) {
                                                                            echo '<span class="fa fa-star-half-o"></span>';
                                                                        } else {
                                                                            echo '<span class="fa fa-star-o"></span>';
                                                                        }
                                                                        $average_rating--;
                                                                    }
                                                                } ?>
                                                            </div>
                                                        </div>
                                                        <span class="sc-avg-rating"><?php echo (($average_rating) ? $average_rating : __('N.A', 'vibe')); ?></span>
                                                        <?php
                                                        if ($count < 1) {
                                                            echo '<span class="sc-review-count">(No Reviews)</span>';
                                                        } elseif ($count == 1) {
                                                            echo '<span class="sc-review-count">(' . $count . ' ' . __('Review', 'vibe') . ')</span>';
                                                        } else {
                                                            echo '<span class="sc-review-count">(' . $count . ' ' . __('Reviews', 'vibe') . ')</span>';
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <div class="special-course-price-qty">
                                                    <div class="qty-wrapper">
                                                        <button class="qty-minus">-</button>
                                                        <input type="number" name="course-qty" class="course-qty" min="1" value="1" readonly>
                                                        <button class="qty-plus">+</button>
                                                        <a href="<?php echo site_url(); ?>/?add-to-cart=<?php echo $product_id; ?>&quantity=1" class="buy-now" data-quantity="1">Buy Now For <?php echo $product->get_price() ? get_woocommerce_currency_symbol() . "" . $product->get_price() : "Free"; ?></a>
                                                    </div>

                                                </div>
                                            </div>
                                </div>
                            <?php
                                        endwhile;
                            ?>
                        <?php endif; ?>
                        <?php wp_reset_postdata(); ?>

                            </div>
                            <div id="ajax-loader"></div>
                            <div class="loadmore-btn-wrapper">
                                <button class="course-loadmore" id="load-more"><img src="<?php echo get_theme_file_uri(); ?>/assets/img/refresh-circle.png"><span>Load More Courses</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
<?php
    endwhile;
endif;
?>

<script>
    jQuery(document).on('click', '.qty-plus', function() {
        var qtyVal = parseInt(jQuery(this).prev().val(), 10);
        jQuery(this).prev().val(qtyVal += 1);

        //get qty value
        var qtyVal = jQuery(this).prev().val();
        //get url
        var getUrl = jQuery(this).next().attr('href');
        var url = new URL(getUrl);
        var search_params = url.searchParams;
        search_params.set('quantity', qtyVal);

        url.search = search_params.toString();

        var new_url = url.toString();
        getUrl = jQuery(this).next().attr('href', new_url);
        jQuery(this).next().attr('data-quantity', qtyVal);


    });
    jQuery(document).on('click', '.qty-minus', function() {
        var qtyVal = parseInt(jQuery(this).next().val(), 10);
        if (qtyVal == 1) {
            return;
        } else {
            jQuery(this).next().val(qtyVal -= 1);
        }

        //get qty value
        var qtyVal = jQuery(this).next().val();
        //get url
        var getUrl = jQuery(this).siblings(":last").attr('href');
        var url = new URL(getUrl);
        var search_params = url.searchParams;
        search_params.set('quantity', qtyVal);
        search_params.set('data-quantity', qtyVal);

        url.search = search_params.toString();

        var new_url = url.toString();
        getUrl = jQuery(this).siblings(":last").attr('href', new_url);
        jQuery(this).siblings(":last").attr('data-quantity', qtyVal);
    });
</script>



<?php
get_footer(vibe_get_footer());

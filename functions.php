<?php
add_action('wp_enqueue_scripts', 'wplms_child_theme_enqueue_styles');
function wplms_child_theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}


function for_B_oneEdu_single_course_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('single', get_theme_file_uri('/assets/css/single-course.css'), false, time(), 'all');
}
add_action('wp_enqueue_scripts', 'for_B_oneEdu_single_course_enqueue_styles');


add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback()
{
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];

    $args = array(
        'post_type' => 'course',
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
    );

    $my_posts = new WP_Query($args);
    if ($my_posts->have_posts()) :
        while ($my_posts->have_posts()) : $my_posts->the_post();

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
                        <a href="<?php echo site_url(); ?>/?add-to-cart=<?php echo $product_id; ?>&quantity=1" class="buy-now" data-quantity="1">Buy Now For <?php echo $product->price ? get_woocommerce_currency_symbol() . "" . $product->price : "Free"; ?></a>
                    </div>

                </div>
            </div>
            </div>
            <?php
        endwhile;
    endif;
    wp_die();
}

// Course search

add_action('wp_ajax_search_courses', 'search_courses_callback');
add_action('wp_ajax_nopriv_search_courses', 'search_courses_callback');

function search_courses_callback()
{
    $search_term = $_POST['search_term'];
    $args = array(
        'post_type' => 'course',
        'post_status' => 'publish',
        's' => $search_term,
        'posts_per_page' => -1
    );
    $courses = new WP_Query($args);

    if (strlen($search_term) < 3) {
        echo "Type at least 3 or more character";
    } else {
        if ($courses->have_posts()) {
            while ($courses->have_posts()) {
                $courses->the_post();
                $search_title = get_the_title();
                $search_title = str_ireplace($search_term, '<span class="search-highlight">' . $search_term . '</span>', $search_title);
            ?>
                <a href="<?php the_permalink(); ?>" target="_blank">
                    <div class="search-course-wrapper">
                        <div class="search-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
                        <div class="search-title">
                            <h3><?php echo $search_title; ?></h3>
                        </div>
                    </div>
                </a>
    <?php
            }
        } else {
            echo 'No courses found';
        }
        wp_reset_postdata();
    }
    wp_die();
}



function ajax_load_scripts()
{
    ?>
    <script>
        jQuery(document).ready(function($) {

            var post_count = "<?php echo ceil(wp_count_posts('course')->publish / 2); ?>";
            var page = 2;
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            jQuery('#load-more').click(function() {
                jQuery('#ajax-loader').show();
                jQuery('.loader-bg').show();
                jQuery("button#load-more img").css("animation", "spin 2s linear infinite");
                jQuery('#load-more span').text('Loading...');
                var data = {
                    'action': 'load_posts_by_ajax',
                    'page': page,
                    'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
                };

                jQuery.post(ajaxurl, data, function(response) {
                    jQuery('#ajax-loader').hide();
                    jQuery('.loader-bg').hide();
                    jQuery("button#load-more img").css("animation", "none");
                    jQuery('#load-more span').text('Load More Courses');
                    jQuery('.special-courses-inner').append(response);
                    if (post_count == page) {
                        jQuery('#load-more').hide();
                    }
                    page++;
                });
            });
        });

        jQuery(document).ready(function($) {
            jQuery('#course-search-input').on('keyup', function() {
                jQuery("input.oe-course-search").css("border-bottom", "2px solid #625FFF");
                jQuery("#course-search-results").css("margin-top", "15px");
                var searchValue = $(this).val();
                if (searchValue.length >= 1) {
                    jQuery.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'post',
                        data: {
                            action: 'search_courses',
                            search_term: searchValue
                        },
                        success: function(response) {
                            $('#course-search-results').html(response);
                        }
                    });
                } else if (searchValue.length == "") {
                    jQuery("input.oe-course-search").css("border-bottom", "none");
                    jQuery('#course-search-results').html('');
                }

            });
        });
    </script>

<?php
}

add_action('wp_footer', 'ajax_load_scripts');

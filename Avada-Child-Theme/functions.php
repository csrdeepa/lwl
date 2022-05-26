<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
	wp_enqueue_script('themechildheaderscript', get_stylesheet_directory_uri() . '/child-headerscript.js', array('jquery'), '1.0.0', false );
	wp_enqueue_script('themechildfooterscript', get_stylesheet_directory_uri() . '/child-footerscript.js', array('jquery'), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

/**************/
require_once( get_stylesheet_directory() . '/shortcodesdesign/partnerslogo.php');
require_once( get_stylesheet_directory() . '/shortcodesdesign/posttypes.php');
require_once( get_stylesheet_directory() . '/shortcodesdesign/testimonials.php');


function testimonial_enqueue_styles() {
    wp_enqueue_style( 'testimonial-style', get_stylesheet_directory_uri() . '/shortcodesdesign/assets/common.css', [] );
	wp_enqueue_script('testimonial-script', get_stylesheet_directory_uri() . '/shortcodesdesign/assets/testimonials.js', array('jquery'), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'testimonial_enqueue_styles' );

function partnerslogo_enqueue_styles() {
    wp_enqueue_style( 'testimonial-style', get_stylesheet_directory_uri() . '/shortcodesdesign/assets/partners.css', [] );
}
add_action( 'wp_enqueue_scripts', 'partnerslogo_enqueue_styles' );
/**************/

if ( ! function_exists('vpsa_mediabloggrid_shortcode') ) {
        function vpsa_mediabloggrid_shortcode( $atts ){

            $atts = shortcode_atts( array(
							'post_type' =>   'post',
                            'per_page'  =>   2,  
                            'order'     =>  'DESC',
                            'orderby'   =>  'date'
                    ), $atts );

            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $args = array(
                'post_type'         =>  $atts["post_type"],
                'posts_per_page'    =>  $atts["per_page"], 
                'order'             =>  $atts["order"],
                'orderby'           =>  $atts["orderby"],
                'paged'             =>  $paged
            );
$post_type=$atts["post_type"];
            $query = new WP_Query($args);
                    if($query->have_posts()) : $output;
					$output .='<div class="tt-'.$post_type.'">';
                        while ($query->have_posts()) : $query->the_post();
							$post_content = apply_filters('the_content', get_post_field('post_content', get_the_id()));
                            $output .= '<article id="post-' . get_the_ID() . '" class="col-md-4 ' . implode(' ', get_post_class()) . '">';

                                $output .= '<div class="col">';

                                    $output .= '<div class="timg">'; 
                                        $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail( get_the_id(), 'featured', array('class' => 'img-responsive aligncenter'));
                                            } else {
                                               $output .= '<img class="img-responsive aligncenter" src="/wp-content/uploads/2022/05/No-Image-Placeholder.jpg" alt="Not Available" />';                                           
                                            }
                                    $output .= '</a>';
                                    $output .= '</div>';

                                    $output .= '<div class="tcontent">';
                                     $output .= '<p class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></p>';
                                    $output .= '<div class="arrow_mark_media"><span class="post-permalink"><a href="' . get_permalink() . '" title="' . the_title('','',false) . '"><img style="padding-right:15px;" class="img-responsive aligncenter" src="/wp-content/uploads/2022/04/right-arrow.svg" alt="Not Available" /></a></span>';
                                    $output .= '<span style="color:#878D92 !important;"> ' . get_the_time("F j, Y") . '</span></div>';
                                    $output .= '</div>';

                                $output .= '</div>';

                            $output .= '</article>';

                        endwhile;
					$output .= '</div>';
			global $wp_query;
    	$args_pagi = array(
//             'base' => add_query_arg( 'paged', '%#%' ),
			'base' => get_pagenum_link(1) . '%_%',
            'total' => $query->max_num_pages,
            'current' => $paged,
			'mid_size' => 3,
			'prev_text'    => __('<'),
            'next_text'    => __('>'),
            );
                        $output .= '<div class="post-nav">';
                         	$output .= paginate_links( $args_pagi);
                        $output .= '</div>';
                    else:
                        $output .= '<p>No Data found</p>';
                    endif;
                wp_reset_postdata();
                return $output;
        }
    }

    add_shortcode('vpsa_mediabloggrid', 'vpsa_mediabloggrid_shortcode');

/**************/
if ( ! function_exists('vpsa_posts_shortcode') ) {
        function vpsa_posts_shortcode( $atts ){

            $atts = shortcode_atts( array(
							'post_type' =>   'post',
                            'per_page'  =>   2,  
                            'order'     =>  'DESC',
                            'orderby'   =>  'date'
                    ), $atts );

            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            $args = array(
                'post_type'         =>  $atts["post_type"],
                'posts_per_page'    =>  $atts["per_page"], 
                'order'             =>  $atts["order"],
                'orderby'           =>  $atts["orderby"],
                'paged'             =>  $paged
            );

            $query = new WP_Query($args);
                    if($query->have_posts()) : $output;
					$output .='<div class=tt'.$atts["post_type"].'>';
                        while ($query->have_posts()) : $query->the_post();
                            $output .= '<article id="post-' . get_the_ID() . '" class="' . implode(' ', get_post_class()) . '">';
                                $output .= '<h4 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h4>';

                                $output .= '<div class="row">';
                                    $output .= '<div class="col-md-3">'; 
                                        $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail( get_the_id(), 'featured', array('class' => 'img-responsive aligncenter'));

                                            } else {

                                               $output .= '<img class="img-responsive aligncenter" src="' . get_template_directory_uri() . '/images/not-available.png" alt="Not Available" height="150" width="200" />';                                           
                                            }
                                    $output .= '</a>';
                                    $output .= '</div>';
                                    $output .= '<div class="col-md-9">';
                                    $output .= get_the_excerpt();
                                    $output .= '<span class="post-permalink"><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">Read More</a></span>';
                                    $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="post-info">';
                                    $output .= '<ul>';
                                        $output .= '<li>Posted: ' . get_the_time("F j, Y") . '</li>';
                                        $output .= '<li>By: ' . get_the_author() . '</li>';
                                        $output .= '<li>Categories: ' . get_the_category_list(", ") . '</li>';
                                    $output .= '</ul>';
                                $output .= '</div>';
                            $output .= '</article>';

                        endwhile;
					$output .= '</div>';
			global $wp_query;
    	$args_pagi = array(
//             'base' => add_query_arg( 'paged', '%#%' ),
			'base' => get_pagenum_link(1) . '%_%',
            'total' => $query->max_num_pages,
            'current' => $paged,
			'prev_text'    => __('« prev'),
            'next_text'    => __('next »'),
            );
                        $output .= '<div class="post-nav">';
                         	$output .= paginate_links( $args_pagi);
                        $output .= '</div>';
                    else:
                        $output .= '<p>No Data found</p>';
                    endif;
                wp_reset_postdata();
                return $output;
        }
    }

    add_shortcode('vpsa_posts', 'vpsa_posts_shortcode');

/*******************************************#POST CAROUSEL*********************************************/
 

// Product Category Carousel

function categoryenqueue_styles() {
    wp_enqueue_style('sz_fontaw','https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', '', '','all');
    wp_enqueue_style('owl-carl','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css', '', '','all');
    wp_enqueue_style('owl-carltheme','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', '', '','all');
    wp_enqueue_style('owl-carl-2.1.6','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.css', '', '','all');
    wp_enqueue_script('owl-js','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2//2.0.0-beta.2.4/owl.carousel.min.js',array('jquery'),'1.12.4', false);
    wp_enqueue_style('tt_owlcalrlightbox','https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.min.css', '', '','all');	
}
add_action( 'wp_enqueue_scripts', 'categoryenqueue_styles', 50 );
 
function category_carousel($atts, $content = null){ 
    ob_start();
      get_template_part('category', '', $args);
    return ob_get_clean();
}
add_shortcode('category_carousel','category_carousel');


////// *************** Mentors POST Carousel ************/
//[post_carousel post_type='post', category="blog"]
add_shortcode('post_carousel','post_carousel');
function post_carousel($atts, $content = null)
{ 
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			), $atts, $tag
		);
 
		?>
    <div class="postcarouselWrapper">
        <div class="postcarouselDemoWrapper">
            <?php post_list($atts, $additonalArr); ?>
        </div>
    </div>
    <?php

    //   get_template_part('postgrid', '', $args);
    return ob_get_clean();
}

function post_list($args, $additonalArr)
{
	$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => $args['post_type'],
        'category_name' =>  $args['category'],
 
        )
    );
	//  var_dump($posts);
	echo '<div class="post_carousel">';   
	if ( $posts && ! is_wp_error( $posts ) ) {
	
		echo '<div class="owl-carousel">';
		foreach( $posts as $post ) :
			$thumb_url = get_the_post_thumbnail_url( $post->ID, $size ); 
			$excerpt_count = 15;
			$postid = get_post($post->ID);
			$postmeta = get_post_meta($post->ID);
            // var_dump($postmeta);
			if (empty($post->post_excerpt))
				$excerpt = $post->post_content;
			else
				$excerpt = $post->post_excerpt;

			// $exp = do_shortcode(force_balance_tags(html_entity_decode(wp_trim_words(htmlentities($excerpt), $excerpt_count, '…'))));			
			?>

            <div class="citem">
                <a data-lightbox="gallery">
                    <img src="<?php echo $thumb_url ?>" alt="<?php echo $post->post_title; ?>" />
                </a>
                <div class="citemcontent">
                    <h5><span style="color:#878D92"><?php echo $post->post_title; ?></span></h5>
                    <p style="padding-bottom:10px;color:#fff"><?php echo the_field('mentor_university', $post->ID);    ?></p>
                    <div class="gridbottom">
                        <p style=" color:#F1B537; margin-bottom:0"><?php echo the_field('mentor_department', $post->ID);  ?></p>
                        <a href="<?php echo get_permalink( $postid ) ?>"><img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow"
                                style=" padding-left: 5px;width:25px"></a>
                    </div>

                </div>
            </div>

            <?php
		endforeach; 
		echo '</div>';
	}
	echo '</div>'; 
}

add_action("wp_head", "postgridcss");
function postgridcss()
{
	?>
    <style>
        .owl-item>div:after {
            font-family: sans-serif;
            font-size: 24px;
            font-weight: bold;
        }

        /* .owl-theme .owl-controls .owl-nav [class*='owl-']{
                    background: #8bc34a;
                    padding: 0px 8px;
                } */
        .owl-dots {
            display: none !important;
        }

        .owl-theme .owl-controls {
            position: absolute;
            top: 25%;
            z-index: 9999;
            width: 100%;
        }

        .owl-theme .owl-controls .owl-nav {
            display: flex;
            justify-content: space-between;
        }

        .owl-theme .owl-controls .owl-nav [class*='owl-'] {
            background: #ffffff00;
            padding: 10px 17px;
            border-radius: 50%;
            border: 2px solid #000;
        }

        .owl-carousel .owl-item h3 {
            padding-top: 15px;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .citem {
            text-align: center;
            padding-bottom: 15px;
            height: 100%;
        }

        .owl-carousel .owl-item .citem a {
            color: #fff;
            padding: 6px 20px;
            border-radius: 20px;
        }

        .post_carousel .owl-carousel .owl-prev {
            margin-left: -50px !important;
        }

        .post_carousel .owl-carousel .owl-next {
            margin-right: -50px !important;
        }

        .owl-theme .owl-controls .fa:before {
            color: #000;
        }

        .owl-carousel .owl-item .citem a:hover {
            background-color: transparent;
        }

        .citemcontent {
            position: absolute;
            bottom: 0;
            /* 			background-color: #000; */
            width: 100%;
            padding: 30px 10px 10px;
            background-image: linear-gradient(0deg, black 70%, #ffffff00);
            text-align: left;
        }

        .owl-carousel .owl-item {
            background-color: #000;
            border-radius: 15px;
            overflow: hidden;
        }

        .owl-carousel .owl-item img {
            transform-style: preserve-3d;
            height: 100%;
        }

        .gridbottom {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            align-content: center;
            flex-direction: row;
        }

        .projectfeatures_owl-carousel .citem {
            max-height: 400px !important;
        }
		.post_carousel .owl-item:hover {
			box-shadow: rgb(224 224 224 / 37%) 0px 2px 8px 0px;
		}
        /* 		.postcarouselWrapper .owl-carousel .owl-item.active:nth-child(even) a {
                    -webkit-filter: grayscale(1);
                    filter: grayscale(1);
                }
                .postcarouselWrapper .owl-carousel .owl-item.active:hover a {
                    filter: none;
                } */
        @media only screen and (max-width: 600px) {
            .citem {
                max-width: 320px;
                margin: auto;
            }
        }

        @media only screen and (max-width: 400px) {
            .owl-theme .owl-controls .owl-nav [class*='owl-'] {
                background: #ffffff00;
                padding: 4px 12px;
            }

            .post_carousel .owl-carousel .owl-prev {
                margin-left: -40px !important;
            }

            .post_carousel .owl-carousel .owl-next {
                margin-right: -40px !important;
            }
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            var owl = jQuery('.owl-carousel');
            owl.owlCarousel({
                loop: true,
                nav: true,
                arrows: true,
                margin: 15,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    601: {
                        items: 2
                    },
                    // 					981:{
                    // 						items:2
                    // 					},
                    1201: {
                        items: 3
                    }
                }
            });
            owl.on('mousewheel', '.owl-stage', function(e) {
                if (e.deltaY > 0) {
                    owl.trigger('next.owl');
                } else {
                    owl.trigger('prev.owl');
                }
                e.preventDefault();
            });
        });
    </script>
    <?php
}
////// *************** #projectfeatures_carousel POST Carousel ************/
//[projectfeatures_carousel post_type='project_features', category="blog"]
add_shortcode('projectfeatures_carousel','projectfeatures_carousel');
function projectfeatures_carousel($atts, $content = null)
{ 
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			), $atts, $tag
		);
 
		?>
    <div class="postcarouselWrapper">
        <div class="postcarouselDemoWrapper">
            <?php projectfeature_list($atts, $additonalArr); ?>
        </div>
    </div>
    <?php

    //   get_template_part('postgrid', '', $args);
    return ob_get_clean();
}

function projectfeature_list($args, $additonalArr)
{
	$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => $args['post_type'],
        'category_name' =>  $args['category'],
 
        )
    );
	//  var_dump($posts);
	echo '<div class="projectfeatures_carousel">';   
	if ( $posts && ! is_wp_error( $posts ) ) {
	
		echo '<div class="projectfeatures_owl-carousel">';
		foreach( $posts as $post ) :
			$thumb_url = get_the_post_thumbnail_url( $post->ID, $size ); 
			$excerpt_count = 15;
			$postid = get_post($post->ID);
			$postmeta = get_post_meta($post->ID);
            // var_dump($postmeta);
			if (empty($post->post_excerpt))
				$excerpt = $post->post_content;
			else
				$excerpt = $post->post_excerpt;

			// $exp = do_shortcode(force_balance_tags(html_entity_decode(wp_trim_words(htmlentities($excerpt), $excerpt_count, '…'))));			
			?>

            <div class="citem">
                <img src="<?php echo $thumb_url ?>" alt="<?php echo $post->post_title; ?>" />
                <div class="citemcontent">
                    <h5><span style="color:#878D92"><?php echo $post->post_title; ?></span></h5>
                    <p style="padding-bottom:10px;color:#fff"><?php echo the_field('mentor_university', $post->ID);    ?></p>
                    <div class="gridbottom">
                        <p style=" color:#F1B537; margin-bottom:0"><?php echo the_field('mentor_department', $post->ID);  ?></p>
                        <a href="<?php the_permalink(); ?>"><img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow"
                                style="width:25px"></a>
                    </div>

                </div>
            </div>

            <?php
		endforeach; 
		echo '</div>';
	}
	echo '</div>'; 
}

add_action("wp_head", "projectfeaturegridcss");
function projectfeaturegridcss()
{
	?>
    <style>
        .owl-item>div:after {
            font-family: sans-serif;
            font-size: 24px;
            font-weight: bold;
        }

        /* .owl-theme .owl-controls .owl-nav [class*='owl-']{
                    background: #8bc34a;
                    padding: 0px 8px;
                } */
        .owl-dots {
            display: none !important;
        }

        .owl-theme .owl-controls {
            position: absolute;
            top: 25%;
            z-index: 9999;
            width: 100%;
        }

        .owl-theme .owl-controls .owl-nav {
            display: flex;
            justify-content: space-between;
        }

        .owl-theme .owl-controls .owl-nav [class*='owl-'] {
            background: #ffffff00;
            padding: 10px 17px;
            border-radius: 50%;
            border: 2px solid #000;
        }

        .projectfeatures_owl-carousel .owl-item h3 {
            padding-top: 15px;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .citem {
            text-align: center;
            padding-bottom: 15px;
            height: 100%;
        }

        .projectfeatures_owl-carousel .owl-item .citem a {
            color: #fff;
            padding: 6px 20px;
            border-radius: 20px;
        }

        .projectfeatures_carousel .projectfeatures_owl-carousel .owl-prev {
            margin-left: -50px !important;
        }

        .projectfeatures_carousel .projectfeatures_owl-carousel .owl-next {
            margin-right: -50px !important;
        }

        .owl-theme .owl-controls .fa:before {
            color: #000;
        }

        .projectfeatures_owl-carousel .owl-item .citem a:hover {
            background-color: transparent;
        }

        .citemcontent {
            position: absolute;
            bottom: 0;
            /* 			background-color: #000; */
            width: 100%;
            padding: 30px 10px 10px;
            background-image: linear-gradient(0deg, black 70%, #ffffff00);
            text-align: left;
        }

        .projectfeatures_owl-carousel .owl-item {
            background-color: #000;
            border-radius: 15px;
            overflow: hidden;
        }

        .projectfeatures_owl-carousel .owl-item img {
            transform-style: preserve-3d;
            height: 100%;
        }

        .gridbottom {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            align-content: center;
            flex-direction: row;
        }

        @media only screen and (max-width: 400px) {
            .owl-theme .owl-controls .owl-nav [class*='owl-'] {
                background: #ffffff00;
                padding: 4px 12px;
            }

            .projectfeatures_carousel .projectfeatures_owl-carousel .owl-prev {
                margin-left: -40px !important;
            }

            .projectfeatures_carousel .projectfeatures_owl-carousel .owl-next {
                margin-right: -40px !important;
            }
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            var owl = jQuery('.projectfeatures_owl-carousel');
            owl.owlCarousel({
                loop: true,
                nav: true,
                arrows: true,
                margin: 15,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    601: {
                        items: 2
                    },
                    // 					981:{
                    // 						items:2
                    // 					},
                    1201: {
                        items: 2
                    }
                }
            });
            owl.on('mousewheel', '.owl-stage', function(e) {
                if (e.deltaY > 0) {
                    owl.trigger('next.owl');
                } else {
                    owl.trigger('prev.owl');
                }
                e.preventDefault();
            });
        });
    </script>
    <?php
}
////// *************** @projectfeatures_carousel POST Carousel ************/


/**************# Single page Layout shortcodes*************/
/**************# top container details*************/
add_action('wp_head','post_topseccss');
function post_topseccss()
{
    ?>
    <style>
        .post_topsec {
            background-color: #292929;
            padding-top: 40px 0px;
            ;
            position: relative;
        }

        p {
            margin-bottom: 0px !important;
        }

        .post_topsec span {
            color: #878D92;
            font-size: 16px;
        }

        .post_topsec .post_topcol .post_toprow1 .rightsec {
            width: 125px;
            background-color: #323232;
            padding: 10px;
            position: absolute;
            right: 50px;
            top: 0;
            border-radius: 0px 0px 5px 5px;
        }

        .post_topsec .post_separator {
            border-bottom: 1px solid #363636;
        }

        .post_topsec .post_sepspace {
            padding: 20px 60px;
        }

        .leftsec {
            display: flex;
            width: calc(100% - 150px);
        }

        .leftsec3 div:not(:last-child),
        .rightsec3 div:not(:last-child) {
            padding-right: 25px;
        }

        .leftsec3 div p:first-child {
            color: #878D92;
            font-size: 15px;
        }

        .leftsec3 div p:nth-child(2) {
            color: #fff;
            font-size: 17px;
        }

        .leftsec3 div p:nth-child(3) {
            color: #F1B537;
            font-size: 12px;
        }

        .post_toprow3 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post_toprow4 p {
            color: #fff;
            font-size: 16px;
        }

        .post_toprow4 {
            display: flex;
            align-items: center;
        }

        .post_toprow4 p {
            padding-right: 25px;
        }

        .post_toprow4 a {
            border: 1px solid #878D92;
            border-radius: 5px;
            padding: 7px 13px;
            color: #878D92;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .post_toprow4 a:not(:last-child) {
            margin-right: 10px;
        }

        .leftsec3 {
            display: flex;
            flex-wrap: wrap;
        }

        .rightsec3 {
            display: flex;
            align-items: center;
        }

        .download a {
            color: #F1B537;
            font-size: 15px;
            display: flex;
        }

        .applynow a {
            color: #121212;
            font-size: 20px;
            font-weight: 500;
            background-color: #F1B537;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .list_dates {
            display: flex;
            flex-wrap: wrap;
        }

        .post_topsec .imggallery {
            display: flex;
            flex-direction: column;
        }

        .post_topsec span.logogallery img:not(:last-child) {
            padding-right: 10px;
        }

        .post_topsec span.logogallery img {
            padding-top: 2px;
            padding-bottom: 2px;
        }
		.post_topsec span.logogallery img {
			max-width: 250px;
		}
		.header_right button,
		.applynow .lt_apply.typeapply button {
			color: #121212 !important;
			font-size: 20px !important;
			font-weight: 500 !important;
			background-color: #F1B537 !important;
			padding: 10px 15px !important;
			border-radius: 5px !important;
			font-family: 'Inter' !important;
			height: auto !important;
			line-height: normal !important;
		}
        @media only screen and (max-width: 1200px) {
            .post_toprow3 {
                align-items: flex-start;
                flex-direction: column;
            }

            .leftsec {
                display: grid;
            }

            .leftsec span,
            .rightsec span,
            .rightsec3,
            .leftsec3,
            .leftsec3 div {
                padding-bottom: 20px;
            }
        }

        @media only screen and (max-width: 800px) {
            .post_topsec .post_sepspace {
                padding: 20px 20px;
            }

            .post_toprow4 {
                flex-direction: column;
            }

            .post_topsec .post_topcol .post_toprow1 .rightsec {
                right: 25px;
            }

            .post_topsec h2.post_title {
                font-size: 25px !important;
            }

            .post_topsec .post_topcol .post_toprow1 .rightsec {
                position: relative;
                right: 0;
                border-radius: 5px;
            }

            .post_toprow1 {
                flex-direction: column;
            }
        }

        @media only screen and (max-width: 500px) {
            .rightsec3 {
                display: flex;
                flex-direction: column;
                width: 100%;
            }

            .rightsec3 div:not(:last-child) {
                padding-right: 0px !important;
                padding-bottom: 15px;
            }
        }
    </style>
    <?php
}
add_shortcode('certificateprograms_topsecdetails','certificateprograms_topsecdetails');
function certificateprograms_topsecdetails()
{
	ob_start();	
	$cp_start_date =get_field('cp_start_date');
	$cp_eligibility=get_field('cp_eligibility'); 
	$cp_duration=get_field('cp_duration'); 
	$cp_early_application_date=get_field('cp_early_application_date'); 
	$cp_early_application_fee=get_field('cp_early_application_fee'); 
	
	$cp_regular_app_date=get_field('regular_date'); 
	$cp_regular_app_fee=get_field('regular_fee'); 
	
	$badgeimage_id = get_field('badge_image');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	$brochure_id = get_field('cp_download_brochure');
	
	$gallerylogo = get_field('logo_gallery');
	
	$upcommingdates = get_field('upcoming_dates');
	$typeform_button = get_field('typeform_html_code');	
	
			?>
    <div class="post_topsec">
        <div class="post_topcol">
            <div class="post_toprow1 post_separator post_sepspace" style="display:flex;justify-content: space-between;">
                <div class="leftsec">

                    <?php if( $badgeimage_id ) { ?>
                    <span style="display:flex; flex-direction: column; padding-right:20px;"
                        class="<?php echo $badgeimage_id["id"] ?>">
                        In collaboration with
                        <?php echo wp_get_attachment_image( $badgeimage_id["id"], $size ); ?>
                    </span>
                    <?php } ?>

                    <?php if( $gallerylogo ): ?>
                    <div class="imggallery">
                        <span>Host School</span>
                        <span class="logogallery">
                            <?php foreach( $gallerylogo as $image_id ):  
                                            echo wp_get_attachment_image( $image_id["id"], $size );
                                        endforeach; ?>
                        </span>
                    </div>
                    <?php endif; ?>

                </div>
                <?php if( $cp_start_date ): ?>
                <div class="rightsec">

                    <p style="color:#878D92;">Starts on</p>
                    <p style="color:#F1B537;font-size: 24px; font-weight: 600;">
						<?php $date = str_replace('/', '-', $cp_start_date); 
										   echo date('d M', strtotime($date)); ?></p>
                    <p style="color:#fff;"><?php echo date('Y', strtotime($date)); ?></p>

                </div>
                <?php endif; ?>
            </div>

            <div class="post_toprow2 post_separator post_sepspace">
                <h2 class="post_title"><?php echo get_the_title(); ?></h2>
                <span style="color:#878D92;"><?php echo wp_trim_words( get_the_content(), 15, '...' ); ?></span>
            </div>

            <div class="post_toprow3 post_separator post_sepspace">
                <div class="leftsec3">
                    <?php if( $cp_eligibility ): ?> <div>
                        <p>Eligibility</p>
                        <p><?php echo $cp_eligibility; ?></p>
                    </div><?php endif; ?>
                    <?php if( $cp_duration ): ?> <div>
                        <p>Duration</p>
                        <p><?php echo $cp_duration; ?></p>
                    </div><?php endif; ?>
                    <div>
                        <?php if( $cp_early_application_date ): ?><p>Early Application Date</p>
                        <p><?php echo $cp_early_application_date;?> </p><?php endif; ?>
                        <?php if( $cp_regular_app_date ): ?> <p>[Regular Date: <?php echo $cp_regular_app_date ?>]</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if( $cp_early_application_fee ): ?> <p>Early Application Fee</p>
                        <p> <?php echo $cp_early_application_fee; ?></p><?php endif; ?>
                        <?php if( $cp_regular_app_fee ): ?> <p>[Regular Fee: <?php echo $cp_regular_app_fee ?>]</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="rightsec3">
                    <?php if( $brochure_id ) { ?> <div class="download"><a
                            href="<?php echo ($brochure_id["url"]); ?>">Download Brochure
                            <img class="alignnone size-large wp-image-248"
                                src="/wp-content/uploads/2022/05/clarity_download-line.svg" alt="" />
                        </a></div><?php } ?>
                    <div class="applynow">
						<div class="lt_apply typeapply"><?php echo $typeform_button ?></div>
<!-- 						<a target="_blank" href="">Apply Now <i class="fa-angle-down fas button-icon-right" aria-hidden="true"></i></a> -->
					</div>
                </div>
            </div>

            <?php if( $upcommingdates ): ?>
            <div class="post_toprow4 post_sepspace">
                <p>Upcoming Program Dates</p>
                <div class="list_dates">
                    <?php $i=0; 
                                    foreach( $upcommingdates as $date ): 
                                            $dt=$upcommingdates[$i]; 
												$dt=$dt["pick_date"]; $i++;?>
                    <?php if($dt){ ?><a><?php echo str_replace('string(10)', '', $dt); ?></a><?php } ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
    <?php
	return ob_get_clean();
}
add_shortcode('comp_invest','comp_invest');
function comp_invest()
{
	ob_start();	
	$invest_startdate =get_field('invest_startdate');
	$invest_startdate_leftdetail=get_field('invest_startdate_leftdetail'); 
	$invest_startdate_leftprice=get_field('invest_startdate_leftprice'); 

	$invest_startdate_rightdetail=get_field('invest_startdate_rightdetail'); 
	$invest_startdate_rightprice =get_field('invest_startdate_rightprice'); 

	$invest_center_content=get_field('invest_center_content'); 

	$invest_enddate=get_field('invest_enddate'); 
	$invest_enddate_leftdetail=get_field('invest_enddate_leftdetail'); 
	$invest_enddate_leftprice=get_field('invest_enddate_leftprice'); 

	$invest_enddate_rightdetail=get_field('invest_enddate_rightdetail'); 
	$invest_enddate_rightprice=get_field('invest_enddate_rightprice'); 


	?>
<div class="invconsume">
    <div class="invleft">
        <div class="level1"><?php echo $invest_startdate ?></div>
        <div class="inner">
            <div class="innerleft">
                <p><?php echo $invest_startdate_leftdetail ?></p>
                <h6><?php echo $invest_startdate_leftprice ?></h6>
            </div>
            <div class="innerright">
            <p><?php echo $invest_startdate_rightdetail ?></p>
                <h6><?php echo $invest_startdate_rightprice ?></h6>
            </div>
        </div>
    </div>
    <div class="invcenter">
        <div class="circle">
            <div class="circle__inner">
                <div class="circle__wrapper">
                    <div class="circle__content"><?php echo $invest_center_content ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="invright">
        <div class="level1">August, 2021</div>
        <div class="inner">
            <div class="innerleft">
                <p><?php echo $invest_enddate_leftdetail ?></p>
                <h6><?php echo $invest_enddate_leftprice ?></h6>
            </div>
            <div class="innerright">
            <p><?php echo $invest_enddate_rightdetail ?></p>
                <h6><?php echo $invest_enddate_rightprice ?></h6>
            </div>
        </div>
    </div>
</div>
<?php
	return ob_get_clean();
}


add_shortcode('post_topsec','competitions_topsecdetails');
add_shortcode('competitions_topsecdetails','competitions_topsecdetails');
function competitions_topsecdetails()
{
	ob_start();	
	$cp_start_date =get_field('cp_start_date');
	$cp_eligibility=get_field('cp_eligibility'); 
	$cp_duration=get_field('cp_duration'); 
	$cp_early_application_date=get_field('cp_early_application_date'); 
	$cp_early_application_fee=get_field('cp_early_application_fee'); 
	
	$cp_regular_app_date=get_field('regular_date'); 
	$cp_regular_app_fee=get_field('regular_fee'); 
	
	$badgeimage_id = get_field('badge_image');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	$brochure_id = get_field('cp_download_brochure');
	
	$gallerylogo = get_field('logo_gallery');
	
	$upcommingdates = get_field('upcoming_dates');
	$typeform_button = get_field('typeform_html_code');	
			?>
    <div class="post_topsec">
        <div class="post_topcol">
            <div class="post_toprow1 post_separator post_sepspace" style="display:flex;justify-content: space-between;">
                <div class="leftsec">

                    <?php if( $badgeimage_id ) { ?>
                    <span style="display:flex; flex-direction: column; padding-right:20px;"
                        class="<?php echo $badgeimage_id["id"] ?>">
                        In collaboration with
                        <?php echo wp_get_attachment_image( $badgeimage_id["id"], $size ); ?>
                    </span>
                    <?php } ?>

                    <?php if( $gallerylogo ): ?>
                    <div class="imggallery">
                        <span>Host School</span>
                        <span class="logogallery">
                            <?php foreach( $gallerylogo as $image_id ):  
                                            echo wp_get_attachment_image( $image_id["id"], $size );
                                        endforeach; ?>
                        </span>
                    </div>
                    <?php endif; ?>

                </div>
                <?php if( $cp_start_date ): ?>
                <div class="rightsec">

                    <p style="color:#878D92;">Starts on</p>
                        <p style="color:#F1B537;font-size: 24px; font-weight: 600;">
						<?php $date = str_replace('/', '-', $cp_start_date); 
										   echo date('d M', strtotime($date)); ?></p>
                    <p style="color:#fff;"><?php echo date('Y', strtotime($date)); ?></p>

                </div>
                <?php endif; ?>
            </div>

            <div class="post_toprow2 post_separator post_sepspace">
                <h2 class="post_title"><?php echo get_the_title(); ?></h2>
                <span style="color:#878D92;"><?php echo wp_trim_words( get_the_content(), 15, '...' ); ?></span>
            </div>

            <div class="post_toprow3 post_separator post_sepspace">
                <div class="leftsec3">
                    <?php if( $cp_eligibility ): ?> <div>
                        <p>Eligibility</p>
                        <p><?php echo $cp_eligibility; ?></p>
                    </div><?php endif; ?>
                    <?php if( $cp_duration ): ?> <div>
                        <p>Duration</p>
                        <p><?php echo $cp_duration; ?></p>
                    </div><?php endif; ?>
                    <div>
                        <?php if( $cp_early_application_date ): ?><p>Early Application Date</p>
                        <p><?php echo $cp_early_application_date;?> </p><?php endif; ?>
                        <?php if( $cp_regular_app_date ): ?> <p>[Regular Date: <?php echo $cp_regular_app_date ?>]</p>
                        <?php endif; ?>
                    </div>
                    <div>
                        <?php if( $cp_early_application_fee ): ?> <p>Early Application Fee</p>
                        <p> <?php echo $cp_early_application_fee; ?></p><?php endif; ?>
                        <?php if( $cp_regular_app_fee ): ?> <p>[Regular Fee: <?php echo $cp_regular_app_fee ?>]</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="rightsec3">
                    <?php if( $brochure_id ) { ?> <div class="download">
                        <a href="<?php echo ($brochure_id["url"]); ?>">Download Brochure</a>
                    </div><?php } ?>
					
                    <div class="applynow">
						<div class="lt_apply typeapply"><?php echo $typeform_button ?></div>
			<!-- <a href="#">Apply Now <i class="fa-angle-down fas button-icon-right" aria-hidden="true"></i></a> -->
					</div>
                </div>
            </div>

            <?php if( $upcommingdates ): ?>
            <div class="post_toprow4 post_sepspace">
                <p>Upcoming Program Dates</p>
                <div class="list_dates">
                    <?php $i=0; 
						foreach( $upcommingdates as $date ): 
							$dt=$upcommingdates[$i]; $dt=$dt["pick_date"]; ?>
                    <a><?php echo str_replace('string(10)', '', $dt); $i++;?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
    <?php
	return ob_get_clean();
}

/**************# top container details*************/
add_shortcode('tabcontentimage','tabcontentimage');
function tabcontentimage($atts, $content = null)
{ 
    ob_start();	
	$args = shortcode_atts(
		array(
			'prefix' => '',
			), $atts
		);
	
	$content=$atts["prefix"].'_content';
	$image=$atts["prefix"].'_image';
	$btntext=$atts["prefix"].'_btntext';
	
	$content_tab=get_field($content);
	$tabimage_id = get_field($image);
	$about_btntext = get_field($btntext); 
	$size = 'full'; // (thumbnail, medium, large, full or custom size)

	?>
    <div class="col-lg-12 certi-container">
        <div class="col-lg-6 col-md-12 col-sm-12 certi-tab-content">
            <p> <?php echo $content_tab; ?> </p>
            <?php if($about_btntext) { ?>
            <a href="#"> <?php echo $about_btntext; ?><img class="alignnone size-large wp-image-248"
                    src="/wp-content/uploads/2022/04/right-arrow.svg" alt="" width="15px" height="15px" /></a>
            <?php } ?>
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 certi-tab-image">
            <?php echo wp_get_attachment_image( $tabimage_id["id"], $size ); ?></div>
    </div>
    <?php
	return ob_get_clean();
}
/**************@ Single page Layout shortcodes*************/


function dcsEnqueue_scripts() {
    wp_localize_script( 'themechildfooterscript', 'dcs_frontend_ajax_object', array(  'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'dcsEnqueue_scripts',50 );

add_shortcode('ajaxloadmoreblogdemo','ajaxloadmoreblogdemo');
function ajaxloadmoreblogdemo($atts, $content = null)
{
    ob_start();
    $atts = shortcode_atts(
            array(
    'post_type' => 'post',
    'initial_posts' => '3',
    'loadmore_posts' => '3',
        'taxonomy'=>''
    ), $atts, $tag
        );
    $additonalArr = array();
    $additonalArr['appendBtn'] = true;
    $additonalArr["offset"] = 0; 
    $additonalArr["taxonomy"] = $atts['taxonomy']; 
    ?>
    <div class="dcsAllPostsWrapper">
        <input type="hidden" name="dcsPostType" value="<?=$atts['post_type']?>">
        <input type="hidden" name="offset" value="0">
        <input type="hidden" name="dcsloadMorePosts" value="<?=$atts['loadmore_posts']?>">
        <div class="dcsDemoWrapper">
            <?php dcsGetPostsFtn($atts, $additonalArr); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function dcsGetPostsFtn($atts, $additonalArr=array())
{ 
   $args = array(
     'post_type' => $atts['post_type'],
     'posts_per_page' => $atts['initial_posts'],
     'offset' => $additonalArr["offset"]
    );
    $the_query = new WP_Query( $args );
    $havePosts = true;
    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) {
            $the_query->the_post(); 

            $terms = get_the_terms( get_the_ID() , $additonalArr["taxonomy"] );
            
    ?>
        <div class="loadMoreRepeat">
            <div class="innerWrap">
                <div class="">
                    <div class="strip">
                        <figure>
                            <?php the_post_thumbnail('full'); ?>
                            <a href="<?php echo get_the_permalink(); ?>" class="strip_info">
                                <small><img src="img/Rectangle-209-1.png"></small>
                                <div class="item_title">
                                    <h3><?php echo get_the_title(); ?></h3>
                                    <small>
                                        <p class="leader_sp2"><?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?></p>
                                    </small>

                                    <div class="leader_sp6">
                                        <!-- 									<i class="fa fa-arrow-right"></i> -->
                                        <img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px"
                                            style=" padding-right: 5px;">
                                    </div>

                                </div>
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            $havePosts = false; 
        }
        wp_reset_postdata();
        if($havePosts && $additonalArr['appendBtn'] ){ ?>
        <div class="btnLoadmoreWrapper">
            <a href="javascript:void(0);" class="btn btn-primary dcsLoadMorePostsbtn">Load More</a>
        </div>

        <!-- loader for ajax -->
        <div class="dcsLoaderImg" style="display: none;">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" style="
            color: #ff7361;">
                <path fill="#ff7361"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                        to="360 50 50" repeatCount="indefinite"></animateTransform>
                </path>
            </svg>
        </div>

        <p class="noMorePostsFound" style="display: none;">No More Posts Found</p>
        <?php
    }
}

add_action("wp_ajax_dcsAjaxLoadMorePostsAjaxReq","dcsAjaxLoadMorePostsAjaxReq");
add_action("wp_ajax_nopriv_dcsAjaxLoadMorePostsAjaxReq","dcsAjaxLoadMorePostsAjaxReq");
function dcsAjaxLoadMorePostsAjaxReq()
{
    extract($_POST);
        $additonalArr = array();
        $additonalArr['appendBtn'] = false;
        $additonalArr["offset"] = $offset;
        $atts["initial_posts"] = $dcsloadMorePosts;
        $atts["post_type"] = $postType;
        dcsGetPostsFtn($atts, $additonalArr);
        die();
}
add_action('wp_head','loadmorecss');
function loadmorecss()
{ ?>
    <style>
        /* load more posts demo styles */
        .dcsDemoWrapper {
            display: flex;
            flex-wrap: wrap;
        }

        .dcsDemoWrapper .loadMoreRepeat {
            width: 33.33%;
            padding: 10px;
        }

        .dcsDemoWrapper .loadMoreRepeat .innerWrap {
            /*     background: #fff; */
            padding: 15px;
        }

        .btnLoadmoreWrapper {
            text-align: center;
            margin-top: 10px;
            width: 100%;
        }

        p.noMorePostsFound {
            text-align: center;
            width: 100%;
            margin-top: 20px;
            color: #F1B537;
            font-size: 18px;
        }

        svg {
            width: 100px;
            height: 100px;
            margin: 20px;
            display: inline-block;
        }

        .dcsLoaderImg {
            width: 100%;
            text-align: center;
        }

        .dcsDemoWrapper .strip figure {
            height: 380px;
            width: 100%;
            margin-bottom: 5px;
            overflow: hidden;
            position: relative;
            background-color: #ededed00;
            margin-right: 0px !important;
            margin-left: 0px !important;
        }

        a.btn.btn-primary.dcsLoadMorePostsbtn {
            color: #F1B537;
            border: 1px solid;
            padding: 10px 15px;
            border-radius: 5px;
        }

        @media(max-width:991px) {
            .dcsDemoWrapper .loadMoreRepeat {
                width: 50% !important;
                max-width: 320px;
            }

            .dcsDemoWrapper {
                justify-content: center;
            }
        }

        @media(max-width:767px) {
            .dcsDemoWrapper .loadMoreRepeat {
                width: 100% !important;
            }
        }

        @media(max-width:440px) {
            .dcsDemoWrapper .loadMoreRepeat {
                max-width: 310px;
            }
        }
    </style>
    <?php
}



add_shortcode('carouselwithallpost','carouselwithallpost');
function carouselwithallpost($atts, $content = null){
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			), $atts, $tag
		);
 
		?>
    <div class="postcarousellightWrapper">
        <div class="postcarouselDemolightWrapper">
            <?php carouselpost_list($atts, $additonalArr); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
function carouselpost_list($args, $additonalArr)
{
	$posts = get_posts(array(
        'post_status'    => 'publish',
//         'posts_per_page' => -1,
//         'post_type' => $args['post_type'],
        'posts_per_page' => 10,
		'orderby' => 'date',
    	'order' => 'DESC',
        'post_type' => array( 'certificate_programs', 'competitions','fellowships','conference','interships','fullscholarship'),         
        'category_name' =>  $args['category'],
        )
    );
    // 	 var_dump($posts);
	if ( $posts && ! is_wp_error( $posts ) ) { 
	echo	'<div class="container p-5 m-5 carousellightbox">';
	echo	'<div class="gallery-wrapper">';
	echo	'<div class="carobypt-carousel owl-carousel owl-theme">';
	foreach( $posts as $post ) :
			$thumb_url = get_the_post_thumbnail_url( $post->ID, $size ); 
			$excerpt_count = 15;
			$postid = get_post($post->ID);
			$postmeta = get_post_meta($post->ID);
			$posttype=get_post_type($postid );

			$startdate =get_field('cp_start_date',$postid);
			$duration=get_field('cp_duration',$postid); 
		
		$pt = get_post_type_object($posttype);
        // echo $pt->label;
        // echo $pt->labels->name;
        // echo $pt->labels->singular_name;

			// var_dump($posttype);
			if (empty($post->post_excerpt))
				$excerpt = $post->post_content;
			else
				$excerpt = $post->post_excerpt;
				$postdate=$post->post_date;
				$date=explode(" ",$postdate);
				$dates=date('d,F Y', strtotime($date[0]));
			?>

    <div class="item">
        <div class="image-wrapper">
            <div class="strip">
                <figure>
                    <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                                    if($feat_image){  
                                        echo '<img src="'. $feat_image .'" />';
                                    }
                                    else {
                                        echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
                                    } ?>
                    <a class="strip_info" href="<?php echo get_permalink( $postid ); ?>">

                        <div class="item_title">
                            <div class="leader_sp" style="color:#F1B537"><?php echo $pt->labels->name ?></div>
                            <h3><?php echo $post->post_title; ?></h3>
                            <small>
                                <p class="leader_sp2"><?php echo wp_trim_words($post->post_content,10) ?></p>
                            </small>
                            <div class="leader_sp3">
                                <div class="sp3">
									<?php if($startdate) { ?>
										<div class="leader_sp4">Starts on</div>
										<div class="leader_sp5"><?php echo $startdate;?></div>
									<?php } ?>
                                </div>
                                <div class="sp4">
									<?php if($duration) { ?>
										<div class="leader_sp4">Duration</div>
										<div class="leader_sp5"><?php echo $duration;?></div>
									<?php } ?>
                                </div>
                            </div>
                            <div class="leader_sp6">
                                <img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px">
                            </div>

                        </div>
                    </a>
                </figure>
            </div>
        </div>
    </div>
    <?php 	endforeach; ?>
    <?php 		echo	'</div> </div>';
	}
	?>
    <script>
    jQuery('.carobypt-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: true,
        dots: false,
		autoplay:true,
		navText: ["<img src='/wp-content/uploads/2022/04/left-arrow.svg'>","<img src='/wp-content/uploads/2022/04/right-arrow.svg'>"],		
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
    </script>
    <?php 	echo '</div>';  
}
	
add_shortcode('carouselwithlightbox','carouselwithlightbox');
function carouselwithlightbox($atts, $content = null){
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			'lightbox'=>'false',
			'col'=>4
			), $atts, $tag
		);
 
		?>
    <div class="postcarousellightWrapper">
        <div class="postcarouselDemolightWrapper">
            <?php carouselpostlightbox_list($atts, $additonalArr); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
function carouselpostlightbox_list($args, $additonalArr)
{
	$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => $args['post_type'],
        'category_name' =>  $args['category'],
        )
    );
    // 	 var_dump($posts);
	if ( $posts && ! is_wp_error( $posts ) ) { 
	echo	'<div class="container p-5 m-5 carousellightbox">';
	echo	'<div class="gallery-wrapper">';
	echo	'<div class="carobymen-carousel owl-carousel owl-theme">';
		$i=1;
        foreach( $posts as $post ) :
                $postid = get_post($post->ID);
                $postmeta = get_post_meta($post->ID);
                $posttype=get_post_type($postid );
            
				$mentor_university=get_field('mentor_university',$postid);
				$mentor_designation=get_field('mentor_designation',$postid);
				$mentor_department=get_field('mentor_department',$postid);
				// var_dump($posttype);
				?>
        <div class="item">
					<div class="image-wrapper">
						<div class="strip">
							<figure>
								<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
												if($feat_image){  
													echo '<img src="'. $feat_image .'" />';
												}
												else {
													echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
												} ?>
								<a href="#lightbox-image-<?php echo $i ?>" class="strip_info">
									 
									<div class="item_title">

										<h3 style="color:#878D92;font-size: 20px !important; margin-bottom: 3px;"><?php echo $post->post_title; ?></h3>
										<div class="leader_sp3" style=" margin-top: 5px;">
											<div class="sp3">
									<div class="leader_sp4" style="color:#fff;font-size: 18px !important;"><?php echo $mentor_university ?></div>
											</div>
										</div>
										<div class="leader_sp6">
											<div class="leader_sp4" style="color:#F1B537;font-size: 14px !important; display: flex; align-items: center;">
<!-- 											<a href="< ?php echo get_permalink( $postid ); ?>" style="display: flex; align-items: center;"></a> -->
											<?php echo $mentor_department ?>
											<img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px;margin-left:15px;">
											</div>
										</div>

									</div>
								</a>
							</figure>
						</div>
					</div>
				</div>
				
				 
        <?php 	$i++;
		endforeach; 
		echo	'</div> </div>'; 
		if($args['lightbox']){
		?>

    <div class="gallery-lightboxes">
        <?php 
        		$i=1;
                foreach( $posts as $post ) :
                        $postid = get_post($post->ID);
                        $postmeta = get_post_meta($post->ID);
                        $posttype=get_post_type($postid ); ?>

            <div class="image-lightbox" id="lightbox-image-<?php echo $i ?>">
                <div class="image-lightbox-wrapper">
                    <a href="#" class="close"></a>
                    <a href="#lightbox-image-<?php echo $i-1 ?>" class="arrow-left"></a>
                    <a href="#lightbox-image-<?php echo $i+1 ?>" class="arrow-right"></a>
                    <div>
						<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							if($feat_image){  
								echo '<img src="'. $feat_image .'" />';
							}
							else {
								echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
							} ?>
						<a href="#lightbox-image-<?php echo $i ?>" class="strip_info">
									 
								<div class="item_title">
								<h3 style="color:#878D92;font-size: 20px !important; margin-bottom: 3px;"><?php echo $post->post_title; ?></h3>
									<div class="leader_sp3" style=" margin-top: 5px;">
										<div class="sp3">
									<div class="leader_sp4" style="color:#fff;font-size: 18px !important;"><?php echo $mentor_university ?></div>
										</div>
									</div>
								<div class="leader_sp6">
								<div class="leader_sp4" style="color:#F1B537;font-size: 14px !important; display: flex; align-items: center;">
<!-- 								<a href="< ?php echo get_permalink( $postid ); ?>" style="display: flex; align-items: center;"></a> -->
										<?php echo $mentor_department ?>
										<img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px;margin-left:15px;">
											</div>
										</div>

									</div>
								</a>
                    </div>
                </div>
            </div>
            <?php 	$i++;
		    endforeach; ?>

    </div>
    
	<?php } }
     echo '</div>';  	?>
	    <script>
			jQuery('.carobymen-carousel').owlCarousel({
				loop: true,
//      		autoplay:true,
				margin: 20,
				nav: false,
				dots: false,
				center: false,
				autoWidth:true,
				responsive: {
					0: {
						items: 1,
						margin: 10
					},
					600: {
						items: 1,
						margin: 10
					},
					1000: {
						items: 4
					}
				}
			});
		</script>
<?
}

// Blog page
add_shortcode('carouselblogpage','carouselblogpage');
function carouselblogpage($atts, $content = null)
{ 
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			), $atts, $tag
		);
 
		?>
    <div class="postcarouselWrapper">
        <div class="postcarouselDemoWrapper">
            <?php carouselblog_list($atts, $additonalArr); ?>
        </div>
    </div>
    <?php

    //   get_template_part('postgrid', '', $args);
    return ob_get_clean();
}

function carouselblog_list($args, $additonalArr)
{
	$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => $args['post_type'],
        'category_name' =>  $args['category'],
 
        )
    );
	//  var_dump($posts);
	echo '<div class="post_carousel carouselblog stustories">';   
	if ( $posts && ! is_wp_error( $posts ) ) {
	
		echo '<div class="stustoriesblog">';
		foreach( $posts as $post ) :
			$thumb_url = get_the_post_thumbnail_url( $post->ID, $size ); 
			$excerpt_count = 15;
			$postid = get_post($post->ID);
			$postmeta = get_post_meta($post->ID);
            // var_dump($postmeta);
			if (empty($post->post_excerpt))
				$excerpt = $post->post_content;
			else
				$excerpt = $post->post_excerpt;		
			?>

		<div class="citem">
			<a data-lightbox="gallery">
				<img src="<?php echo $thumb_url ?>" alt="<?php echo $post->post_title; ?>" />
			</a>
			<div class="citemcontent">
				<p><span><?php echo $post->post_title; ?></span></p>
				<div class="bloggridbottom">
					<div style="display:flex;justify-content: space-between;">
						<p><?php echo the_field('student_name', $post->ID);  ?></p>		
						<p style="color:#878D92"> <?php echo get_the_date(); ?> </p>
					</div>

					<a href="<?php echo get_permalink($postid) ?>"><img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow"
																		  style="width:25px"></a>
				</div>

			</div>
		</div>

            <?php
		endforeach; 
		echo '</div>';
	}
	echo '</div>'; 
}
add_action("wp_head", "stustoriesblog");
function stustoriesblog()
{
	?>
    <style>
		.carouselblog .citem {
			max-height: 380px;
		}
		.carouselblog .owl-carousel {
			display: flex !important;
			flex-direction: column-reverse;
		}
		.carouselblog .owl-controls {
			position: relative !important;
			display: flex;
			justify-content: flex-end;
			top:0;
			right: 40px !important;
		}
		.carouselblog .owl-carousel .owl-controls .owl-nav .owl-next, 
		.carouselblog .owl-carousel .owl-controls .owl-nav .owl-prev {
			border: 0;
		}
		.carouselblog .owl-carousel .owl-controls .owl-nav .owl-next:hover, 
		.carouselblog .owl-carousel .owl-controls .owl-nav .owl-prev:hover {
			background: transparent;
		}
		.carouselblog p {
			font-size: 15px !important;
			color: #fff;
			padding-bottom: 15px;
			line-height: normal;
		} 
    </style>
    <script>
        jQuery(document).ready(function() {
            var owl = jQuery('.stustoriesblog');
            owl.owlCarousel({
                loop: true,
                nav: true,
                arrows: true,
                margin: 15,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                navText: ["<img src='/wp-content/uploads/2022/04/left-arrow.svg'>","<img src='/wp-content/uploads/2022/04/right-arrow.svg'>"],	
                responsive: {
                    0: {
                        items: 1
                    },
                    601: {
                        items: 2
                    },
                    // 981:{
                    // 		items:2
                    // },
                    1201: {
                        items: 3
                    }
                }
            });
            owl.on('mousewheel', '.owl-stage', function(e) {
                if (e.deltaY > 0) {
                    owl.trigger('next.owl');
                } else {
                    owl.trigger('prev.owl');
                }
                e.preventDefault();
            });
        });
    </script>
    <?php
}


// Hall of fame
add_shortcode('halloffameblogpage','halloffameblogpage');
function halloffameblogpage($atts, $content = null)
{ 
    ob_start();	
	$args = shortcode_atts(
		array(
			'post_type' => 'post',
			'initial_posts' => '3',
			'loadmore_posts' => '3',
			), $atts, $tag
		);
 
		?>
    <div class="postcarouselWrapper">
        <div class="postcarouselDemoWrapper">
            <?php halloffameblog_list($atts, $additonalArr); ?>
        </div>
    </div>
    <?php

    //   get_template_part('postgrid', '', $args);
    return ob_get_clean();
}

function halloffameblog_list($args, $additonalArr)
{
	$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => $args['post_type'],
        'category_name' =>  $args['category'],
 
        )
    );
	//  var_dump($posts);
	echo '<div class="post_carousel carouselblog halloffame">';   
	if ( $posts && ! is_wp_error( $posts ) ) {
	
		echo '<div class="halloffameblog">';
		foreach( $posts as $post ) :
			$thumb_url = get_the_post_thumbnail_url( $post->ID, $size ); 
			$excerpt_count = 15;
			$postid = get_post($post->ID);
			$postmeta = get_post_meta($post->ID);
            // var_dump($postmeta);
			if (empty($post->post_excerpt))
				$excerpt = $post->post_content;
			else
				$excerpt = $post->post_excerpt;		
			?>

		<div class="citem">
			<a data-lightbox="gallery">
				<img src="<?php echo $thumb_url ?>" alt="<?php echo $post->post_title; ?>" />
			</a>
			<div class="citemcontent">
				<p style="color:#F1B537"><?php echo the_field('fame_name', $post->ID);  ?></p>
				<div class="bloggridbottom">
					<p><span><?php echo $post->post_title; ?></span></p>
					<a href="<?php echo get_permalink($postid) ?>">
						<img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px">
					</a>
				</div>

			</div>
		</div>

            <?php
		endforeach; 
		echo '</div>';
	}
	echo '</div>'; 
}
add_action("wp_head", "halloffameblog");
function halloffameblog()
{
	?>
    <style>
		.halloffameblog .citem {
			max-height: 380px;
		}
		.halloffameblog .owl-carousel {
			display: flex !important;
			flex-direction: column-reverse;
		}
		.halloffameblog .owl-controls {
			position: relative !important;
			display: flex;
			justify-content: flex-end;
			top:0;
		}
		.halloffameblog .owl-carousel .owl-controls .owl-nav .owl-next, 
		.halloffameblog .owl-carousel .owl-controls .owl-nav .owl-prev {
			border: 0;
		}
		.halloffameblog .owl-carousel .owl-controls .owl-nav .owl-next:hover, 
		.halloffameblog .owl-carousel .owl-controls .owl-nav .owl-prev:hover {
			background: transparent;
		}
		.halloffameblog p {
			font-size: 15px !important;
			color: #fff;
			padding-bottom: 15px;
			line-height: normal;
		} 
    </style>
    <script>
        jQuery(document).ready(function() {
            var owl = jQuery('.halloffameblog');
            owl.owlCarousel({
                loop: true,
                nav: true,
                arrows: true,
                margin: 15,
                autoplay: false,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                navText: ["<img src='/wp-content/uploads/2022/04/left-arrow.svg'>","<img src='/wp-content/uploads/2022/04/right-arrow.svg'>"],	
                responsive: {
                    0: {
                        items: 1
                    },
                    601: {
                        items: 2
                    },
                    // 981:{
                    // 		items:2
                    // },
                    1201: {
                        items: 3
                    }
                }
            });
            owl.on('mousewheel', '.owl-stage', function(e) {
                if (e.deltaY > 0) {
                    owl.trigger('next.owl');
                } else {
                    owl.trigger('prev.owl');
                }
                e.preventDefault();
            });
        });
    </script>
    <?php
}

// blog post in blog page 
function myprefix_custom_grid_shortcode( $atts ) {

	$atts = shortcode_atts( array(
		'posts_per_page' => '-1',
		'term'           => ''
	), $atts, 'myprefix_custom_grid' );
	
	extract( $atts );
	$output = '';
	$query_args = array(
		'post_type'      => 'blogs', // Change this to the type of post you want to show
		'posts_per_page' =>4,
	);

	if ( $term ) {

		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'ID',
				'terms'    => $term,
			),
		);
	}

	$custom_query = new WP_Query( $query_args );

	if ( $custom_query->have_posts() ) {

		$output .= '<div>';

		while ( $custom_query->have_posts() ) {
			$custom_query->the_post();
			$output .= '<div style="color:#fff">' . get_the_title() . '</div>';
		}
		$output .= '</div>';
		wp_reset_postdata();
	}
	return $output;
}
// add_shortcode( 'myprefix_custom_grid', 'myprefix_custom_grid_shortcode' );
function w4dev_custom_loop_shortcode( $attrs ) {
    static $w4dev_custom_loop;
    if ( ! isset ( $w4dev_custom_loop ) ) {
		$w4dev_custom_loop = 1;
	} else {
		$w4dev_custom_loop ++;
	}

    $attrs = shortcode_atts( array(
        'paging'         => 'pg'. $w4dev_custom_loop,
        'post_type'      => 'blogs',
        'posts_per_page' => '3',
        'post_status'    => 'publish'
    ), $attrs );

    $paging = $attrs['paging'];
    unset( $attrs['paging'] );

    if ( isset( $_GET[ $paging ] ) ) {
        $attrs['paged'] = $_GET[ $paging ];
    } else {
        $attrs['paged'] = 1;
	}

    $html  = '';
    $custom_query = new WP_Query( $attrs );


    $pagination_base = add_query_arg( $paging, '%#%' );

    if ( $custom_query->have_posts() ) :
	    $html .= '<ul>';
	        while( $custom_query->have_posts()) : $custom_query->the_post();
	        $html .= sprintf( 
	            '<li><a href="%1$s">%2$s</a></li>',
	            get_permalink(),
	            get_the_title()
	        );
	        endwhile;
	    $html .= '</ul>';
    endif;

    $html .= paginate_links( array(
        'type'    => '',
        'base'    => $pagination_base,
        'format'  => '?'. $paging .'=%#%',
        'current' => max( 1, $custom_query->get('paged') ),
        'total'   => $custom_query->max_num_pages
    ));

    return $html;
}
add_shortcode( 'w4dev_custom_loop', 'w4dev_custom_loop_shortcode' );


/********************************************************/

// Schedule Tabs shortcode starts

add_action( 'wp_head', 'tttabstyle' );
function tttabstyle()
{ ?>

    <style>
        .conttabs .tabs {
            position: relative;
        }

        .conttabs .tabs:not(.--jsfied) {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .conttabs .tabs .--hidden {
            display: none;
        }

        .conttabs .tabs a,
        .conttabs .tabs button {
            width: 100%;
            height: 100%;
            display: block;
            /* 		font-size: 1em; */
            line-height: 1.2;
            text-align: center;
            color: #FAF3DD;
            background-color: transparent;
        }

        .conttabs .tabs .-primary {
            display: flex;
            padding-left: 0px;
/* 			justify-content: space-between; */
        }
        .conttabs .tabs .-primary {
/*             border: 1px solid #F1B537;
            border-radius: 5px; */
            overflow: hidden;
			margin-right: 0px;
        }

        .conttabs .tabs .-primary>li {
/*             flex-grow: 1; */
/*             background-color: #000; */
/* 			border: 1px solid #F1B537;
			border-radius: 7px; */
			margin: 3px;
        }

        .conttabs .tabs .-primary>li+li {
/*             border-left: 1px solid #F1B537; */
        }
		
        .conttabs .tabs .-primary>li>a,
        .conttabs .tabs .-primary>li>button {
            white-space: nowrap;
            padding: 10px;
            /* 		box-shadow: inset 0 -0.2em 0 #F1B537; */
            cursor: default;
        }

        .conttabs .tabs .-primary .-more>button span {
            display: inline-block;
            transition: transform 0.2s;
        }

        .conttabs .tabs.--show-secondary .-primary .-more>button span {
            transform: rotate(180deg);
        }

        .conttabs .tabs .-secondary {
            max-width: 100%;
            min-width: 10em;
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            box-shadow: 0 0.3em 0.5em rgba(0, 0, 0, 0.3);
            -webkit-animation: nav-secondary 0.2s;
            animation: nav-secondary 0.2s;
        }

        .conttabs .tabs .-secondary li {
            border-top: 1px solid #000;
            background-color: #F1B537;
        }

        .conttabs .tabs .-secondary a,
        .conttabs .tabs .-secondary button {
            padding: 0.6em;
            color: #000;
        }

        .conttabs .tabs .-secondary a:hover,
        .conttabs .tabs .-secondary button:hover {
            background-color: #f1b537bd;
        }

        .conttabs .tabs .-secondary a:active,
        .conttabs .tabs .-secondary button:active {
            background-color: #000;
        }

        .conttabs .tabs.--show-secondary .-secondary {
            display: block;
        }
		.conttabs .tabs .-primary>li.contli.selected>a {
			background-color: #f1b537;
			color: #121212;
		}
		.conttabs .tabs .-primary>li.contli.selected{
			background-color:transparent;
		}		
    </style>
    <style>
        .conttabs [data-tab-info] {
            display: none;
        }

        .conttabs .active[data-tab-info] {
            display: block;
            color: #fff;
        }

        .conttabs .tttab-content .applybutton a {
            background-color: #F1B537;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .conttabs .tttab-content {
            border: 1px solid #878D92;
            padding: 20px;
            border-radius: 15px;
        }

        .conttabs .tabs .-primary>li::marker {
            content: "";
        }

        .conttabs .tttabitem {
            display: flex;
/*             justify-content: space-between; */
            flex-wrap: wrap;
        }
		.conttabs .tttabitem > div:not(.applybutton) {
			padding-right: 50px !important;
		}
        .conttabs .applybutton {
            padding: 15px 0px;
            width: fit-content;
			align-self: center;
        }
/* 
		.conttabs li.contli.selected .contmenu:after {
			color: #222222;
			content: "";
			position: absolute;
			bottom: -12px;
			border-width: 19px 15px 0;
			border-style: solid;
			border-color: #f1b537 transparent;
			background-repeat: repeat-x;
			display: block;
			width: 0;
		} */
			.conttabs li.contli.selected .contmenu:before {
/* 			color: #222222;
			content: "";
			position: absolute;
			bottom: -12px;
			border-width: 19px 15px 0;
			border-style: solid;
			border-color: #f1b537 transparent;
			background-repeat: repeat-x;
			display: block;
			width: 0; */
						
	    line-height: 13px;
    content: "\f106";
    -webkit-font-smoothing: antialiased;
    font-family: awb-icons;
    font-size: 30px;
    color: #878D92;
    position: absolute;
    bottom: -18px;
    font-size: 36px;
    border-bottom: 2px solid #121212;
	background-color: #121212;	
/*  content: "\f054";
 position: absolute;
    bottom: -26px;
    font-size: 36px;
    font-family: "Font Awesome 5 Free";
    font-weight: 600;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    color: #878D92;
    transform: rotate(270deg); */
	
		}
	
		.conttabs a.contmenu {
			justify-content: center;
			display: flex !important;
/* 			transform: rotateX(180deg); */
		}
		.conttabs .lbl {
			color: #A1A1A6;
			line-height: normal;
			padding-top: 10px;
			font-size: 18px;
		}
		.conttabs .tabs .-primary>li>a, .conttabs .tabs .-primary>li>button {
			color: #f1b537;
			border: 0;
			
/* 			padding: 8px 3px; */
			padding: 10px;
			border: 1px solid #F1B537;
			border-radius: 7px;
		}
        @media(max-width:800px) {
            .conttabs .tttabitem {
                display: flex;
                flex-direction: column;
            }
        }
		@media only screen and (min-width: 720px) and (max-width: 790px){
			.conttabs .tabs .-primary>li>a, .conttabs .tabs .-primary>li>button {
    			padding: 8px 3px !important;
			}
        }		
    </style>
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
    <?php
}

add_shortcode('scheduletab','scheduletab');
function scheduletab($atts, $content = null)
{
    ob_start();
    //  $atts = shortcode_atts(
    //         array(
    //  'post_type' => 'post',
    //  'initial_posts' => '3',
    //  'loadmore_posts' => '3',
    // 	'taxonomy'=>''
    //  ), $atts, $tag
    //     );
    //  $additonalArr = array();
    //  $additonalArr["offset"] = 0; 
    $content='week_days_0_input_week_';
    // $image=$atts["prefix"].'_image';
    // $btntext=$atts["prefix"].'_btntext';

    $content_tab=get_field($content);
    // $tabimage_id = get_field($image);
    // $about_btntext = get_field($btntext); 
    $size = 'full'; // (thumbnail, medium, large, full or custom size)
    $test=	get_field('week_days');
	
	?>
    <div class="conttabs">
        <?php // var_dump($test); ?>
        <div class="body">
            <nav class="tabs tttabs">
                <ul class="-primary">
                    <?php if( get_field('week_days') ): ?>
                    <?php $i=1; while( the_repeater_field('week_days') ): ?>
					<?php if(get_sub_field('input_week_')) : ?>
                    <li class="contli <?php echo ($i == 1) ? 'selected':''; ?>">
				<a class="contmenu" data-tab-value="#tab_<?php echo $i++; ?>"><?php the_sub_field('input_week_'); ?></a>
					</li>
					<?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <div class="tttab-content">
            <?php if( get_field('week_days') ): ?>
            <?php $i=1; while( the_repeater_field('week_days') ): ?>
			<?php if(get_sub_field('input_week_')) : ?>
            <div class="tabs_tt_tab <?php echo ($i == 1) ? 'active':''; ?>" id="tab_<?php echo $i++; ?>" data-tab-info>
                <div class="tttabitem">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <?php if( get_sub_field('week_date') ): ?><div>
                            <p class="lbl">Date</p><p> <?php the_sub_field('week_date'); ?></p>
                        </div> <?php endif; ?>
                        <?php if( get_sub_field('week_startTime') ): ?> <div>
                            <p class="lbl">Time</p>
                            <p ><?php the_sub_field('week_startTime'); ?> - <?php the_sub_field('week_end_time'); ?></p>
                        </div> <?php endif; ?>
                    </div>
                    <?php if( get_sub_field('week_content') ): ?><div class="lbl col-lg-6 col-md-4 col-sm-12"><?php the_sub_field('week_content'); ?></div>
                    <?php endif; ?>
                    <?php if( get_sub_field('applybutton') ): ?><div class="applybutton col-lg-3 col-md-4 col-sm-12"><a
                            href="<?php the_sub_field('buttonurl'); ?>"><?php the_sub_field('applybutton'); ?> <i class="fa-angle-right fas button-icon-right" aria-hidden="true"></i></a></div>
                    <?php endif; ?>
                </div>
            </div>
			<?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_action('wp_footer','tttabscript');
function tttabscript()
{ ?>
    <script>
        (window.HUB_EVENTS = {
            ASSET_ADDED: "ASSET_ADDED",
            ASSET_DELETED: "ASSET_DELETED",
            ASSET_DESELECTED: "ASSET_DESELECTED",
            ASSET_SELECTED: "ASSET_SELECTED",
            ASSET_UPDATED: "ASSET_UPDATED",
            CONSOLE_CHANGE: "CONSOLE_CHANGE",
            CONSOLE_CLOSED: "CONSOLE_CLOSED",
            CONSOLE_EVENT: "CONSOLE_EVENT",
            CONSOLE_OPENED: "CONSOLE_OPENED",
            CONSOLE_RUN_COMMAND: "CONSOLE_RUN_COMMAND",
            CONSOLE_SERVER_CHANGE: "CONSOLE_SERVER_CHANGE",
            EMBED_ACTIVE_PEN_CHANGE: "EMBED_ACTIVE_PEN_CHANGE",
            EMBED_ACTIVE_THEME_CHANGE: "EMBED_ACTIVE_THEME_CHANGE",
            EMBED_ATTRIBUTE_CHANGE: "EMBED_ATTRIBUTE_CHANGE",
            EMBED_RESHOWN: "EMBED_RESHOWN",
            FORMAT_FINISH: "FORMAT_FINISH",
            FORMAT_ERROR: "FORMAT_ERROR",
            FORMAT_START: "FORMAT_START",
            IFRAME_PREVIEW_RELOAD_CSS: "IFRAME_PREVIEW_RELOAD_CSS",
            IFRAME_PREVIEW_URL_CHANGE: "IFRAME_PREVIEW_URL_CHANGE",
            KEY_PRESS: "KEY_PRESS",
            LINTER_FINISH: "LINTER_FINISH",
            LINTER_START: "LINTER_START",
            PEN_CHANGE_SERVER: "PEN_CHANGE_SERVER",
            PEN_CHANGE: "PEN_CHANGE",
            PEN_EDITOR_CLOSE: "PEN_EDITOR_CLOSE",
            PEN_EDITOR_CODE_FOLD: "PEN_EDITOR_CODE_FOLD",
            PEN_EDITOR_ERRORS: "PEN_EDITOR_ERRORS",
            PEN_EDITOR_EXPAND: "PEN_EDITOR_EXPAND",
            PEN_EDITOR_FOLD_ALL: "PEN_EDITOR_FOLD_ALL",
            PEN_EDITOR_LOADED: "PEN_EDITOR_LOADED",
            PEN_EDITOR_REFRESH_REQUEST: "PEN_EDITOR_REFRESH_REQUEST",
            PEN_EDITOR_RESET_SIZES: "PEN_EDITOR_RESET_SIZES",
            PEN_EDITOR_SIZES_CHANGE: "PEN_EDITOR_SIZES_CHANGE",
            PEN_EDITOR_UI_CHANGE_SERVER: "PEN_EDITOR_UI_CHANGE_SERVER",
            PEN_EDITOR_UI_CHANGE: "PEN_EDITOR_UI_CHANGE",
            PEN_EDITOR_UI_DISABLE: "PEN_EDITOR_UI_DISABLE",
            PEN_EDITOR_UI_ENABLE: "PEN_EDITOR_UI_ENABLE",
            PEN_EDITOR_UNFOLD_ALL: "PEN_EDITOR_UNFOLD_ALL",
            PEN_ERROR_INFINITE_LOOP: "PEN_ERROR_INFINITE_LOOP",
            PEN_ERROR_RUNTIME: "PEN_ERROR_RUNTIME",
            PEN_ERRORS: "PEN_ERRORS",
            PEN_LIVE_CHANGE: "PEN_LIVE_CHANGE",
            PEN_LOGS: "PEN_LOGS",
            PEN_MANIFEST_CHANGE: "PEN_MANIFEST_CHANGE",
            PEN_MANIFEST_FULL: "PEN_MANIFEST_FULL",
            PEN_PREVIEW_FINISH: "PEN_PREVIEW_FINISH",
            PEN_PREVIEW_START: "PEN_PREVIEW_START",
            PEN_SAVED: "PEN_SAVED",
            POPUP_CLOSE: "POPUP_CLOSE",
            POPUP_OPEN: "POPUP_OPEN",
            POST_CHANGE: "POST_CHANGE",
            POST_SAVED: "POST_SAVED",
            PROCESSING_FINISH: "PROCESSING_FINISH",
            PROCESSING_START: "PROCESSED_STARTED",
        }),
        "object" != typeof window.CP && (window.CP = {}),
            (window.CP.PenTimer = {
                programNoLongerBeingMonitored: !1,
                timeOfFirstCallToShouldStopLoop: 0,
                _loopExits: {},
                _loopTimers: {},
                START_MONITORING_AFTER: 2e3,
                STOP_ALL_MONITORING_TIMEOUT: 5e3,
                MAX_TIME_IN_LOOP_WO_EXIT: 2200,
                exitedLoop: function(E) {
                    this._loopExits[E] = !0;
                },
                shouldStopLoop: function(E) {
                    if (this.programKilledSoStopMonitoring) return !0;
                    if (this.programNoLongerBeingMonitored) return !1;
                    if (this._loopExits[E]) return !1;
                    var _ = this._getTime();
                    if (0 === this.timeOfFirstCallToShouldStopLoop) return (this.timeOfFirstCallToShouldStopLoop = _), !
                        1;
                    var o = _ - this.timeOfFirstCallToShouldStopLoop;
                    if (o < this.START_MONITORING_AFTER) return !1;
                    if (o > this.STOP_ALL_MONITORING_TIMEOUT) return (this.programNoLongerBeingMonitored = !0), !1;
                    try {
                        this._checkOnInfiniteLoop(E, _);
                    } catch (N) {
                        return this._sendErrorMessageToEditor(), (this.programKilledSoStopMonitoring = !0), !0;
                    }
                    return !1;
                },
                _sendErrorMessageToEditor: function() {
                    try {
                        if (this._shouldPostMessage()) {
                            var E = {
                                topic: HUB_EVENTS.PEN_ERROR_INFINITE_LOOP,
                                data: {
                                    line: this._findAroundLineNumber()
                                }
                            };
                            parent.postMessage(E, "*");
                        } else this._throwAnErrorToStopPen();
                    } catch (_) {
                        this._throwAnErrorToStopPen();
                    }
                },
                _shouldPostMessage: function() {
                    return document.location.href.match(/boomboom/);
                },
                _throwAnErrorToStopPen: function() {
                    throw "We found an infinite loop in your Pen. We've stopped the Pen from running. More details and workarounds at https://blog.codepen.io/2016/06/08/can-adjust-infinite-loop-protection-timing/";
                },
                _findAroundLineNumber: function() {
                    var E = new Error(),
                        _ = 0;
                    if (E.stack) {
                        var o = E.stack.match(/boomboom\S+:(\d+):\d+/);
                        o && (_ = o[1]);
                    }
                    return _;
                },
                _checkOnInfiniteLoop: function(E, _) {
                    if (!this._loopTimers[E]) return (this._loopTimers[E] = _), !1;
                    var o;
                    if (_ - this._loopTimers[E] > this.MAX_TIME_IN_LOOP_WO_EXIT) throw "Infinite Loop found on loop: " +
                        E;
                },
                _getTime: function() {
                    return +new Date();
                },
            }),
            (window.CP.shouldStopExecution = function(E) {
                var _ = window.CP.PenTimer.shouldStopLoop(E);
                return !0 === _ && console.warn(
                    "[CodePen]: An infinite loop (or a loop taking too long) was detected, so we stopped its execution. More details at https://blog.codepen.io/2016/06/08/can-adjust-infinite-loop-protection-timing/"
                    ), _;
            }),
            (window.CP.exitedLoop = function(E) {
                window.CP.PenTimer.exitedLoop(E);
            });
    </script>
    <script id="rendered-js">
        /*
            Consider using these polyfills to broaden browser support:
                — https://www.npmjs.com/package/classlist-polyfill
                — https://www.npmjs.com/package/nodelist-foreach-polyfill
            */

        const container = document.querySelector('.tttabs');
        const primary = container.querySelector('.-primary');
        const primaryItems = container.querySelectorAll('.-primary > li:not(.-more)');
        container.classList.add('--jsfied');

        // insert "more" button and duplicate the list

        primary.insertAdjacentHTML('beforeend', `
            <li class="-more">
                <button type="button" aria-haspopup="true" aria-expanded="false">
                More <span>&darr;</span>
                </button>
                <ul class="-secondary">
                ${primary.innerHTML}
                </ul>
            </li>
            `);
        const secondary = container.querySelector('.-secondary');
        const secondaryItems = secondary.querySelectorAll('li');
        const allItems = container.querySelectorAll('li');
        const moreLi = primary.querySelector('.-more');
        const moreBtn = moreLi.querySelector('button');
        moreBtn.addEventListener('click', e => {
            e.preventDefault();
            container.classList.toggle('--show-secondary');
            moreBtn.setAttribute('aria-expanded', container.classList.contains('--show-secondary'));
        });

        // adapt ta bs

        const doAdapt = () => {
            // reveal all items for the calculation
            allItems.forEach(item => {
                item.classList.remove('--hidden');
            });

            // hide items that won't fit in the Primary
            let stopWidth = moreBtn.offsetWidth;
            let hiddenItems = [];
            const primaryWidth = primary.offsetWidth;
            primaryItems.forEach((item, i) => {
                if (primaryWidth >= stopWidth + item.offsetWidth) {
                    stopWidth += item.offsetWidth;
                } else {
                    item.classList.add('--hidden');
                    hiddenItems.push(i);
                }
            });

            // toggle the visibility of More button and items in Secondary
            if (!hiddenItems.length) {
                moreLi.classList.add('--hidden');
                container.classList.remove('--show-secondary');
                moreBtn.setAttribute('aria-expanded', false);
            } else {
                secondaryItems.forEach((item, i) => {
                    if (!hiddenItems.includes(i)) {
                        item.classList.add('--hidden');
                    }
                });
            }
        };

        doAdapt(); // adapt immediately on load
        window.addEventListener('resize', doAdapt); // adapt on window resize

        // hide Secondary on the outside click

        document.addEventListener('click', e => {
            let el = e.target;
            while (el) {
                if (window.CP.shouldStopExecution(0)) break;
                if (el === secondary || el === moreBtn) {
                    return;
                }
                el = el.parentNode;
            }
            window.CP.exitedLoop(0);
            container.classList.remove('--show-secondary');
            moreBtn.setAttribute('aria-expanded', false);
        });
    </script>
    <script>
        const tabs = document.querySelector('.conttabs').querySelectorAll('[data-tab-value]')
        const tabInfos = document.querySelector('.conttabs').querySelectorAll('[data-tab-info]')

//         console.log("tabs :", tabs);
//         console.log("tabInfos :", tabInfos);

		jQuery(function() {
			jQuery(".conttabs ul.-primary li").on("click", function(e) {  
				jQuery(this).addClass("selected").siblings().removeClass("selected");
			});
		})
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = document.querySelector(tab.dataset.tabValue);
//  					console.log("conttabs target:", target);
                tabInfos.forEach(tabInfo => {
                    tabInfo.classList.remove('active')
                })
                target.classList.add('active');
            })
        })
    </script>
    <?php
}
// Schedule Tabs shortcode ends
 
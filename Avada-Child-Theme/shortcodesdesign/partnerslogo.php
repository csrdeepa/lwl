<?php 

add_shortcode('partnerlogo','partnerlogo');
function partnerlogo(){
	ob_start();
// 		$posts = get_posts(array(
//         'post_status'    => 'publish',
//         'posts_per_page' => -1,
//         'post_type' => 'testimonials',  
//         )
//     );
    global $wpdb;
	$posts = $wpdb->get_row( 
        $wpdb->prepare( // use prepare for avoid sql injection
            "SELECT  data FROM {$wpdb->prefix}wonderplugin_carousel WHERE id = 1"
        )
    );
 	$data =json_decode($posts->data,true);
	$imgs=$data["slides"];	
		?>
	     <div class="partner-carousel-container">
        <div class="owl-carousel owl-theme partner-carousel">
			<?php  for ($i = 0; $i < count($imgs); $i++)  { ?>
            <div class="item">
                <div class="partner-card">
                    <img src="<?php echo $imgs[$i++]["image"] ?>" alt="partner" data-ii="<?php echo $i ?>"/>
                    <img src="<?php echo $imgs[$i]["image"] ?>" alt="partner" data-ii="<?php echo $i ?>"/>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script>

			jQuery('.partner-carousel').owlCarousel({
			loop:true,
			margin:20,
			stagePadding: 100,
			nav:true,
			dots:false,
			center:true,
			autoplay:true,
			navText: ["<img src='/wp-content/uploads/2022/04/left-arrow.svg'>","<img src='/wp-content/uploads/2022/04/right-arrow.svg'>"],
			responsive:{
				0:{
					items:2,
					stagePadding: 0,
				},
				399:{
					items:3,
					stagePadding: 0,
				},
				600:{
					items:4,
					stagePadding: 0,
				},
				992:{
					items:5,
					stagePadding: 0,
				},
				1100:{
					items:6,
					stagePadding: 0,
				},
				1500:{
					items:6,
					stagePadding: 0,
				},
				1800:{
					items:7,
					slideBy: 1,
					stagePadding: 0,
				}
			}
		});

    </script>
		<?php
	return ob_get_clean();
}
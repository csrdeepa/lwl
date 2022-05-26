<?php 

add_shortcode('testimonial','testimonial');
function testimonial(){
	ob_start();
		$posts = get_posts(array(
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type' => 'testimonials',  
        )
    );
		?>
	<div class="testimonials">
		<?php if ( $posts && ! is_wp_error( $posts ) ) { ?>
       <div class="carousel-container">
		<div class="work-carousel">
			<div class="owl-carousel owl-theme testimonials-carousel">
				
			<?php foreach( $posts as $post ) : 
			$postid=$post->ID;
			$name=$post->post_title; 
			$details=get_field('testimonial_details', $post->ID);
			$content=$post->post_content;
			$profileimg= wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
				?>
				<div class="item carousel-item" id="<?php echo $postid ?>">
					<div class="card-body" >
						<div class="card-content">
							<?php echo $content ?>
						</div>
<!-- 						<div class="card-content"> < ?php echo wp_trim_words( get_the_content(), 15, '...' ); ?> </div>				 -->
				   </div>

				   <div class="client-img">
					   <div class="img-pos">
						   <img src="<?php echo $profileimg; ?>" alt="<?php echo $name ?>" style="width:50px;height:50px"/>
						   
					   </div>
					   <div class="detail"><p><?php echo $name ?></p><p><?php echo $details ?></p></div>
				   </div>
				</div>
	 		<?php endforeach; ?>
				
		</div>
	</div>
	</div>
		<?php } ?>
	</div>
		<?php
	return ob_get_clean();
}


add_shortcode('posttestimonial','posttestimonial');
function posttestimonial(){
	ob_start();
 
		?>
	<div class="testimonials">
		
       <div class="carousel-container">
		<div class="work-carousel">
			<div class="owl-carousel owl-theme testimonials-carousel">
				
 
				<?php if( get_field('testimonial_custom_field') ): ?>	
				<?php $i=1; while( the_repeater_field('testimonial_custom_field') ): 
				$postid== get_the_ID(); 
				$content = get_sub_field("description_field_name");
				$name = get_sub_field("testimonial_name_field");
				$details = get_sub_field("designation_field_name");
				?>
				 <? if($content) { ?>
				<div class="item carousel-item" id="<?php echo $postid ?>">
					<div class="card-body" >
						<div class="card-content">
							<?php echo $content ?>
						</div>
				   </div>

				   <div class="client-img">
					   <div class="img-pos">
						   <?php $image_id = get_sub_field("image_field_name");
								if($image_id){
									echo wp_get_attachment_image( $image_id["id"], array("class" => "testimonialimage"));  
						   }else{ ?>
						   <img src="/wp-content/uploads/2022/05/noimageavatar.jpg" />
						  <?php } ?>
					   </div>
					   <div class="detail"><p><?php echo $name ?></p><p><?php echo $details ?></p></div>
				   </div>
				</div>
				<? } ?>
				<?php endwhile; ?>
				 <?php endif; ?>
 
		</div>
	</div>
	</div>

	</div>
		<?php
	return ob_get_clean();
}
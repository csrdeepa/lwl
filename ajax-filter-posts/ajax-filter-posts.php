<?php
/**
 * Plugin Name:  Post Grid with Ajax Filter
 * Plugin URI:   http://addonmaster.com
 * Author:       Akhtarujjaman Shuvo
 * Author URI:   http://addonmaster.com/plugins/post-grid-with-ajax-filter
 * Version: 	  3.0.3
 * Description:  Post Grid with Ajax Filter helps you filter your posts by category terms with Ajax. Infinite scroll function included.
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  am_post_grid
 * Domain Path:  /lang
 */

/**
* Including Plugin file for security
* Include_once
*
* @since 1.0.0
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Defines
define('AM_POST_GRID_VERSION', '3.0.3');

/**
* Loading Text Domain
*/
add_action('plugins_loaded', 'am_post_grid_plugin_loaded_action', 10, 2);
function am_post_grid_plugin_loaded_action() {
	load_plugin_textdomain( 'am_post_grid', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}


/**
 *	Admin Page
 */
//require_once( dirname( __FILE__ ) . '/inc/admin/admin-page.php' );


// Enqueue scripts
function asrafp_scripts(){

	// CSS File
	wp_enqueue_style( 'asrafp-styles', plugin_dir_url( __FILE__ ) . 'assets/css/post-grid-styles.css', null, AM_POST_GRID_VERSION );

	// JS File
	wp_register_script( 'asr_ajax_filter_post', plugin_dir_url( __FILE__ ) . 'assets/js/post-grid-scripts.js', array('jquery'), AM_POST_GRID_VERSION );
	wp_enqueue_script( 'asr_ajax_filter_post' );

	// Localization
	wp_localize_script( 'asr_ajax_filter_post', 'asr_ajax_params', array(
	        'asr_ajax_nonce' => wp_create_nonce( 'asr_ajax_nonce' ),
	        'asr_ajax_url' => admin_url( 'admin-ajax.php' ),
	    )
	);
}

add_action( 'wp_enqueue_scripts', 'asrafp_scripts' );

function ttdeepcdn_scripts(){

	//CSS File
// 	wp_enqueue_style( 'tts-bootstrapstyles', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', null, '' );

	//JS File
	wp_register_script( 'ttsp_bootstrapscript','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '' );
	wp_enqueue_script( 'ttsp_bootstrapscript' );

	// Enque JS File footer
// 	wp_register_script( 'ttsp_jqminscript','https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'), '', true );
// 	wp_enqueue_script( 'ttsp_jqminscript' );	
}
add_action( 'wp_enqueue_scripts', 'ttdeepcdn_scripts' );

function ttdate_scripts(){

	//JS File
	wp_register_script( 'ttsp_momentscript','https://cdn.jsdelivr.net/momentjs/latest/moment.min.js', array('jquery'), '' );
	wp_enqueue_script( 'ttsp_momentscript' );
	wp_register_script( 'ttsp_daterangescript','https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js', array('jquery'), '' );
	wp_enqueue_script( 'ttsp_daterangescript' );	

	//CSS File
	wp_enqueue_style( 'tts-daterangepickerstyles', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css', null, '' );
	
}
add_action( 'wp_enqueue_scripts', 'ttdate_scripts' );

//shortcode function
function am_post_grid_shortcode_mapper( $atts, $content = null ) {

	// Posts per pages.
	$posts_per_page = ( get_option( 'posts_per_page', true ) ) ? get_option( 'posts_per_page', true ) : 9;

	// Default attributes
	$shortcode_atts = shortcode_atts(
            array(
                'show_filter' 		=> "yes",
                'btn_all' 			=> "yes",
                'initial' 			=> "-1",
                'layout' 			=> '1',
                'post_type' 		=> 'post',
                'posts_per_page' 	=> $posts_per_page,
                'cat' 				=> '',
                'terms' 			=> '',
                'paginate' 			=> 'no',
                'hide_empty' 		=> 'true',
                'orderby' 			=> 'menu_order date', //Display posts sorted by ‘menu_order’ with a fallback to post ‘date’
    			'order'   			=> 'DESC',
    			'pagination_type'   => '',
    			'infinite_scroll'   => '',
    			'animation'  		=> '',
				'taxonomy'	=>'',
				'params'=>'yes',
				'col'=>4,
				'featured_post'=>'false'
            ),
            $atts
        );

    // Params extraction
    extract($shortcode_atts);

	ob_start();
	$show_filter = isset($atts["show_filter"] ) ? $atts["show_filter"] : 'no';
	$post_type = isset($atts["post_type"] ) ? $atts["post_type"] : 'post';
	$layout = isset($atts["layout"] ) ? $atts["layout"] : 1;	
	$taxonomies = get_object_taxonomies( $post_type, 'objects' );
	$taxosstr = isset($atts["taxonomy"] ) ? $atts["taxonomy"] : '';
	$taxos=explode(",",$taxosstr);
	
	$taxonomies = get_object_taxonomies( $post_type, 'objects' );
	
	// Texonomy arguments
	$taxonomy = 'category';
	$args = array(
		'hide_empty' => $hide_empty,
	    'taxonomy' => $taxonomy,
	    'include' => $terms ? $terms : $cat,
	);

	// Get category terms
	$terms = get_terms($args); ?>
	<div class="am_ajax_post_grid_wrap" data-pagination_type="<?php echo esc_attr($pagination_type); ?>" data-am_ajax_post_grid='<?php echo json_encode($shortcode_atts);?>'>

		<?php if ( $show_filter == "yes" && $terms && !is_wp_error( $terms ) ){ ?>
		
		<?php if ( $layout == 1 ||  $layout == 4 ){ ?>
			<div class="asr-filter-div" data-layout="<?php echo $layout; ?>">
				<ul>
					<?php if($btn_all != "no"): ?>
						<li class="asr_texonomy" data_id="-1"><?php echo esc_html('All','am_post_grid'); ?></li>
					<?php endif; ?>
					<?php foreach( $terms as $term ) { ?>
						<li class="asr_texonomy" data_id="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
		<?php if ( $layout != 1 || $layout != 4 ){ ?>
		
		<div class="taxonamies" style="display:none;">
			<?php
			
			foreach( $taxonomies as $taxonomy ){
				//echo $taxonomy->name;
				//var_dump($taxonomy);
			$terms =get_terms(array('taxonomy' =>$taxonomy->name ,'hide_empty' => false));	
			?> <ul class="<?php echo $taxonomy->name ?>"> <?php
				foreach( $terms as $term ){
					echo "<li>{$term->name}</li>";
				}
			?> </ul> <?php
			}																   
			?>
		</div>
 
<!--#test filter-->
	<div class="ms_filter">
		<div class="ms_fil_left">
			<div class="filt_input">
				<i class="fa fa-search"></i>
				<input type="text" class="form-control sm_filt" id="searchtitle" placeholder="Search by title" style="height: 40px;width: 100%;max-width: 340px;">
			</div>
			<div class="drop_rel" >
<?php // var_dump($taxoarray); ?>
				<div class="dropdown mx_dropdown" style="height: 100%;">
				<button class="btn btn-secondary mx_button btn_ptfilter" type="button" style="height: 40px; border-radius: 5px; font-size: 1rem;">
						Filter by 
					</button>


					<div class="filter-show">
						<div class="tab-fil">
							<ul class="nav nav-tabs flex-column kn_tabs" role="tablist" style=" list-style: none;">
								<li class="nav-item">
									<a class="nav-link active" data-bs-toggle="tab" href="#datepanel">Date</a>
								</li>
								<?php $i=1;
									foreach( $taxonomies as $taxonomy ){
										//echo $taxonomy->name; var_dump($taxonomy);
								 ?>
								<li class="nav-item">
									<a class="nav-link <?php // echo ($i == 1) ? "active" : " "  ?>" data-id="<?php echo $taxonomy->name ?>" data-bs-toggle="tab" href="#<?php echo strtolower($taxonomy->labels->singular_name) ?>panel"><?php echo $taxonomy->labels->singular_name ?> </a>
								</li>
								<?php $i++; } ?>
<!-- 							<li class="nav-item">
									<a class="nav-link" data-id="cp_types" data-bs-toggle="tab" href="#typepanel">Type</a>
								</li> -->
							</ul>
							<div class="tab-content mils">
								<div id="datepanel" class="container tab-pane fade active">
									<div style="display:flex;">					
									<div style="margin-right:7px;"><input type="text" id="ttstartdate" name="ttstartdate" value="" style="font-size:14px;"></div>
									<div><input type="text" id="ttenddate" name="ttenddate" value="" style="font-size:14px;"></div>
									</div>								
									
								</div>
								
								<?php $i=1;
									foreach( $taxonomies as $taxonomy ){
										//echo $taxonomy->name; var_dump($taxonomy);
								 ?>
<div id="<?php echo strtolower($taxonomy->labels->singular_name) ?>panel" class="container tab-pane <?php // echo ($i == 1) ? "active" : " "  ?>">
									<div>
										<div class="ms_fill">
											<div class="ms_fill_icon">
												<label class="switch">
<input type="checkbox"  name="<?php echo strtolower($taxonomy->labels->singular_name) ?>_all" data-name="<?php echo $taxonomy->name ?>" data-id="all">
													<span class="slider round"></span>
												  </label>
											</div>
											<div class="ms_fill_text">
												All
											</div>
										</div>
									<?php $terms =get_terms(array('taxonomy' => $taxonomy->name,'hide_empty' => false));
										foreach( $terms as $term ){ ?>
										<div class="ms_fill">
											<div class="ms_fill_icon">
												<label class="switch">
													<input type="checkbox" name="<?php echo strtolower($taxonomy->labels->singular_name) ?>[]" data-name="<?php echo $taxonomy->name ?>" data-id="<?php echo $term->term_id;?>">
													<span class="slider round"></span>
												  </label>
											</div>
											<div class="ms_fill_text">
												<?php echo $term->name; ?>
											</div>
										</div>
										<?php }?>

									</div>
								</div>
								
								<?php $i++; } ?>	 

							</div>

						</div>
						<div class="button_box">
							<div><button type="button" class="btn-apply" id="ttsbtn-apply">Apply <img src='/wp-content/uploads/2022/05/Vector-1-1.png' width="7px" style="margin-left:10px"/></button></div>
							<div><button type="button" class="btn-cancel" id="ttsbtn-cancel">Cancel</button></div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<div class="ms_fil_right">

			<div class="filt_right_i " id="list_view">
				<i class="fa fa-list"></i>
			</div>
			<div class="filt_right_i orange" id="grid_view">
				<i class="fa fa-th-large"></i>
			</div>
			<div style="margin-right: 5px;">
				<select class="sm_select" style="height: 40px;">
					<option value="desc">Sort by Date desc</option>
					<option value="asc">Sort By Date asc</option>
				</select>
			</div>
		</div>
	</div>		
<!--@test filter-->
		 <?php } ?>
	    <?php } ?>

	    <div class="asr-ajax-container">
		    <div class="asr-loader">
		    	<div class="lds-dual-ring"></div>
		    </div>
		    <div class="asrafp-filter-result"></div>
	    </div>
    </div>

	<?php return ob_get_clean();
}
add_shortcode('asr_ajax','am_post_grid_shortcode_mapper');
add_shortcode('am_post_grid','am_post_grid_shortcode_mapper');

// Load Posts Ajax actions
add_action('wp_ajax_asr_filter_posts', 'am_post_grid_load_posts_ajax_functions');
add_action('wp_ajax_nopriv_asr_filter_posts', 'am_post_grid_load_posts_ajax_functions');

// Load Posts Ajax function
function am_post_grid_load_posts_ajax_functions(){
	// Verify nonce
  	if( !isset( $_POST['asr_ajax_nonce'] ) || !wp_verify_nonce( $_POST['asr_ajax_nonce'], 'asr_ajax_nonce' ) )
    die('Permission denied');

	$term_ID = isset( $_POST['term_ID'] ) ? sanitize_text_field( intval($_POST['term_ID']) ) : null;
	$searchterm = isset( $_POST['searchterm'] ) ? sanitize_text_field($_POST['searchterm']): null;
	$orderby = isset( $_POST['orderby'] ) ? sanitize_text_field($_POST['orderby']): 'menu_order date';
	$order = isset( $_POST['order'] ) ? sanitize_text_field($_POST['order']): 'DESC';
	
		
	$ttstartdate = isset( $_POST['ttstartdate'] ) ? sanitize_text_field( $_POST['ttstartdate'] ) : '';	
	$ttenddate = isset( $_POST['ttenddate'] ) ? sanitize_text_field( $_POST['ttenddate'] ) : '';	
	
	
	// Pagination
	if( $_POST['paged'] ) {
		$dataPaged = intval($_POST['paged']);
	} else {
		$dataPaged = get_query_var('paged') ? get_query_var('paged') : 1;
	}

	$jsonData = json_decode( str_replace('\\', '', $_POST['jsonData']), true );

	$layout = isset( $jsonData['layout'] ) ? intval( sanitize_text_field( $jsonData['layout'] ) ) : 1;
	$post_type = isset( $jsonData['post_type'] ) ? sanitize_text_field( $jsonData['post_type'] ) : 'post';
	$params = isset( $jsonData['params'] ) ? sanitize_text_field( $jsonData['params'] ) : 'yes';	
	$col = isset( $jsonData['col'] ) ? sanitize_text_field( $jsonData['col'] ) : 4;	
	$featured_post = isset( $jsonData['featured_post'] ) ? sanitize_text_field( $jsonData['featured_post'] ) : 'false';	
	$taxcat = isset( $jsonData['taxonomy'] ) ? sanitize_text_field( $jsonData['taxonomy'] ) : '';	

	// Add infinite_scroll to button
	$infinite_scroll_class = isset( $jsonData['infinite_scroll'] ) && $jsonData['infinite_scroll'] == "true" ? ' infinite_scroll ' : '';

	// Set animation class
	$has_animation_class = isset( $jsonData['animation'] ) && $jsonData['animation'] == "true" ? ' am_has_animation ' : '';

	$data = array(
		'post_type' => $post_type,
		'post_status' => 'publish',
		'paged' => $dataPaged,
	);

	// If json data found
	if( $jsonData ){
		if( $jsonData['posts_per_page'] ){
			$data['posts_per_page'] = intval( $jsonData['posts_per_page'] );
		}

		if( $jsonData['orderby'] ){
			$data['orderby'] = sanitize_text_field( $jsonData['orderby'] );
		}

		if( $jsonData['order'] ){
			$data['order'] = sanitize_text_field( $jsonData['order'] );
		}
	}
	


	if( $term_ID == -1 ){
		if ( isset( $jsonData['cat'] ) && !empty( $jsonData['cat'] ) ) {
			$term_ID = explode(',', $jsonData['cat']);
		} elseif ( isset( $jsonData['terms'] ) && !empty( $jsonData['terms'] ) ) {
			$term_ID = explode(',', $jsonData['terms']);
		} else {
			$term_ID =  null;
		}
		
	}
	if($orderby){
		$data['orderby'] = $orderby;
	}else{
		if( $jsonData['orderby'] ){
			$data['orderby'] = sanitize_text_field( $jsonData['orderby'] );
		}
	}
    if($order){
		$data['order'] = $order;
	}else{
		if( $jsonData['order'] ){
			$data['order'] = sanitize_text_field( $jsonData['order'] );
		}
	}	
	$category_terms =array();
	$type_terms = array();
	$sponsor_terms = array();
	
	if($_POST['c_term']){
		$category_terms = array(
					'taxonomy' => $taxcat,
					'field' => 'term_id',
					'terms' => $_POST['c_term'],
			       );
		
	}
	if($_POST['c_term_all'] === true){
		$terms =get_terms(array('taxonomy' => $taxcat,'hide_empty' => false));
		$category_terms = array(
					'taxonomy' => 'cp_category',
					'field' => 'term_id',
					'terms' => array_column($terms, 'term_id'),
			       );
	}
	
	if($_POST['t_term']){
		$types_terms = array(
					'taxonomy' => 'cp_types',
					'field' => 'term_id',
					'terms' => $_POST['t_term'],
			       );
		
	}
	if($_POST['t_term_all'] === true){
		$terms =get_terms(array('taxonomy' => 'cp_types','hide_empty' => false));
		$types_terms = array(
					'taxonomy' => 'cp_types',
					'field' => 'term_id',
					'terms' => array_column($terms, 'term_id'),
			       );
	}
	if($_POST['s_term']){
		$sponsor_terms = array(
					'taxonomy' => 'cp_sponsors',
					'field' => 'term_id',
					'terms' => $_POST['s_term'],
			       );
		
	}
	if($_POST['s_term_all'] === true){
		$terms =get_terms(array('taxonomy' => 'cp_sponsors','hide_empty' => false));
		$sponsor_terms = array(
					'taxonomy' => 'cp_sponsors',
					'field' => 'term_id',
					'terms' => array_column($terms, 'term_id'),
			       );
	}
	

	if(!empty($category_terms) || !empty($types_terms) || !empty($sponsor_terms)){
		// Check if set terms 
		$data['tax_query'] = array(
			'relation' => 'OR',
			(!empty($sponsor_terms))?$sponsor_terms:'',
			(!empty($category_terms))?$category_terms:'',
			(!empty($types_terms))?$types_terms:''

		);
	}

	
	$featured_post =array();
	$datebetween = array();

	if( $jsonData['featured_post']=='yes'){
		$featured_post =array(
						'key'       => 'tt_featuredpost',
						'value'     => 'Featured',
						'compare'   => 'LIKE'
				);
	} 
	if( $ttstartdate || $ttenddate ){
		$start_date = explode('/',$ttstartdate);
		$end_date = explode('/',$ttenddate);
		$start_date_new = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];
		$end_date_new = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];
		
		$datebetween = array(
				'key' => 'cp_start_date',
				'value' => array( $start_date_new,  $end_date_new ),
				'compare' => 'BETWEEN',
				'type' => 'DATE'
		);
	}
 	if(!empty($featured_post) || !empty($datebetween)){
		// Check if set terms 
		$data['meta_query'] = array(
			'relation' => 'OR',
			(!empty($featured_post))?$featured_post:'',
			(!empty($datebetween))?$datebetween:''

		);
	}	
	
	if($searchterm){
		$data['s'] = $searchterm;
	}

	//post query
	$query = new WP_Query($data);
	ob_start();

	// Wrap with a div when infinity load
	echo ( $pagination_type == 'load_more' ) ? '<div class="am-postgrid-wrapper">' : '';

	// Start posts query
	if( $query->have_posts() ): ?>
		<?php if($layout == 4){ ?>
		<div class="<?php echo esc_attr( "am_post_grid am__col-2 am_layout_{$layout} {$has_animation_class} " ); ?>">
		
			<?php while( $query->have_posts()): $query->the_post(); ?>
			<div class="am_grid_col  blog  col-lg-6 col-md-6 col-sm-12 ">
				<div class="am_single_grid">
					<div class="am_thumb ">
						<?php if ( has_post_thumbnail(get_the_id()) ) {
							the_post_thumbnail(get_the_id());
						}
						else {
							echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
						} ?>
					</div>
					<div class="am_cont blogdetails">
						<a href="<?php echo get_the_permalink(); ?>"><h2 class="am__title blogtitle"><?php echo get_the_title(); ?></h2></a>
						<div class="am__excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?>
						</div>
						<div class="am__det">
						<div style="display:flex;justify-content: space-between; color:#fff;">
							<p><?php echo the_field('bloger_name', $post->ID);  ?></p>		
							<p> <?php echo get_the_date(); ?> </p>
						</div>
						</div>
						<a href="<?php echo get_the_permalink(); ?>" class="am__readmore"><img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px" style=" padding-right: 5px;" /></a>
					</div>
				</div>
			</div>
		<?php endwhile; ?>	
					</div>
			<?php }
		  else if($layout == 1){ ?>
		<div class="<?php echo esc_attr( "am_post_grid am__col-3 am_layout_{$layout} {$has_animation_class} " ); ?>">
		
			<?php while( $query->have_posts()): $query->the_post(); ?>
			<div class="am_grid_col">
				<div class="am_single_grid">
					<div class="am_thumb">
						<?php the_post_thumbnail(get_the_id()); ?>
					</div>
					<div class="am_cont">
						<a href="<?php echo get_the_permalink(); ?>"><h2 class="am__title"><?php echo get_the_title(); ?></h2></a>
						<div class="am__excerpt">
							<?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?>
						</div>
						<a href="<?php echo get_the_permalink(); ?>" class="am__readmore"><?php echo esc_html__('Read More','am_post_grid');?></a>
					</div>
				</div>
			</div>
		<?php endwhile; ?>	
					</div>
			<?php } else if( $layout == 2 ){ ?>

<div class="<?php echo esc_attr( "tts_post_grid tts_container tts_layout_{$layout} {$has_animation_class} " ); ?>" style="width: 100% !important;">
	<div id="grid" style="width: 100% !important;">
 
		<div class="row" style="width: 100% !important; margin: auto;">
			<?php while( $query->have_posts()): $query->the_post(); 
			$badgeimage_id = get_field('badge_image');
			$startson=get_field('cp_start_date');
			$duration=get_field('cp_duration');
			?>	
			<div class="<?php echo esc_attr( "col-lg-3 col-md-4 col-sm-6 col-xs-12 tts_col tts_col-{$col}" ); ?>">
				<div class="strip">
					<figure>
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}
						else {
							echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
						} ?>
						<a href="<?php echo get_the_permalink(); ?>" class="strip_info">
							<small><?php echo wp_get_attachment_image( $badgeimage_id["id"], $size ); ?></small>
							<div class="item_title">
								<?php $terms = get_the_terms( get_the_ID() , $jsonData['taxonomy'] ); 
								if($terms) {?>
								<div class="leader_sp" data-pt="<?php echo  $jsonData['taxonomy'] ?>">#<?php

											foreach ( $terms as $term ) {
											echo $term->name;
											}
											?></div>
								<?php } ?>
								<h3><?php echo get_the_title(); ?></h3>
								<small>
									<p class="leader_sp2"><?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?></p>
								</small>
								<?php if($params=='yes'){ ?>
									<div class="leader_sp3">
										<div class="sp3">
											<?php if($startson) { 
// 											  $date = str_replace('/', '-', $startson); 
// 										echo date('d M Y', strtotime($date));  
											?> <div class="leader_sp4">Starts on</div>
											<div class="leader_sp5"><?php echo $startson ?></div> <?php } ?>
										</div>
										
										<div class="sp4">
											<?php if($duration) { ?> <div class="leader_sp4">Duration</div>
											<div class="leader_sp5"><?php echo $duration ?></div> <?php } ?>
											 
										</div>
									</div>
								<?php } ?>
								<div class="leader_sp6">
									<img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px" style=" padding-right: 5px;">
								</div>
	
							</div>
						</a>
					</figure>
				</div>
			</div>
			

		<?php endwhile; ?>
		</div>
	</div>
		<div id="list" style="display:none">

		<?php while( $query->have_posts()): $query->the_post(); 
			$badgeimage_id = get_field('badge_image');
			
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

            <div class="lt_box">

                <div class="lt_abs">
                    <div class="lt_start">Starts on</div>
                    <div class="lt_date"><?php echo date('d M',strtotime($cp_start_date)); ?></div>
                    <div class="lt_year"><?php echo date('Y',strtotime($cp_start_date)); ?></div>
                </div>

                <div class="row align-items-center right-item">
                    <div class="col-lg-3 col-md-4 col-sm-12 plm-4">
                        <div class="lt_strip">
                            <figure>
								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail();
								}
								else {
									echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
								} ?>
                            </figure>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 plm-4 second_sec">

                        <div class="lt_leader">
							<?php $terms = get_the_terms( get_the_ID() , $jsonData['taxonomy'] ); 
								if($terms) {?>
									<div class="leader_sp" data-fdfdf="<?php echo  $jsonData['taxonomy'] ?>">#<?php
												foreach ( $terms as $term ) {
												echo $term->name;
												} ?>
									</div>
								<?php } ?>
						</div>
						<div>
							<div class="lt_leader_title"><?php echo get_the_title(); ?></div>
							<div class="lt_leader_desc"><?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?></div>
						</div>
<!--                         <hr class="split_leader"> -->
                        <div class="lt_split">
                            <?php if( $cp_eligibility ): ?> 
								<div class="split_detail">
									<div class="lt_eligible">Eligibility</div>
									<div class="lt_grade"><?php echo $cp_eligibility; ?></div>
								</div>
							<?php endif; ?>
							
							<?php if( $cp_duration ): ?>
								<div class="split_detail">
									<div class="lt_eligible">Duration</div>
									<div class="lt_grade"><?php echo $cp_duration; ?></div>
								</div>
							<?php endif; ?>
							
          <div class="split_detail">
			<?php if( $cp_early_application_date ): ?> <div class="lt_eligible">Early Application Date</div> <div class="lt_grade"><?php echo $cp_early_application_date;?></div><?php endif; ?>
			<?php if( $cp_regular_app_date ): ?> <div class="lt_regular">[Regular Date: <?php echo $cp_regular_app_date ?>]</div><?php endif; ?>
          </div>
          <div class="split_detail">
          <?php if( $cp_early_application_fee ): ?><div class="lt_eligible">Early Application Fee</div> <div class="lt_grade">$ <?php echo $cp_early_application_fee; ?></div><?php endif; ?>
          <?php if( $cp_regular_app_fee ): ?> <div class="lt_regular">[Regular Fee: $<?php echo $cp_regular_app_fee ?>]</div><?php endif; ?>
          </div>
                        </div>
<!--                         <hr class="split_leader"> -->
                        <div class="foot_leader">
                            <div>
                                <div class="lt_complete">Upon completion</div>
                                <div class="lt_certify">Receive Certificates from Harvard Student Agency</div>
                            </div>
                            <div class="lt_download">
                                <div class="lt_broucher"><a href="#">Download Brouchure <img class="alignnone size-large wp-image-248" src="/wp-content/uploads/2022/05/clarity_download-line.svg" alt="" /></a>
                                </div>
		<!-- <div class="lt_apply typeapply"><button>Apply Now <span><i class="fa fa-chevron-right"></i></span></button></div> -->
								<div class="lt_apply typeapply"><?php echo $typeform_button ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endwhile; ?>

	</div>
		</div>
<?php } else if( $layout == 3 ){ ?>
 
<div class="<?php echo esc_attr( "tts_post_grid tts_container tts_layout_{$layout} {$has_animation_class} " ); ?>" style="width: 100% !important;">
	<div id="grid" style="width: 100% !important;">
		<div class="row" style="width: 100% !important;">
			<?php while( $query->have_posts()): $query->the_post(); 
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
								
			?>	
			<div class="<?php echo esc_attr( "col-lg-3 col-md-4 col-sm-6 col-xs-12 tts_col tts_col-{$col}" ); ?>">
				<div class="strip">
					<figure>
						<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail();
								}
								else {
									echo '<img src="/wp-content/uploads/2022/05/noimage.jpg" />';
								} ?>
						<a href="<?php echo get_the_permalink(); ?>" class="strip_info">
							<small><?php echo wp_get_attachment_image( $badgeimage_id["id"], $size ); ?></small>
							<div class="item_title">
								<?php $terms = get_the_terms( get_the_ID() , $jsonData['taxonomy'] ); 
								if($terms) {?>
								<div class="leader_sp" data-fdfdf="<?php echo  $jsonData['taxonomy'] ?>">#<?php

											foreach ( $terms as $term ) {
											echo $term->name;
											}
											?></div>
								<?php } ?>
								<h3><?php echo get_the_title(); ?></h3>
								<small>
									<p class="leader_sp2"><?php echo wp_trim_words( get_the_excerpt(), 15, null ); ?></p>
								</small>
								<?php if($params=='yes'){ ?>
								<div class="leader_sp3">
									<?php if( $cp_start_date ): ?>	
									<div class="sp3">
										<div class="leader_sp4">Starts on</div>
										<div class="leader_sp5">											
<!-- <p>< ?php echo date('d M Y',strtotime($cp_start_date)); ?></p> -->
							<p  style="color:#F1B537;font-size: 24px; font-weight: 600;"><?php $date = str_replace('/', '-', $cp_start_date); 
										echo date('d M Y', strtotime($date)); ?></p>
										</div>
									</div>
									<?php endif; ?>								
									
									<div class="sp4">
										<?php if( $cp_duration ): ?>
											<div class="leader_sp4">Duration</div>
											<div class="leader_sp5"><?php echo $cp_duration; ?></div>
										<?php endif; ?>
									</div>
								</div>
								<?php } ?>
								<div class="leader_sp6">
									<img src="/wp-content/uploads/2022/04/right-arrow.svg" alt="arrow" style="width:25px" style=" padding-right: 5px;">
								</div>
	
							</div>
						</a>
					</figure>
				</div>
			</div>
			

		<?php endwhile; ?>
			
		</div>
	</div>
		</div>
			<?php } ?>



		<div class="am_posts_navigation">
		<?php
			$big = 999999999; // need an unlikely integer
			$dataNext = $dataPaged+1;
			$dataPrev = $dataPaged-1;
	
			$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

			$paginate_links = paginate_links( array(
			    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			    'format' => '?paged=%#%',
			    'current' => max( 1, $dataPaged ),
			    'prev_next' => true,
			    'mid_size' => 2,
			    'total' => $query->max_num_pages,
				'prev_text' => '<',
        		'next_text' => '>',
				'prev_text'       => __('<span class="prev-next" data-attr="'.$dataPrev.'">&laquo;</span>'),
                'next_text'       => __('<span class="prev-next" data-attr="'.$dataNext.'">&raquo;</span>'),
                'type'               => 'plain',
                'add_args'           => false,
                'add_fragment'       => '',
                'before_page_number' => '',
                'after_page_number'  => ''
			) );

			// Load more button
			if( $pagination_type == 'load_more' ){

				if( $paginate_links && $dataPaged < $query->max_num_pages ){
					echo "<button type='button' data-paged='{$dataPaged}' data-next='{$dataNext}' class='{$infinite_scroll_class} am-post-grid-load-more'>".esc_html__( 'Load More', 'am_post_grid' )."</button>";
				}

			} else {

				// Paginate links
				echo "<div id='am_posts_navigation_init'>{$paginate_links}</div>";
			}

		?>
		</div>

		<?php
	else:
// 		esc_html_e('No Posts Found','am_post_grid');
		echo '<div class="nopostcontent"> No Posts Found </div>';
	endif;
	wp_reset_query();

	// Wrap close when infinity load
	echo ( $pagination_type == 'load_more' ) ? '</div>' : '';

	// Echo the results
	echo ob_get_clean();
	die();
}



/**
 * Add plugin action links.
 *
 * @since 1.0.0
 * @version 4.0.0
 */
function am_ajax_post_grid_plugin_action_links( $links ) {
	$plugin_links = array(
		'<a href="'.admin_url( 'admin.php?page=ajax-post-grid' ).'">' . esc_html__( 'Options', 'am_post_grid' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );
}
//add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'am_ajax_post_grid_plugin_action_links' );



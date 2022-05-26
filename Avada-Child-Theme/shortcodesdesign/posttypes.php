<?php

function custom_post_type() {
    // Certificate programs
    $labels = array(
        'name'                => _x( 'Certificate programs', 'Post Type General Name' ),
        'singular_name'       => _x( 'Certificate program', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Certificate programs' ),
        'parent_item_colon'   => __( 'Parent Certificate program' ),
        'all_items'           => __( 'All Certificate programs' ),
        'view_item'           => __( 'View Certificate program' ),
        'add_new_item'        => __( 'Add New Certificate program' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Certificate program' ),
        'update_item'         => __( 'Update Certificate program' ),
        'search_items'        => __( 'Search Certificate program' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $args = array(
        'label'               => __( 'certificate_programs' ),
        'description'         => __( 'Certificate program news and reviews' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
// 		'taxonomies'          => array( 'category' ),
    );
    register_post_type( 'certificate_programs', $args );

	    register_taxonomy( 'cp_category', array( 'certificate_programs' ), array(
        'hierarchical' => true,
        'label' => __( 'Category' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories ' ),
        'all_items' => __( 'All categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add new Category' ),
        'new_item_name' => __( 'Name of Category' ),
        'menu_name' => __( 'Category' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'certificate_programs/categories',
            'with_front' => false,
        ),)
    );
//     register_taxonomy( 'cp_sponsors', array( 'certificate_programs' ), array(
//         'hierarchical' => true,
//         'label' => __( 'Sponsors' ),
//         'labels' => array( // Labels customizadas
//         'name' => _x( 'Sponsors', 'taxonomy general name' ),
//         'singular_name' => _x( 'Sponsors', 'taxonomy singular name' ),
//         'search_items' =>  __( 'Search Sponsors ' ),
//         'all_items' => __( 'All Sponsors' ),
//         'parent_item' => __( 'Parent Sponsors' ),
//         'parent_item_colon' => __( 'Parent Sponsors:' ),
//         'edit_item' => __( 'Edit Sponsors' ),
//         'update_item' => __( 'Update Sponsors' ),
//         'add_new_item' => __( 'Add new Sponsors' ),
//         'new_item_name' => __( 'Name of Sponsors' ),
//         'menu_name' => __( 'Sponsors' ),
//         ),
//         'show_ui' => true,
//         'show_in_tag_cloud' => true,
//         'query_var' => true,
//         'rewrite' => array(
//             'slug' => 'certificate_programs/sponsors',
//             'with_front' => false,
//         ),)
//     );
		register_taxonomy( 'cp_types', array( 'certificate_programs' ), array(
        'hierarchical' => true,
        'label' => __( 'Type' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Type', 'taxonomy general name' ),
        'singular_name' => _x( 'Type', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Type ' ),
        'all_items' => __( 'All Type' ),
        'parent_item' => __( 'Parent Type' ),
        'parent_item_colon' => __( 'Parent Type:' ),
        'edit_item' => __( 'Edit Type' ),
        'update_item' => __( 'Update Type' ),
        'add_new_item' => __( 'Add new Type' ),
        'new_item_name' => __( 'Name of Type' ),
        'menu_name' => __( 'Type' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'certificate_programs/types',
            'with_front' => false,
        ),)
    );
    register_taxonomy_for_object_type( 'tags', 'certificate_programs' );
	
// Competitions	
	    $clabels = array(
        'name'                => _x( 'Competitions', 'Post Type General Name' ),
        'singular_name'       => _x( 'Competition', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Competitions' ),
        'parent_item_colon'   => __( 'Parent Competition' ),
        'all_items'           => __( 'All Competitions' ),
        'view_item'           => __( 'View Competition' ),
        'add_new_item'        => __( 'Add New Competition' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Competition' ),
        'update_item'         => __( 'Update Competition' ),
        'search_items'        => __( 'Search Competition' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $cargs = array(
        'label'               => __( 'competitions' ),
        'description'         => __( 'Competition news and reviews' ),
        'labels'              => $clabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
         
    );
    register_post_type( 'competitions', $cargs );
 
    register_taxonomy( 'com_category', array( 'competitions' ), array(
        'hierarchical' => true,
        'label' => __( 'Category' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories ' ),
        'all_items' => __( 'All categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add new Category' ),
        'new_item_name' => __( 'Name of Category' ),
        'menu_name' => __( 'Category' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'competitions/categories',
            'with_front' => false,
        ),)
    );
    register_taxonomy_for_object_type( 'tags', 'competitions' );

    // Fellowships    
	    $flabels = array(
        'name'                => _x( 'Fellowships', 'Post Type General Name' ),
        'singular_name'       => _x( 'Fellowship', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Fellowships' ),
        'parent_item_colon'   => __( 'Parent Fellowship' ),
        'all_items'           => __( 'All Fellowships' ),
        'view_item'           => __( 'View Fellowship' ),
        'add_new_item'        => __( 'Add New Fellowship' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Fellowship' ),
        'update_item'         => __( 'Update Fellowship' ),
        'search_items'        => __( 'Search Fellowship' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $fargs = array(
        'label'               => __( 'fellowships' ),
        'description'         => __( 'Fellowship news and reviews' ),
        'labels'              => $flabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
//         'taxonomies'          => array( 'category' ),
    );
    register_post_type( 'fellowships', $fargs );
	
    register_taxonomy( 'fe_category', array( 'fellowships' ), array(
        'hierarchical' => true,
        'label' => __( 'Category' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories ' ),
        'all_items' => __( 'All categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add new Category' ),
        'new_item_name' => __( 'Name of Category' ),
        'menu_name' => __( 'Category' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'fellowships/categories',
            'with_front' => false,
        ),)
    );
    register_taxonomy_for_object_type( 'tags', 'fellowships' );

    // Conference
	 $cflabels = array(
        'name'                => _x( 'Conference', 'Post Type General Name' ),
        'singular_name'       => _x( 'Conference', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Conference' ),
        'parent_item_colon'   => __( 'Parent Conference' ),
        'all_items'           => __( 'All Conference' ),
        'view_item'           => __( 'View Conference' ),
        'add_new_item'        => __( 'Add New Conference' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Conference' ),
        'update_item'         => __( 'Update Conference' ),
        'search_items'        => __( 'Search Conference' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $cfargs = array(
        'label'               => __( 'conference' ),
        'description'         => __( 'Conference news and reviews' ),
        'labels'              => $cflabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
//         'taxonomies'          => array( 'category' ),
    );
    register_post_type( 'conference', $cfargs );

    register_taxonomy( 'conf_category', array( 'conference' ), array(
        'hierarchical' => true,
        'label' => __( 'Category' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories ' ),
        'all_items' => __( 'All categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add new Category' ),
        'new_item_name' => __( 'Name of Category' ),
        'menu_name' => __( 'Category' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'conference/categories',
            'with_front' => false,
        ),)
    );
    register_taxonomy_for_object_type( 'tags', 'conference' );

	//Internships
	   $intlabels = array(
        'name'                => _x( 'Internship', 'Post Type General Name' ),
        'singular_name'       => _x( 'Internship', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Internships' ),
        'parent_item_colon'   => __( 'Parent Internship' ),
        'all_items'           => __( 'All Internships' ),
        'view_item'           => __( 'View Internship' ),
        'add_new_item'        => __( 'Add New Internship' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Internship' ),
        'update_item'         => __( 'Update Internship' ),
        'search_items'        => __( 'Search Internship' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $intargs = array(
        'label'               => __( 'internships' ),
        'description'         => __( 'Internships news and reviews' ),
        'labels'              => $intlabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
//         'taxonomies'          => array( 'category' ),
    );
    register_post_type( 'interships', $intargs );
 
    register_taxonomy( 'inter_category', array( 'internships' ), array(
        'hierarchical' => true,
        'label' => __( 'Category' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories ' ),
        'all_items' => __( 'All categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add new Category' ),
        'new_item_name' => __( 'Name of Category' ),
        'menu_name' => __( 'Category' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'internships/categories',
            'with_front' => false,
        ),)
    );
    register_taxonomy_for_object_type( 'tags', 'interships' );

    //Full Scholarship Program
    $fclabels = array(
        'name'                => _x( 'Full Scholarship', 'Post Type General Name' ),
        'singular_name'       => _x( 'Full Scholarship', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Full Scholarship' ),
        'parent_item_colon'   => __( 'Parent Full Scholarship' ),
        'all_items'           => __( 'All Full Scholarship' ),
        'view_item'           => __( 'View Full Scholarship' ),
        'add_new_item'        => __( 'Add New Full Scholarship' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Full Scholarship' ),
        'update_item'         => __( 'Update Full Scholarship' ),
        'search_items'        => __( 'Search Full Scholarship' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $fcargs = array(
        'label'               => __( 'fullscholarship' ),
        'description'         => __( 'Full Scholarship news and reviews' ),
        'labels'              => $fclabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
//         'taxonomies'          => array( 'category' ),
    );
    register_post_type( 'fullscholarship', $fcargs );

    register_taxonomy( 'fs_category', array( 'fullscholarship' ), array(
        'hierarchical' => true,
        'label' => __( 'Category' ),
        'labels' => array( // Labels customizadas
        'name' => _x( 'Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search categories ' ),
        'all_items' => __( 'All categories' ),
        'parent_item' => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item' => __( 'Edit Category' ),
        'update_item' => __( 'Update Category' ),
        'add_new_item' => __( 'Add new Category' ),
        'new_item_name' => __( 'Name of Category' ),
        'menu_name' => __( 'Category' ),
        ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'fullscholarship/categories',
            'with_front' => false,
        ),)
    );
    register_taxonomy_for_object_type( 'tags', 'fullscholarship' );

	

    // Media blog
	 $cflabels = array(
        'name'                => _x( 'Media blog', 'Post Type General Name' ),
        'singular_name'       => _x( 'Media blog', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Media blog' ),
        'parent_item_colon'   => __( 'Parent Media blog' ),
        'all_items'           => __( 'All Media blog' ),
        'view_item'           => __( 'View Media blog' ),
        'add_new_item'        => __( 'Add New Media blog' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Media blog' ),
        'update_item'         => __( 'Update Media blog' ),
        'search_items'        => __( 'Search Media blog' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $cfargs = array(
        'label'               => __( 'mediablog' ),
        'description'         => __( 'Media blog news and reviews' ),
        'labels'              => $cflabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'mediablog', $cfargs );
	
	
    // Mentors
	 $cflabels = array(
        'name'                => _x( 'Mentors', 'Post Type General Name' ),
        'singular_name'       => _x( 'Mentors', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Mentors' ),
        'parent_item_colon'   => __( 'Parent Mentors' ),
        'all_items'           => __( 'All Mentors' ),
        'view_item'           => __( 'View Mentors' ),
        'add_new_item'        => __( 'Add New Mentors' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Mentors' ),
        'update_item'         => __( 'Update Mentors' ),
        'search_items'        => __( 'Search Mentors' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $cfargs = array(
        'label'               => __( 'mentors' ),
        'description'         => __( 'Mentors news and reviews' ),
        'labels'              => $cflabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'mentors', $cfargs );
	
	
	// Blog

	 $bllabels = array(
        'name'                => _x( 'Blogs', 'Post Type General Name' ),
        'singular_name'       => _x( 'Blogs', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Blogs' ),
        'parent_item_colon'   => __( 'Parent Blogs' ),
        'all_items'           => __( 'All Blogs' ),
        'view_item'           => __( 'View Blogs' ),
        'add_new_item'        => __( 'Add New Blogs' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Blogs' ),
        'update_item'         => __( 'Update Blogs' ),
        'search_items'        => __( 'Search Blogs' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $blargs = array(
        'label'               => __( 'blog' ),
        'description'         => __( 'Blogs news and reviews' ),
        'labels'              => $bllabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'blogs', $blargs );
	
	// Student Success Stories

$sslabels = array(
   'name'                => _x( 'Student Success Stories', 'Post Type General Name' ),
   'singular_name'       => _x( 'Student Success Stories', 'Post Type Singular Name' ),
   'menu_name'           => __( 'Student Success Stories' ),
   'parent_item_colon'   => __( 'Parent Student Success Stories' ),
   'all_items'           => __( 'All Student Success Stories' ),
   'view_item'           => __( 'View Student Success Stories' ),
   'add_new_item'        => __( 'Add New Student Success Stories' ),
   'add_new'             => __( 'Add New' ),
   'edit_item'           => __( 'Edit Student Success Stories' ),
   'update_item'         => __( 'Update Student Success Stories' ),
   'search_items'        => __( 'Search Student Success Stories' ),
   'not_found'           => __( 'Not Found' ),
   'not_found_in_trash'  => __( 'Not found in Trash' ),
);
$ssargs = array(
   'label'               => __( 'stu_success_stories' ),
   'description'         => __( 'Student Success Stories news and reviews' ),
   'labels'              => $sslabels,
   'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
   'hierarchical'        => false,
   'public'              => true,
   'show_ui'             => true,
   'show_in_menu'        => true,
   'show_in_nav_menus'   => true,
   'show_in_admin_bar'   => true,
   'menu_position'       => 5,
   'can_export'          => true,
   'has_archive'         => true,
   'exclude_from_search' => false,
   'publicly_queryable'  => true,
   'capability_type'     => 'post',
   'show_in_rest' => true,
);
register_post_type( 'stu_success_stories', $ssargs );

	    // Hall of Fame

    $hflabels = array(
        'name'                => _x( 'Hall of Fame', 'Post Type General Name' ),
        'singular_name'       => _x( 'Hall of Fame', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Hall of Fame' ),
        'parent_item_colon'   => __( 'Parent Hall of Fame' ),
        'all_items'           => __( 'All Hall of Fame' ),
        'view_item'           => __( 'View Hall of Fame' ),
        'add_new_item'        => __( 'Add New Hall of Fame' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Hall of Fame' ),
        'update_item'         => __( 'Update Hall of Fame' ),
        'search_items'        => __( 'Search Hall of Fame' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $hfargs = array(
        'label'               => __( 'hall_of_fame' ),
        'description'         => __( 'Hall of Fame news and reviews' ),
        'labels'              => $hflabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'hall_of_fame', $hfargs );

    // Projects

    $prlabels = array(
        'name'                => _x( 'Projects', 'Post Type General Name' ),
        'singular_name'       => _x( 'Projects', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Projects' ),
        'parent_item_colon'   => __( 'Parent Projects' ),
        'all_items'           => __( 'All Projects' ),
        'view_item'           => __( 'View Projects' ),
        'add_new_item'        => __( 'Add New Projects' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Projects' ),
        'update_item'         => __( 'Update Projects' ),
        'search_items'        => __( 'Search Projects' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $prargs = array(
        'label'               => __( 'project' ),
        'description'         => __( 'Projects news and reviews' ),
        'labels'              => $prlabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'projects', $prargs );
	
    // Take the World Forward
    $tklabels = array(
        'name'                => _x( 'Take the World Forward', 'Post Type General Name' ),
        'singular_name'       => _x( 'Take the World Forward', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Take the World Forward' ),
        'parent_item_colon'   => __( 'Parent Take the World Forward' ),
        'all_items'           => __( 'All Take the World Forward' ),
        'view_item'           => __( 'View Take the World Forward' ),
        'add_new_item'        => __( 'Add New Take the World Forward' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Take the World Forward' ),
        'update_item'         => __( 'Update Take the World Forward' ),
        'search_items'        => __( 'Search Take the World Forward' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $tkargs = array(
        'label'               => __( 'take_world_fwd' ),
        'description'         => __( 'Take the World Forward news and reviews' ),
        'labels'              => $tklabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'take_world_fwd', $tkargs );	
	
	    // Project Features

    $pfslabels = array(
        'name'                => _x( 'Project Features', 'Post Type General Name' ),
        'singular_name'       => _x( 'Project Features', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Project Features' ),
        'parent_item_colon'   => __( 'Parent Project Features' ),
        'all_items'           => __( 'All Project Features' ),
        'view_item'           => __( 'View Project Features' ),
        'add_new_item'        => __( 'Add New Project Features' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Project Features' ),
        'update_item'         => __( 'Update Project Features' ),
        'search_items'        => __( 'Search Project Features' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $pfsargs = array(
        'label'               => __( 'project_features' ),
        'description'         => __( 'Project Features news and reviews' ),
        'labels'              => $pfslabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'project_features', $pfsargs );

	   // Testimonials

    $prlabels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Testimonials' ),
        'parent_item_colon'   => __( 'Parent Testimonials' ),
        'all_items'           => __( 'All Testimonials' ),
        'view_item'           => __( 'View Testimonial' ),
        'add_new_item'        => __( 'Add New Testimonial' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Testimonial' ),
        'update_item'         => __( 'Update Testimonial' ),
        'search_items'        => __( 'Search Testimonials' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $prargs = array(
        'label'               => __( 'testimonials' ),
        'description'         => __( 'Testimonials news and reviews' ),
        'labels'              => $prlabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'testimonials', $prargs );
	

	   // Schedule

    $prlabels = array(
        'name'                => _x( 'Schedule', 'Post Type General Name' ),
        'singular_name'       => _x( 'Schedule', 'Post Type Singular Name' ),
        'menu_name'           => __( 'Schedule' ),
        'parent_item_colon'   => __( 'Parent Schedule' ),
        'all_items'           => __( 'All Schedule' ),
        'view_item'           => __( 'View Schedule' ),
        'add_new_item'        => __( 'Add New Schedule' ),
        'add_new'             => __( 'Add New' ),
        'edit_item'           => __( 'Edit Schedule' ),
        'update_item'         => __( 'Update Schedule' ),
        'search_items'        => __( 'Search Schedule' ),
        'not_found'           => __( 'Not Found' ),
        'not_found_in_trash'  => __( 'Not found in Trash' ),
    );
    $prargs = array(
        'label'               => __( 'schedule' ),
        'description'         => __( 'Schedule news and reviews' ),
        'labels'              => $prlabels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    );
    register_post_type( 'schedule', $prargs );
	
	
}
add_action( 'init', 'custom_post_type', 0 );


<?php

add_action('wp_enqueue_scripts', 'theme_script_enqueuer');

function theme_script_enqueuer() {

	wp_register_style('screen', get_stylesheet_directory_uri().'/stylesheets/screen.css', '', '', 'screen');
  wp_enqueue_style( 'screen' );


	wp_localize_script('site', 'WP_ajax', array( 
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('myajax-post-comment-nonce'),
		)
	);

}	

$result = add_role(
    'department',
    __( 'Department' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);
// if ( null !== $result ) {
//     echo 'Yay! New role created!';
// }
// else {
//     echo 'Oh... the department role already exists.';
// }
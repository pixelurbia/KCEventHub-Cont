<?php

add_action('init', 'create_post_types');

function create_post_types() {

	register_post_type('event', 
		array(
			'labels' => array(
				'name' => 'Events',
				'singular_name' => 'Event',
				'add_new' => 'New Event',
				'add_new_item' => 'Add New Event',
				'edit_item' => 'Edit Event',
				'all_items' => 'All Events'
			),
		'publicly_queryable' => true,
	  	'public' => true,
			'taxonomies' => array('post_tag', 'events'),
			'supports' =>	array('title', 'editor', 'thumbnail')
		)
	);

	register_post_type('entries', 
		array(
			'labels' => array(
				'name' => 'Entries',
				'singular_name' => 'Entries',
				'add_new' => 'New Entrie',
				'add_new_item' => 'Add New Entrie',
				'edit_item' => 'Edit Entries',
				'all_items' => 'All Entries'
			),
	  	'public' => true,
			'taxonomies' => array('post_tag', 'entries'),
			'supports' =>	array('title', 'editor', 'thumbnail')
		)
	);
		register_post_type('resources', 
		array(
			'labels' => array(
				'name' => 'Resources',
				'singular_name' => 'Resources',
				'add_new' => 'New Resource',
				'add_new_item' => 'Add New Resource',
				'edit_item' => 'Edit Resources',
				'all_items' => 'All Resources'
			),
	  	'public' => true,
			'taxonomies' => array('post_tag', 'resources'),
			'supports' =>	array('title', 'editor', 'thumbnail')
		)
	);
			register_post_type('faqs', 
		array(
			'labels' => array(
				'name' => 'FAQs',
				'singular_name' => 'FAQs',
				'add_new' => 'New FAQs',
				'add_new_item' => 'Add New FAQs',
				'edit_item' => 'Edit FAQs',
				'all_items' => 'All FAQs'
			),
	  	'public' => true,
			'taxonomies' => array('post_tag', 'faqs'),
			'supports' =>	array('title', 'editor', 'thumbnail')
		)
	);
}

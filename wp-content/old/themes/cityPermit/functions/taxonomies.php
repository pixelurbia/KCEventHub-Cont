<?php

add_action('init', 'create_taxonomies');

function create_taxonomies() {

	register_taxonomy('events_category', 'event', 
		array(
			'publicly_queryable' => false,
			'labels' => array('name' => 'Events Categories'),
			'hierarchical' => true
		)
	);
	}
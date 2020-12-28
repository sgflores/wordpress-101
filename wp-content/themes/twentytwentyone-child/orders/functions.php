<?php
/*This file is for all the functions for custom orders page*/

function required_word_count_create_table()
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'required_word_count';
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$sql = "CREATE TABLE $table_name (
			id BIGINT NOT NULL AUTO_INCREMENT,
			count INT NOT NULL,
			order_id BIGINT UNSIGNED NOT NULL,
			PRIMARY KEY (id),
			FOREIGN KEY (order_id) REFERENCES {$wpdb->prefix}posts(id)
		) $charset_collate;";
		dbDelta( $sql );
	}
}
required_word_count_create_table();


add_action('rest_api_init', function () {
	register_rest_route( 'v1', 'GetAllArticles', array(
		'methods'  => 'GET',
		'callback' => 'get_all_articles'
	));
	register_rest_route( 'v1', 'UpdateRequiredWordCount', array(
		'methods'  => 'POST',
		'callback' => 'update_required_word_count'
	));
});

function get_all_articles($request) {
	return 'GetAllArticles';
}

function update_required_word_count(WP_REST_Request $request)
{
	return 'UpdateRequiredWordCount';
}
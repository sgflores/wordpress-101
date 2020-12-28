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

function get_all_articles(WP_REST_Request $request) {
	global $wpdb;
	$sql = "
		SELECT a.id, a.post_date, coalesce(d.user_email, 'guest') as email, 
		b.post_id, coalesce(e.count, 0) as count
		FROM wp_posts a
		LEFT JOIN wp_postmeta b
		ON a.id = b.post_id
		LEFT JOIN wp_users d
		ON b.meta_value = d.id
		LEFT JOIN wp_required_word_count e
		ON a.id = e.order_id
		where a.post_type = 'shop_order'
		AND b.meta_key = '_customer_user'
		order by a.id DESC;
	";
	$orders = $wpdb->get_results($sql);
	return $orders;
}

function update_required_word_count(WP_REST_Request $request)
{
	return 'UpdateRequiredWordCount';
}
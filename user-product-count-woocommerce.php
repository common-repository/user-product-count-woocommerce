<?php
/**
 * Plugin Name: User Product Count WooCommerce
 * Plugin URI: #
 * Description: Add count custom column in users list. Get total products count of each user/auther/seller in WooCommerce.
 * Version: 1.0.0
 * Author: Hardik Patel
 * Author URI: #
 * License: GPL2
 */
?>
<?php
class WP_UserProduct_Column{
	
	function __construct() {
		
		if ( class_exists( 'WP_UserProduct_Column' ) ) {
		
			// Adding custom columns
			function new_modify_user_table( $column ) {
				$column['userproducts'] = 'User Products';
				
				return $column;
			}
			add_filter( 'manage_users_columns', 'new_modify_user_table' );
			
			//Add content in custom column
			function new_userproducts_table_row( $val, $column_name, $user_id ) {
				switch ($column_name) {
					case 'userproducts' :
						
						$user_post_count = count_user_posts( $user_id , 'product' );
						return $user_post_count;
						break;
					
					default:
				}
				return $val;
			}
			add_filter( 'manage_users_custom_column', 'new_userproducts_table_row', 10, 3 );
		}
	}
}

new WP_UserProduct_Column();
?>
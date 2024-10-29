<?php

/**
 * The file that contains meta box data for custom post type
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://appuccino.xyz/
 * @since      1.0.0
 *
 * @package    Appuccino
 * @subpackage Appuccino/includes
 */

 function register_appuccino_meta_box() {

   // Add Body Templates
   add_meta_box(  'appuccino-meta-box-body-template',
                  'Page Template',
                  'appuccino_meta_box_body_template_callback',
                  'app_pages',
                  'normal',
                  'high');
 }

 function appuccino_meta_box_body_template_callback() {
   global $post;
   $values = get_post_custom( $post->ID );
   wp_nonce_field( 'appuccino_meta_box_body_template_nonce', 'meta_box_nonce' );
   require dirname(__DIR__) . '/view/meta_box/body-template.php';
 }

 function appuccino_meta_box_body_template_save( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
    }

    if( !isset( $_POST['meta_box_nonce'] )
    || !wp_verify_nonce( $_POST['meta_box_nonce'], 'appuccino_meta_box_body_template_nonce' ) ) {
      return;
    }

    if( !current_user_can( 'edit_post' ) ) {
      return;
    }

    if( isset( $_POST['appuccino_meta_box_body_template_value'] ) ) {
        update_post_meta( $post_id, 'appuccino_meta_box_body_template_value', sanitize_text_field($_POST['appuccino_meta_box_body_template_value'] ));
    }
 }

 add_action( 'save_post', 'appuccino_meta_box_body_template_save' );

<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://appuccino.xyz/
 * @since      1.0.0
 *
 * @package    Appuccino
 * @subpackage Appuccino/admin/partials
 */

 $templates = glob(dirname(__DIR__) . '/templates/*.php');
 $selected = isset( $values['appuccino_meta_box_body_template_value'] ) ? $values['appuccino_meta_box_body_template_value'] : '';
?>
<select name="appuccino_meta_box_body_template_value">
  <?php foreach($templates as $template_uri) { ?>
  <option <?php echo 'templates/' . str_replace('.php', '.html', basename($template_uri)) == $selected[0] ? 'selected' : '' ?> value="<?php echo 'templates/' . str_replace('.php', '.html', basename($template_uri)); ?>"><?php echo basename($template_uri); ?></option>
  <?php } ?>
</select>

<p>Templates are used to render the content of this page, you can manage custom templates in the <code>view/templates</code> folder of this plugin.</p>

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

	$admin = new Appuccino_Admin('appuccino', '1.0.0');

	$api_url = rtrim(home_url(), '/');
	$manifest_file = @json_decode(file_get_contents(implode('', array($api_url,'/wp-json/appuccino/v1/manifest.json'))));


	$admin->enqueue_styles();
	$admin->enqueue_scripts();

	$api_endpoint = implode('', array($api_url, '/wp-json/appuccino/v1/'));
	$api_endpoint_parsed = parse_url($api_endpoint);
	$is_localhost = $api_endpoint_parsed['host'] == 'localhost' || $api_endpoint_parsed['host'] == '127.0.0.1';

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="uk-scoped">
	<div class="uk-padding">
		<div class="uk-container uk-container-small">
			<div class="uk-text-center uk-margin-medium-bottom">
				<img src="<?php echo plugins_url( '/img/appuccino-logo-dark.png', __DIR__ ); ?>" alt="Appuccino Logo" width="170">
			</div>
			<div class="uk-alert-success" uk-alert>
			    <a class="uk-alert-close" uk-close></a>
			  <p><strong>Hurray!</strong> You have successfully installed Appuccino for Wordpress (<?php echo $admin->get_version(); ?>). Not built your app yet? Get started <a href="https://appuccino.xyz/?app_url=<?php echo $api_endpoint; ?>" target="_blank">here</a>.</p>
			</div>
			<div class="uk-card uk-card-default uk-card-body uk-padding-small uk-border-rounded">
				<div uk-grid class="uk-child-width-expand">
					<div>
						<div>
							<ul class="uk-margin uk-margin-remove-bottom switcher-container uk-padding-small">
							    <li>

									<div class="uk-margin">
								        <label class="uk-form-label uk-text-meta">App URL</label>
								        <div class="uk-form-controls uk-margin-small-top">
								        	<h4 class="uk-text-center uk-card-default uk-padding-small uk-card-secondary uk-box-shadow-small"><?php echo $api_endpoint; ?></h4>
								        </div>
								    </div>
									
									<?php if($is_localhost) { ?>
								    <div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
									  <a class="uk-alert-close" uk-close></a>
									  <p><strong>Oh no!</strong> It looks like your site is hosted locally which is not accessible to the outside world. an Appuccino app will not work whilst set as localhost or 127.0.0.1</p>
									</div>
									<?php } else { ?>
									
									<div class="uk-margin uk-text-right">
										<a href="https://appuccino.xyz/?app_url=<?php echo $api_endpoint; ?>" target="_blank" class="uk-button uk-button-primary">Create App</a>
									</div>

									<?php } ?>

							    </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="uk-card uk-card-default uk-card-body uk-padding-small uk-border-rounded uk-margin-small-top">
				<div class="uk-margin">
					
					<?php if(!is_array($manifest_file)) { ?>
					<div class="uk-alert-danger uk-margin-remove-bottom" uk-alert>
					  <a class="uk-alert-close" uk-close></a>
					  <p><strong>Oh no!</strong> I cannot load the manifest file this could be because you need to re-save your permalinks settings or because your site has been configured incorrectly. In order for your app to work, the manifest file is required.</p>
					</div>
					<?php } else { ?>
			        <label class="uk-form-label uk-text-meta">App Manifest</label>
			       	<table class="uk-table uk-table-small uk-table-divider">
					    <thead>
					        <tr>
					            <th>Filename</th>
					            <th>Checksum</th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php foreach($manifest_file as $item) { ?>
					        <tr>
					            <td>
					            	<a target="_blank" href="<?php echo $api_url; ?>/wp-json/appuccino/v1/file.json?file=<?php echo $item->file; ?>"><?php echo $item->file; ?></a>
					            </td>
					            <td><?php echo $item->md5; ?></td>
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>
					<?php } ?>
			    </div>
			</div>
			<div class="uk-card uk-card-default uk-card-body uk-padding-small uk-border-rounded uk-margin-small-top">
				<div class="uk-margin uk-text-center">
					<label class="uk-form-label uk-text-small uk-text-meta uk-text-left uk-display-block">App URL QR Code</label>
					<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo urlencode($api_url . '/wp-json/appuccino/v1/'); ?>&choe=UTF-8" alt="QR Code">
				</div>
			</div>
			<p class="uk-text-muted uk-text-center">Thanks for using Appuccino. Having problems? contact us at <a href="mailto:help@appuccino.xyz">help@appuccino.xyz</a></p>

		</div>
	</div>
</div>
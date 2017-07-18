<div class="wrap">
    <h2>WP Sales Notifier</h2>
	<div id="wsn-tab-menu"><a id="wsn-general" class="wsn-tab-links active" >General</a> <a  id="wsn-pro" class="wsn-tab-links">GO PRO</a> <a  id="wsn-support" class="wsn-tab-links">Support</a> <a  id="wsn-other" class="wsn-tab-links">Other Plugins</a></div>
    <form method="post" action="options.php"> 
        <?php @settings_fields('wsn-group'); ?>
        <?php @do_settings_fields('wsn-group'); ?>
        <div class="wsn-setting">
			<!-- General Setting -->	
			<div class="first wsn-tab" id="div-wsn-general">
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="wsn_enable">Enable</label></th>
						<td><input type="checkbox" value="1" name="wsn_enable" id="wsn_enable" <?php checked(get_option('wsn_enable'),1); ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wsn_display_date">Display Date</label></th>
						<td><input type="checkbox" value="1" name="wsn_display_date" id="wsn_display_date" <?php checked(get_option('wsn_display_date'),1); ?> /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="wsn_delay_time">Delay Time</label></th>
						<td><input type="text"  name="wsn_delay_time" id="wsn_delay_time" value="<?php echo get_option('wsn_delay_time'); ?>" placeholder="5000"/>(ms)</td>
					</tr>
				</table>
			</div>
			<div class="wsn-tab" id="div-wsn-support"> <h2>Support</h2> 
				<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZEMSYQUZRUK6A" target="_blank" style="font-size: 17px; font-weight: bold;"><img src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" title="Donate for this plugin"></a></p>
				<p><strong>Plugin Author:</strong><br><img src="<?php echo  plugins_url( '../images/mrweb.jpg' , __FILE__ );?>" width="75" height="75" class="authorimg"><br><a href="http://raghunathgurjar.wordpress.com" target="_blank">MR Web Solution</a></p>
				<p><a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author">Contact Author</a></p>
			</div>
			<div class="wsn-tab" id="div-wsn-pro"> 
			<h2>Get Addon</h2> 
			
			<p><a href="https://rgaddons.wordpress.com/wp-sales-notifier-pro/" target="_blank" class="contact-author">Go Pro</a></p>
			
			 We have also released an add-on for WP Sales Notifier which not only demonstrates the flexibility of "WP Sales Notifier", but also adds some important features:
			<ul>
			<li>Flash Notification </li> 
			<li>Hide Flash Notification On Home|Post|Page|Category|Archive|Author|Search pages</li> 
			<li>An option for hide flash notification on Custom Post Type</li> 
			<li>An option for hide flash notification on Custom Term Type</li> 
			<li>An Option for define to number of most recent order item</li> 
			<li>An option for define position of flash notification.</li> 
			<li>Faster support</li> 
           </ul>
           <h2 style="color:green;text-align:left;"><strong>Pay one time use lifetime!!!!!</strong><br><br> Hurry up!!!!</h2>
			<p><a href="https://rgaddons.wordpress.com/wp-sales-notifier-pro/" target="_blank" class="contact-author">Go Pro</a></p>
			<p> <a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author">Contact To Author</a></p>
			</div>
			<div class="last wsn-tab" id="div-wsn-other">
				<h2>Other plugins</h2>
				<p><strong>My Other Plugins:</strong><br>
				<ol>
				<li><a href="https://wordpress.org/plugins/custom-share-buttons-with-floating-sidebar" target="_blank">Custom Share Buttons With Floating Sidebar</a></li>
				<li><a href="https://wordpress.org/plugins/protect-wp-admin/" target="_blank">Protect WP-Admin</a></li>
				<li><a href="https://wordpress.org/plugins/wp-categories-widget/" target="_blank">WP Categories Widget</a></li>
				<li><a href="https://wordpress.org/plugins/wp-protect-content/" target="_blank">WP Protect Content</a></li>
				<li><a href="https://wordpress.org/plugins/wp-version-remover/" target="_blank">WP Version Remover</a></li>
				<li><a href="https://wordpress.org/plugins/wp-posts-widget/" target="_blank">WP Post Widget</a></li>
				<li><a href="https://wordpress.org/plugins/wp-importer" target="_blank">WP Importer</a></li>
				<li><a href="https://wordpress.org/plugins/wp-csv-importer/" target="_blank">WP CSV Importer</a></li>
				<li><a href="https://wordpress.org/plugins/wp-testimonial/" target="_blank">WP Testimonial</a></li>
				<li><a href="https://wordpress.org/plugins/wc-sales-count-manager/" target="_blank">WooCommerce Sales Count Manager</a></li>
				<li><a href="https://wordpress.org/plugins/wp-social-buttons/" target="_blank">WP Social Buttons</a></li>
				<li><a href="https://wordpress.org/plugins/wp-youtube-gallery/" target="_blank">WP Youtube Gallery</a></li>
				<li><a href="https://wordpress.org/plugins/tweets-slider/" target="_blank">Tweets Slider</a></li>
				<li><a href="https://wordpress.org/plugins/rg-responsive-gallery/" target="_blank">RG Responsive Slider</a></li>
				<li><a href="https://wordpress.org/plugins/cf7-advance-security" target="_blank">Contact Form 7 Advance Security WP-Admin</a></li>
				<li><a href="https://wordpress.org/plugins/wp-easy-recipe/" target="_blank">WP Easy Recipe</a></li>
				</ol>
				</p>
			</div>
		</div>
        <?php @submit_button(); ?>
    </form>
</div>

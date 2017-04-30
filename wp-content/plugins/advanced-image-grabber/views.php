<?php
add_action('wp_ajax_aig_image_list_view', array('Advanced_Image_Grabber_views','display'));
add_action('wp_ajax_nopriv_aig_image_list_view',array('Advanced_Image_Grabber_views','display'));
add_action('wp_ajax_aig_upload_an_image', array('Advanced_Image_Grabber_views','displayUpload'));
add_action('wp_ajax_nopriv_aig_upload_an_image',array('Advanced_Image_Grabber_views','displayUpload'));
add_shortcode("aig_frontend", array('Advanced_Image_Grabber_views','aigShortcode'));
class Advanced_Image_Grabber_views{
	public function aigShortcode(){
		ob_start();
		self::adminSettingsPage();
		$output = ob_get_contents(); // end output buffering
    	ob_end_clean(); // grab the buffer contents and empty the buffer
		return $output;
	}//EOF
	static public function adminSettingsPage(){
		wp_enqueue_style('advanced_image_grabber_style', ADVANCED_IMAGE_GRABBER.'css/style.css');
		wp_enqueue_style('advanced_image_grabber_picker_style', ADVANCED_IMAGE_GRABBER.'css/image-picker.css');
		wp_enqueue_script('advanced_image_grabber_picker_script', ADVANCED_IMAGE_GRABBER.'js/image-picker.min.js');
		?>
        
        <h1 id="aigTitleh1">Advanced Image Grabber</h1>
		<form id="advanced_image_grabber_frm">
  			<textarea id="ad_img_grab_url" placeholder="Write webpage urls separated by line break [max 5]" rows="6" cols="60"></textarea><br />
            <input type="button" id="aig_grab_images" class="button button-primary" onClick="return false;" value="Grab Images" />
		</form>
        <div class="aig_img_uploadmsg">
        </div>
        <div class="aig_img_listbox">
        </div>
        <div class="aig_img_upload_success">
        </div>
        <div class="aig_img_upload_failure">
        <h2>Failure:</h2>
        </div>
        <script language="javascript"> //Ajax call on button click
			jQuery('#aig_grab_images').click(function(){
				var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
				var urls = jQuery( "textarea#ad_img_grab_url").val();
				if(urls){
				jQuery('.aig_img_listbox').html('<img src="<?php echo ADVANCED_IMAGE_GRABBER.'images/loading.gif'; ?>" style="width:150px;height:150px;" />');
   				jQuery.ajax({
        		url: ajaxurl,
        		data: {
            		'action' : 'aig_image_list_view',
					'security' : '<?php echo wp_create_nonce( "aig-image-list-nonce" ); ?>', //Nonce Check
            		'urls' : urls  
        			},
        			success:function(data) { //Showing notification that data saved
					jQuery('.aig_img_listbox').html(data);
      		  		},
        			error: function(errorThrown){
            		console.log(errorThrown);
        			}
					}); 
				}
			});
		</script>
        <?php
		
	} //EOF
	static public function display(){
		if(isset($_REQUEST['urls']) && check_ajax_referer( 'aig-image-list-nonce', 'security' )):
		$urlList = explode("\n", str_replace("\r", "", $_REQUEST['urls'])); 
		$urls = Advanced_Image_Grabber::getImageUrl($urlList);
		if($urls):
			echo '<a id="select_all_aig_img" href="#selectAll"><strong>Select All</strong></a><a name="selectAll"></a> || 
			<a id="deselect_all_aig_img" href="#deSelectAll"><strong>Deselect All</strong></a><a name="deSelectAll"></a>
			  &nbsp; (Just click on image to select/deselect) <br /></br /> ';
			echo '<select id="aig_grabbed_images" class="image-picker show-html" multiple>';
			foreach($urls as $src):
		 	echo '<option data-img-src="'.$src.'">'.$src.'</option>';
			endforeach;
			echo '</select>';
			echo '<input type="button" id="aig_selected_images" class="button button-primary" onClick="return false;" value="Import Images" />';
			?>
        	<script language="javascript">
			jQuery("#aig_grabbed_images").imagepicker();
			jQuery("#select_all_aig_img").click(function(){
					jQuery('#aig_grabbed_images option').prop('selected', true);
					jQuery("#aig_grabbed_images").imagepicker();
				});
			jQuery("#deselect_all_aig_img").click(function(){
					jQuery('#aig_grabbed_images option').prop('selected', false);
					jQuery("#aig_grabbed_images").imagepicker();
				});
			jQuery("#aig_selected_images").click(function(){
				jQuery('html, body').animate({
       			 scrollTop: jQuery('#aigTitleh1').offset().top - 80
   				 }, 'slow');
					if(jQuery("#aig_grabbed_images").val()){ //Not Null
					jQuery('#advanced_image_grabber_frm').hide();
						var lastval = jQuery('#aig_grabbed_images :selected').last().text();
						jQuery('#aig_grabbed_images :selected').each(function(i, selected){
							if(jQuery(selected).text()==lastval)
  								ajaxImportImageByUrl(jQuery(selected).text(),1);
							else
								ajaxImportImageByUrl(jQuery(selected).text(),0);
						});
					}
					function ajaxImportImageByUrl(url,iflast){
					var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
					jQuery.ajax({
        			url: ajaxurl,
        			data: {
            		'action' : 'aig_upload_an_image',
					'security' : '<?php echo wp_create_nonce( "aig-image-upload-nonce" ); ?>', //Nonce Check
            		'url' : url,
					'iflast' : iflast
        			},
        			success:function(data) { //Showing notification that data saved
					jQuery('.aig_img_uploadmsg').html(data);
      		  		},
        			error: function(errorThrown){
            		console.log(errorThrown);
        			}
					}); 
					}
				});
			</script>
        	<?php
			else:
				?>
                <script language="javascript">
				jQuery('.aig_img_listbox').html("No Images Found!");
				</script>
                <?php
			endif;
		endif;
		die();
	} //EOF
	
	static public function displayUpload(){
		if(isset($_REQUEST['url']) && check_ajax_referer( 'aig-image-upload-nonce', 'security' )):
		$uploadResult = Advanced_Image_Grabber::imageUpload($_REQUEST['url']);
			if($uploadResult): //Fail to upload
				?>
                <script language="javascript">
				jQuery('.aig_img_listbox').html('<strong>Importing Image => <?php echo basename($_REQUEST['url']);?>....</strong>');
				jQuery('.aig_img_upload_success').show();
				jQuery(".aig_img_upload_success").append('<a href="<?php echo wp_get_attachment_url($uploadResult); ?>" target="_blank"><img src="<?php echo $_REQUEST['url']; ?>"/></a>');

				</script> 
                <?php
			else:
				?>
                <script language="javascript">
				jQuery('.aig_img_listbox').html('<strong>Importing Image => <?php echo basename($_REQUEST['url']);?>....</strong>');
				jQuery('.aig_img_upload_failure').show();
				jQuery(".aig_img_upload_failure").append('<img src="<?php echo $_REQUEST['url']; ?>" />');
				</script>
                
            	<?php
			endif;
			?>
			<script language="javascript">
			jQuery( document ).ajaxStop(function() {
				jQuery(".aig_img_listbox").html("<strong>Import Complete!</strong>");
			});
			</script>
		<?php
		endif;
		die();
	} //EOF
}
?>
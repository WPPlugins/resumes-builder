<?php


function resumes_posttype_register() {
 
        $labels = array(
                'name' => _x('Resumes', 'resumes'),
                'singular_name' => _x('Resumes', 'resumes'),
                'add_new' => _x('New Resumes', 'resumes'),
                'add_new_item' => __('New Resumes'),
                'edit_item' => __('Edit Resumes'),
                'new_item' => __('New Resumes'),
                'view_item' => __('View Resumes'),
                'search_items' => __('Search Resumes'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );
 
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => null,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title'),
				'menu_icon' => 'dashicons-media-spreadsheet',
				
          );
 
        register_post_type( 'resumes' , $args );

}

add_action('init', 'resumes_posttype_register');





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_resumes()
	{
		$screens = array( 'resumes' );
		foreach ( $screens as $screen )
			{
				add_meta_box('resumes_metabox',__( 'Resumes Options','resumes' ),'meta_boxes_resumes_input', $screen);
			}
	}
add_action( 'add_meta_boxes', 'meta_boxes_resumes' );


function meta_boxes_resumes_input( $post ) {
	
	global $post;
	wp_nonce_field( 'meta_boxes_resumes_input', 'meta_boxes_resumes_input_nonce' );
	
	$sections_data = get_post_meta( $post->ID, 'sections_data', true );	
	$resumes_builder_theme = get_post_meta( $post->ID, 'resumes_builder_theme', true );	



?>

    <div class="para-settings resumes-builder-settings">
        <div class="option-box">
            <p class="option-title">Shortcode</p>
            <p class="option-info">Copy this shortcode and paste on page or post where you want to display post grid. <br />Use PHP code to your themes file to display post grid.</p>
			<textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[resumes_builder <?php echo ' id="'.$post->ID.'"';?> ]</textarea>
        <br /><br />
        PHP Code:<br />
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[resumes_builder id='; echo "'".$post->ID."' ]"; echo '"); ?>'; ?></textarea>  
		</div>


        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Options</li>
            <li nav="2" class="nav2">Style</li>            
           
        </ul> <!-- tab-nav end -->
        
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
				
				<div class="option-box">
                    <p class="option-title">Resumes Thumbnail</p>
                    <p class="option-info"></p>
					<input type="text" name="sections_data[thumbnail]" id="sections_data_thumbnail" value="<?php if(!empty($sections_data['thumbnail'])) echo $sections_data['thumbnail']; ?>" /><br />
                    <input id="sections_data_thumbnail_upload" class="sections_data_thumbnail_upload button" type="button" value="Upload Image" />
                       <br />
                       
                       
                        <?php
                        	if(empty($sections_data['thumbnail']))
								{
								?>
                                <img class="sections_data_thumbnail_display" width="300px" src="<?php echo resumes_builder_plugin_url.'css/no-thumb.png'; ?>" />
                                <?php
								}
							else
								{
								?>
                                <img class="sections_data_thumbnail_display" width="300px" src="<?php echo $sections_data['thumbnail']; ?>" />
                                <?php
								}
						?>
                       
                       
                       
                       
                       
					<script>
                        jQuery(document).ready(function($){

                            var custom_uploader; 
                         
                            jQuery('#sections_data_thumbnail_upload').click(function(e) {
													
                                e.preventDefault();
                         
                                //If the uploader object has already been created, reopen the dialog
                                if (custom_uploader) {
                                    custom_uploader.open();
                                    return;
                                }
                        
                                //Extend the wp.media object
                                custom_uploader = wp.media.frames.file_frame = wp.media({
                                    title: 'Choose Image',
                                    button: {
                                        text: 'Choose Image'
                                    },
                                    multiple: false
                                });
                        
                                //When a file is selected, grab the URL and set it as the text field's value
                                custom_uploader.on('select', function() {
                                    attachment = custom_uploader.state().get('selection').first().toJSON();
                                    jQuery('#sections_data_thumbnail').val(attachment.url);
                                    jQuery('.sections_data_thumbnail_display').attr('src',attachment.url);									
                                });
                         
                                //Open the uploader dialog
                                custom_uploader.open();
                         
                            });
                            
                            
                        })
                    </script>
                </div> 
                
				<div class="option-box">
                    <p class="option-title">Resumes Ttile</p>
                    <p class="option-info"></p>
                    <input type="text" placeholder="Title" name="sections_data[title]" value="<?php if(isset($sections_data['title'])) echo $sections_data['title']; ?>" />
                    
                    <p class="option-title">Resumes Subtitle</p>
                    <p class="option-info"></p>
                    <input type="text" placeholder="Subtitle" name="sections_data[subtitle]" value="<?php if(isset($sections_data['subtitle'])) echo $sections_data['subtitle']; ?>" />
                    
                    <p class="option-title">Resumes Details</p>
                    <p class="option-info"></p>
                    
                    <textarea placeholder="Details" name="sections_data[details]" ><?php if(isset($sections_data['details'])) echo $sections_data['details']; ?></textarea>
                                 
                    
                    <?php
                    		$ResumesBuilderClass = new ResumesBuilderClass();
							echo $ResumesBuilderClass->ResumesBuilder_html();
					
					?>
                    

					<script>
                        jQuery(document).ready(function($)
                        {
                            $(function() {
                                $( ".items-container, .entry-list" ).sortable();
                            
                            
                                //$( ".items-container" ).disableSelection();
                            });
                        
                        })
                    
                    </script>        

                    
                    
                    
                    
                    
                </div>
                
				                
                
                
                
                
                
                
               
            </li>
            <li style="display: none;" class="box2 tab-box">
				<div class="option-box">
                    <p class="option-title"><?php _e('Themes.','resumes_builder'); ?></p>
                    <p class="option-info"></p>
                    <select name="resumes_builder_theme"  >
                    <option  value="flat" <?php if($resumes_builder_theme=="flat")echo "selected"; ?>>Flat</option>
                    <option  value="blue" <?php if($resumes_builder_theme=="blue")echo "selected"; ?>>Blue</option>
             
                    </select>
				</div>
            
            </li>
            
            
        </ul>

    
    </div>
    
    
    
    

    
    
    
<?php


	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function meta_boxes_resumes_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['meta_boxes_resumes_input_nonce'] ) )
    return $post_id;

  $nonce = $_POST['meta_boxes_resumes_input_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'meta_boxes_resumes_input' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;



  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
 	$sections_data = stripslashes_deep( $_POST['sections_data'] );
 	$resumes_builder_theme = sanitize_text_field( $_POST['resumes_builder_theme'] );		 

	//$resumes_post_per_page = sanitize_text_field( $_POST['resumes_post_per_page'] );	
		


  // Update the meta field in the database.
	update_post_meta( $post_id, 'sections_data', $sections_data );  
	update_post_meta( $post_id, 'resumes_builder_theme', $resumes_builder_theme ); 	
		


}
add_action( 'save_post', 'meta_boxes_resumes_save' );






?>
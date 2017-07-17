<?php	

	if(empty($_POST['resumes_builder_hidden']))
		{
			//$resumes_builder_ribbons = get_option( 'resumes_builder_ribbons' );
			
			
		}
	else
		{
					
				
		if($_POST['resumes_builder_hidden'] == 'Y') {
			//Form data sent

			//$resumes_builder_ribbons = stripslashes_deep($_POST['resumes_builder_ribbons']);
			//update_option('resumes_builder_ribbons', $resumes_builder_ribbons);
			
		
			
					

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p></div>

			<?php
		} 
	}
	
	
	
    $resumes_builder_customer_type = get_option('resumes_builder_customer_type');
    $resumes_builder_version = get_option('resumes_builder_version');
	
	
	
	
	
?>





<div class="wrap">

	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__(resumes_builder_plugin_name.' Help')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="resumes_builder_hidden" value="Y">
        <?php settings_fields( 'resumes_builder_plugin_options' );
				do_settings_sections( 'resumes_builder_plugin_options' );
			
		?>
        
        
	<div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Help & Support</li>

        </ul> <!-- tab-nav end -->
    
		<ul class="box">
            <li style="display: block;" class="box1 tab-box active">
            
				<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo resumes_builder_qa_url; ?>"><?php echo resumes_builder_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br />
                    </p>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Upgrade</p>
                    <p class="option-info">
					<?php
                
                    if($resumes_builder_customer_type=="free")
                        {
                    
                            echo 'You are using <strong> '.$resumes_builder_customer_type.' version  '.$resumes_builder_version.'</strong> of <strong>'.resumes_builder_plugin_name.'</strong>, To get more feature you could try our premium version. ';
                            
                            echo '<br /><a href="'.resumes_builder_pro_url.'">'.resumes_builder_pro_url.'</a>';
                            
                        }
                    else
                        {
                    
                            echo 'Thanks for using <strong> premium version  '.$resumes_builder_version.'</strong> of <strong>'.resumes_builder_plugin_name.'</strong> ';	
                            
                            
                        }
                    
                     ?>       

                    
                    </p>

                </div>
                
				<div class="option-box">
                    <p class="option-title">Submit Reviews...</p>
                    <p class="option-info">We are working hard to build some awesome plugins for you and spend thousand hour for plugins. we wish your three(3) minute by submitting five star reviews at wordpress.org. if you have any issue please submit at forum.</p>
                	
                    <a target="_blank" href="<?php echo resumes_builder_wp_reviews; ?>">
                		<?php echo resumes_builder_wp_reviews; ?>
               		</a>
                    
                    
                    
                </div>
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
                    <?php
                    
						echo resumes_builder_share_plugin();
					?>
                </div>
				
            
            
            </li>  

        </ul>
    
    
    
    </div>    




<p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
		</form>


</div>

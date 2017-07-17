<?php

	
	function resumes_builder_add_entry_ajax()
		{
			
		$section_id = $_POST['section_id'];
		$entry_count = $_POST['entry_count'];		
		
		$ResumesBuilderClass = new ResumesBuilderClass();
		$sections = $ResumesBuilderClass->sections;
		
		$sections_entries_args = $ResumesBuilderClass->sections_entries_args;	
		$sections_data = array();
		
		
		
		
					
		$html = '';

		$html .= '<div class="entry">';
		$html .= '<span class="remove">X</span>';
	
		foreach($sections_entries_args[$section_id] as $args_key)
			{
				
				if($args_key == 'details')
					{
					$html .= '<textarea placeholder="'.ucfirst($args_key).'" name="sections_data['.$section_id.'][entries]['.$entry_count.']['.$args_key.']"></textarea>';
					
					
					}
				else
					{
					$html .= '<input type="text" placeholder="'.ucfirst($args_key).'" name="sections_data['.$section_id.'][entries]['.$entry_count.']['.$args_key.']" value="" /><br />';
					}


			}

		$html .= '</div>';

		
			
		echo $html;
		
		die();
		
		}
	

add_action('wp_ajax_resumes_builder_add_entry_ajax', 'resumes_builder_add_entry_ajax');
add_action('wp_ajax_nopriv_resumes_builder_add_entry_ajax', 'resumes_builder_add_entry_ajax');
	
	
	
	
	
	
	
	function resumes_builder_share_plugin()
		{
			
			?>
<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Fresumes-builder%2F&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo resumes_builder_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo resumes_builder_share_url; ?>" data-text="<?php echo resumes_builder_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}
	

		
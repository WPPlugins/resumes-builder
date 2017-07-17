<?php


function resumes_builder_themes_flat($resume_id)
	{
		$ResumesBuilderClass = new ResumesBuilderClass();
		$sections_data = (array)$ResumesBuilderClass->post_meta($resume_id, 'sections_data');
		
		//var_dump($sections_data);
		
		$html = '';
		
		$html .= '<div class="resumes-container flat">';
		
		$html .= '<div class="resumes-header">';
		$html.= $ResumesBuilderClass->get_resumes_header($resume_id, array('thumbnail','title','subtitle','details'));

		$html.= '</div>';
		$html .= '<div class="section-container">';
		foreach($sections_data as $key=>$values)
			{
				
				
				if($key == 'thumbnail' || $key == 'title' || $key == 'subtitle' || $key == 'details'  )
					{
						//$html.=$key.'-';
					}
				else
					{
						
						if(isset($sections_data[$key]['display']))
							{
								$html.= $ResumesBuilderClass->get_resumes_sections($resume_id, $key);
							}
						
						
						
					}
				
				
				//$html.= $ResumesBuilderClass->get_resumes_sections($resume_id, $key);
				//$html.= $ResumesBuilderClass->get_resumes_sections($resume_id, 'portfolio');
			}
		$html.= '</div>';
				
		$html.= '</div>';
		
		$html .= '<style type="text/css">
		
				.resumes-container .section-container {
				  margin: 0 auto !important;
				}
				</style>
				';

		$html .= '<script>
		jQuery(document).ready(function($) {
		var container = document.querySelector(".resumes-container .section-container");
		var msnry = new Masonry( container, {isFitWidth: true
		
		});
		});
		</script>';	
		
		
		




		
		return $html;
	}
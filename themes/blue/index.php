<?php


function resumes_builder_themes_blue($resume_id)
	{
		$ResumesBuilderClass = new ResumesBuilderClass();
		$sections_data = (array)$ResumesBuilderClass->post_meta($resume_id, 'sections_data');
		
		//var_dump($sections_data);
		
		$html = '';
		
		$html .= '<div class="resumes-container blue">';
		$html .= '<div class="col-left">';	
		
		$html.= $ResumesBuilderClass->get_resumes_header($resume_id, array('thumbnail'));
		
		$html .= '<div class="title-container">';	
		$html.= $ResumesBuilderClass->get_resumes_header($resume_id, array('title'));		
		$html.= $ResumesBuilderClass->get_resumes_header($resume_id, array('subtitle'));
		$html.= '</div>';
		
		$html.= $ResumesBuilderClass->get_resumes_header($resume_id, array('details'));
		$html .= '<div class="resumes-contact">';
		$html.= $ResumesBuilderClass->get_resumes_section_entry($resume_id, 'contact_info');
		$html.= '</div>';
		
		$html .= '<div class="resumes-social">';
		$html.= $ResumesBuilderClass->get_resumes_section_entry($resume_id, 'social');
		$html.= '</div>';		
		$html.= '</div>';
		
		$html .= '<div class="col-right">';	
		
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

			}
		
		
		$html.= '</div>';		
		
		
		
		
		
		
		/*
		
		
		
			
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
		
		
		*/




		
		return $html;
	}
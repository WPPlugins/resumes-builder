<?php

class ResumesBuilderClass
	{
		public $sections = array(
									'education'=> 'Education',
									'experiences'=> 'Experiences',									
									'contact_info'=> 'Contact Info',
									'award'=> 'Award',	
									'skill'=> 'Skill',																		
									'social'=> 'Social',	
									'interest'=> 'Interest',
									'language'=> 'Language',
									'portfolio'=> 'Portfolio',								
									
									);
									
		public $sections_properies = array('title','subtitle','details');									
									
									
		public $sections_entries_args = array(
									'education'=> array('title','subtitle','year','details',),
									'experiences'=> array('title','subtitle','year','details',),									
									'contact_info'=> array('email','url','location','phone'),
									'award'=> array('title','subtitle','year','details',),	
									'skill'=> array('name','level','details'),																		
									'social'=> array('facebook','twitter','linkedin'),	
									'interest'=> array('name','level','details'),
									'language'=> array('name','level','details'),
									'language'=> array('name','level','details'),									
									'portfolio'=> array('name','url','source','details',), //source can be image url or youtube video										
									);									
									
	public function post_meta($post_id,$meta_key)
				{	
					return get_post_meta( $post_id, $meta_key, true );
				
				}
				
								
									
		public function ResumesBuilder_settings()
					{
					global $post;
					
					$sections = $this->sections;
					$sections_properies = $this->sections_properies;
					$sections_entries_args = $this->sections_entries_args;					
					
					
					$sections_data = $this->post_meta($post->ID, 'sections_data');										
					
			
					if( !empty($sections_data))
						{
							$sections_new = array();
							
							foreach($sections_data as $key=>$val)
								{
									if($key == "thumbnail" || $key == "title"  || $key == "subtitle"  || $key == "details")
										{

										}
									else
										{
											$sections_new[$key] = $sections[$key];		
										}
																				
									
								}
							
							$sections = $sections_new;
							
							
						}


					
					
					$html = '';
				
					foreach($sections as $key=>$name)
						{
		
					$html .= '<div class="saved-item" data-class="saved-item" id="'.$key.'"><div class="header">'.$name;
					if(!empty($sections_data[$key]['display']))
						{
					$html .= '<span class="input-switch"><input checked type="checkbox" id="switch-'.$key.'" name="sections_data['.$key.'][display]" class="switch" />
	<label title="Display on grid ?" for="switch-'.$key.'">&nbsp;</label>
</span>';

						}
					else
						{
					$html .= '<span class="input-switch"><input type="checkbox" id="switch-'.$key.'" name="sections_data['.$key.'][display]" class="switch" />
	<label title="Display on grid ?" for="switch-'.$key.'">&nbsp;</label>
</span>';
						}

					
					$html .= '</div>';
							
					//$html .= '<input type="hidden" name="resumes_section['.$key.']" value="'.$name.'" />';							
					$html .= '<div class="options">';
					
					
					
					
					
					
					
					foreach($sections_properies as $properties)
						{	
							$html .= '<p><b>Section '.ucfirst($properties).'</b><br />';
							
							if(empty($sections_data[$key][$properties]))
								{
									$values = '';
								}
							else
								{
									
									$values = $sections_data[$key][$properties];
								}
							
							
							if($properties == 'details')
								{
									$html .= '<textarea placeholder="'.$properties.'" name="sections_data['.$key.']['.$properties.']">'.htmlentities($values).'</textarea>';
								}
							else
								{
									$html .= '<input placeholder="'.ucfirst($properties).'" type="text" name="sections_data['.$key.']['.$properties.']" value="'.htmlentities($values).'" /><br />';	
								}
								
							
							$html .= '</p>';
							
						}
					
					$html .= '<div class="section-entry section-entry-'.$key.'">';
					$html .= '<div class="entry-list entry-list-'.$key.' ">';
					
/////////////////////////////////////////
					if(!empty($sections_data[$key]['entries']))
						{
							$sections_data_entries =  $sections_data[$key]['entries'];
						}
					else
						{
							$sections_data_entries =  array();
						}
					
					
					if(empty($sections_data_entries))
						{
							$sections_data_entries = array();
						}
					
					
					
					foreach($sections_data_entries as $entry_key=>$entries)
						{
							$html .= '<div class="entry">';
							
							$html .= '<span class="remove">X</span>';
							

									
							foreach($sections_entries_args[$key] as $args_key)
								{
									
									if($args_key == 'details')
										{
										$html .= '<textarea placeholder="'.ucfirst($args_key).'" name="sections_data['.$key.'][entries]['.$entry_key.']['.$args_key.']">'.htmlentities($sections_data_entries[$entry_key][$args_key]).'</textarea>';
										
										
										}
									else
										{
										$html .= '<input type="text" placeholder="'.ucfirst($args_key).'" name="sections_data['.$key.'][entries]['.$entry_key.']['.$args_key.']" value="'.htmlentities($sections_data_entries[$entry_key][$args_key]).'" /><br />';
										}
									
									
									
									
										

								}

							
							


							$html .= '</div>';
							
						}
					

//////////////////////////////////////////////



					$html .= '</div>';
					
					$html .= '<div section_id="'.$key.'" class="add-new button">Add New '.ucfirst($name).'</div>';	
					$html .= '</div>';
					
					
										
					$html .= '</div>';									
					$html .= '</div>';

							
						}
						
						
						
					return $html;
					
					
					}
									
					
	public function ResumesBuilder_html()
				{
					global $post;
									
					$html = '';
					$html .= '<div class="resumes-builder">';	
					$html .= '<div id="canvas" class="canvas" >';	

					$html .= '<div class="items-container sortable" >';	
					$html .= $this->ResumesBuilder_settings();
					$html .= '</div></div>';
					
					$html .= '</div>';						
									
									
					return $html;
				}
					
		
		
	public function get_resumes_sections($resume_id, $section)
				{
					
					$sections = $this->sections;
					$sections_properies = $this->sections_properies;
					$sections_entries_args = $this->sections_entries_args;	
					
					$sections_data = (array)$this->post_meta($resume_id, 'sections_data');
					//var_dump($sections_data);
					$html = '';
					$html .= '<div class="section '.$section.'">';
					$html .= '<div class="section-inner">';					
					
					foreach($sections_properies as $key)
						{
							

							$html .= '<div class="section-'.$key.'">'.$sections_data[$section][$key].'</div>';
								
							
							
								
						}
				
					
					$entries = $sections_data[$section]['entries'];
					$sections_entries_args = $sections_entries_args[$section];
					
					
					foreach($entries as $values)
						{

									$html .= '<div class="entry">';	
									foreach($sections_entries_args as $key)
										{
											$html .= '<div class="entry-'.$key.'">'.$values[$key].'</div>';
										}
		
									$html .= '</div>';	
								
								
						}
					$html .= '</div>';
					$html .= '</div>';					
					
					return $html;
				
				}	
		
	public function get_resumes_section_entry($resume_id, $section)
				{
					$sections = $this->sections;
					$sections_properies = $this->sections_properies;
					$sections_entries_args = $this->sections_entries_args;	
					
					$sections_data = (array)$this->post_meta($resume_id, 'sections_data');	



					$entries = $sections_data[$section]['entries'];
					$sections_entries_args = $sections_entries_args[$section];
					$html = '';
					foreach($entries as $values)
						{

							$html .= '<div class="entry">';	
							foreach($sections_entries_args as $key)
								{
									$html .= '<div class="entry-'.$key.'">'.$values[$key].'</div>';
								}

							$html .= '</div>';	
								
								
						}	
					return $html;
				
				}
				
				
				
				
				
				
				
				
		
	public function get_resumes_header($resume_id, $header)
				{

					
					$sections_data = (array)$this->post_meta($resume_id, 'sections_data');
					
					foreach($header as $key)	
						{
							if($key=='thumbnail')
								{
									//$html .= '<div class="entry">';	
									$html .= '<div class="resumes-'.$key.'"><img src="'.$sections_data[$key].'"/></div>';
									//$html .= '</div>';	
								}
							else
								{
									//$html .= '<div class="entry">';	
									$html .= '<div class="resumes-'.$key.'">'.$sections_data[$key].'</div>';
									//$html .= '</div>';	
								}
							

						}
							
								
				
						
				return $html;
				
				}	
		
		
		
		
		
		
		
							
									
	}
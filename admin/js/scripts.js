jQuery(document).ready(function($)
	{




		$(document).on('click', '.resumes-builder .entry .remove', function()
			{
				$(this).parent().remove();

				
			})






		$(document).on('click', '.resumes-builder .canvas .header', function()
			{
				
				if($(this).parent().hasClass('active'))
					{
						$(this).parent().removeClass('active');
					}
				else
					{
						$(this).parent().addClass('active');
					}
				
			})


		$(document).on('click', '.resumes-builder .canvas .add-new', function()
			{
				var section_id = $(this).attr('section_id');
				
				var entry_count = $.now();				
				
				$(this).html('Wait...');
				
				//alert('Hello');
				
				$.ajax(
					{
				type: 'POST',
				url:resumes_builder_ajax.resumes_builder_ajaxurl,
				data: {"action": "resumes_builder_add_entry_ajax", "section_id":section_id,"entry_count":entry_count,},
				success: function(data)
						{	
						
							$('.entry-list-'+section_id).append(data);
							$('.section-entry-'+section_id+' .add-new').html('Add New');
	
	
						
						}
					});				
			})











	});	








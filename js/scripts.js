jQuery(document).ready(function($)
	{


		$(document).on('click', '.doc-buy', function()
			{	
				
				
				if($(this).hasClass('down'))
					{
						$(this).css('height','100px');
						$(this).removeClass('down');
					}
				else
					{
						$(this).css('height','10px');
						$(this).addClass('down');
					}
				
				
				
			})




		$(document).on('keyup', '#documentation_metabox .section-panel input', function()
			{
				var text = $(this).val();
				
				if(text == '')
					{
						$(this).parent().parent().children('.section-header').children('.documentation-title-preview').html('start typing');
					}
				else
					{
						$(this).parent().parent().children('.section-header').children('.documentation-title-preview').html(text);
					}
				
				
			
			})






		$(document).on('click', '#documentation_metabox .section-header', function()
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





		

		$(document).on('click', '.documentation-content-buttons .add-documentation', function()
			{	

				
				var section_id = $.now();
				
				
				
				$.ajax(
					{
				type: 'POST',
				url:documentation_plus_ajax.documentation_plus_ajaxurl,
				data: {"action": "documentation_plus_add_section", "section_id":section_id},
				success: function(data)
						{	
					
							//alert(section_id);
							$(".documentation-content").append(data);



					
					}
				});
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				setTimeout(function(){
					
					$(".documentation-content tr:last-child td").removeClass("tab-new");
					
					}, 300);
				
				
				
			})	
		
		
		
		$(document).on('click', '#documentation_metabox .removedocumentation', function()
			{	
				
				if (confirm('Do you really want to delete this section ?')) {
					
					$(this).parent().parent().parent().remove();
				}
				
				
				
			})	
	
 		

	});
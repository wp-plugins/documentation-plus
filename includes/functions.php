<?php



function documentation_plus_archive($atts, $content = null )

	{
		$atts = shortcode_atts(
			array(
				'title_icon' => '<i class="fa fa-file-text-o"></i> ',
				'list_icon' => '<i class="fa fa-dot-circle-o"></i> ',
				'section_display' => 'yes',
				'posts_per_page' => 5,							
								

				), $atts);	
		
		$title_icon = $atts['title_icon'];
		$list_icon = $atts['list_icon'];
		$section_display = $atts['section_display'];	
		$posts_per_page = $atts['posts_per_page'];					
		
		
		if ( get_query_var('paged') ) {
		
			$paged = get_query_var('paged');
		
		} elseif ( get_query_var('page') ) {
		
			$paged = get_query_var('page');
		
		} else {
		
			$paged = 1;
		
		}
		
		
		
		global $wp_query;
		
		$wp_query = new WP_Query(
			array (
				'post_type' => 'documentation',
				'orderby' => 'date',
				'order' => 'ASC',
				'posts_per_page' => $posts_per_page,
				'paged' => $paged,
				
				) );
		
		$html = '';
		
		$html .= '<div class="documentation-archive">';	
			
		if ( $wp_query->have_posts() ) :
			while ( $wp_query->have_posts() ) : $wp_query->the_post();	
			
			$html.= '<div class="single">';
			
			$html.= '<div class="thumb">'.get_the_post_thumbnail(get_the_ID(),'large').'</div>';			
			$html.= '<div class="title"><a href="'.get_permalink().'">'.$title_icon.get_the_title().'</a></div>';			
			
			$documentation_plus = get_post_meta( get_the_ID(), 'documentation_plus', true );
			
			if(empty($documentation_plus['section_title']))
				{
					$documentation_section_title = array('0'=>'');
				}
			else
				{
					$documentation_section_title = $documentation_plus['section_title'];
				}
				
			if($section_display == 'yes')
				{
					$html.= '<ul>';
					foreach($documentation_section_title as $index=> $section_title)
						{
			
							$html .= '<li href="#'.$index.'"><a href="'.get_permalink().'#'.$index.'">'.$list_icon.$section_title.'</a></li>';
			
						}
					$html.= '</ul>';
				}
				
				

			
			
			$html .= '</div>';			
			
			endwhile;
			
			
			$html .= '<div class="paginate">';
			$big = 999999999; // need an unlikely integer
			$html .= paginate_links( array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'current' => max( 1, $paged ),
				'total' => $wp_query->max_num_pages
				) );
		
			$html .= '</div >';
			
			
			
			
			
		wp_reset_query();
		
		endif;	
		$html .= '</div>';
		
		return $html;
		
		
	}
add_shortcode('documentation_plus_archive', 'documentation_plus_archive');





function documentation_plus_html($post_id)

	{
		
		$documentation_plus = get_post_meta( $post_id, 'documentation_plus', true );	

		//var_dump($documentation_plus);
		if(!empty($documentation_plus['section_title']))
			{
				$documentation_section_title = $documentation_plus['section_title'];
			}
		else
			{
				$documentation_section_title = array('0'=>'');
			}
		
		
					
		//$documentation_section_title = get_post_meta( $post_id, 'documentation_section_title', true );
		//$documentation_section_body = get_post_meta( $post_id, 'documentation_section_body', true );
		
		//$documentation_section_hide = get_post_meta( $post_id, 'documentation_section_hide', true );			
	
	
	
		$html = '';
		$html .= '<div class="documentation">';
		$html .= '<div class="doc-sidebar">';
		foreach($documentation_section_title as $index=> $section_title)
			{

				$html .= '<a href="#'.$index.'" class="side-title">'.$section_title.'</a>';

			}
		$html .= '</div>';		
		
		
		$html .= '<div class="doc-sections">';
		
		foreach($documentation_section_title as $index=> $section_title)
			{
				$html .= '<div class="doc-section">';
				$html .= '<div id="'.$index.'" class="doc-title">'.$section_title.'</div>';
				$html .= '<div class="doc-content">'.wpautop(do_shortcode($documentation_plus['section_content'][$index])).'</div>';				
				$html .= '</div>';
			}
		$html .= '</div>';
		$html .= '</div>';
		
			
		
		return $html;
	
	
	}










function documentation_plus_add_section()
	{
		$section_id = $_POST['section_id'];		
		
		echo '<tr index="'.$section_id.'" valign="top"><td class="section-dragHandle">*</td><td class="tab-new" style="vertical-align:middle;">
		
                        <div class="section-header">
                        	<div class="documentation-title-preview">';

						   echo  '</div>';
							
                        echo '<span class="removedocumentation">X</span>';
                        
                        echo '<label class="switch" title="Hide on Frontend"><input  type="checkbox" name="documentation_plus[section_hide]['.$section_id.']" value="1" /> </label>
                        </div>
                        <div class="section-panel">
                        <input width="100%" placeholder="documentation Header" type="text" name="documentation_plus[section_title]['.$section_id.']" value="" />';



						wp_editor( '', "section_content".$section_id, $settings = array("textarea_name"=>"documentation_plus[section_content][".$section_id."]") );



		
		
		
		echo '</td></tr>';
		

		
		die();
		
		
	}

add_action('wp_ajax_documentation_plus_add_section', 'documentation_plus_add_section');
add_action('wp_ajax_nopriv_documentation_plus_add_section', 'documentation_plus_add_section');











	
	
	
	function documentation_plus_share_plugin()
		{
			
			?>
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Fdocumentation-plus&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo documentation_plus_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo documentation_plus_share_url; ?>" data-text="<?php echo documentation_plus_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}
	
	
	
	
	
	
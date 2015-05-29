<?php


function documentation_posttype_register() {
 
        $labels = array(
                'name' => _x('Documentation', 'documentation'),
                'singular_name' => _x('Documentation', 'documentation'),
                'add_new' => _x('New Documentation', 'documentation'),
                'add_new_item' => __('New Documentation'),
                'edit_item' => __('Edit Documentation'),
                'new_item' => __('New Documentation'),
                'view_item' => __('View Documentation'),
                'search_items' => __('Search Documentation'),
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
                'supports' => array('title','thumbnail'),
				'menu_icon' => 'dashicons-media-spreadsheet',
				
          );
 
        register_post_type( 'documentation' , $args );

}

add_action('init', 'documentation_posttype_register');





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_documentation()
	{
		$screens = array( 'documentation' );
		foreach ( $screens as $screen )
			{
				add_meta_box('documentation_metabox',__( 'Documentation Options','documentation' ),'meta_boxes_documentation_input', $screen);
			}
	}
add_action( 'add_meta_boxes', 'meta_boxes_documentation' );


function meta_boxes_documentation_input( $post ) {
	
	global $post;
	wp_nonce_field( 'meta_boxes_documentation_input', 'meta_boxes_documentation_input_nonce' );
	
	$documentation_plus = get_post_meta( $post->ID, 'documentation_plus', true );	
	
	
	
	if(!empty($documentation_plus['section_title']))
		{
			$documentation_section_title = $documentation_plus['section_title'];
		}
	else
		{
			$documentation_section_title = array(time()=>'');
		}
	
	//var_dump($documentation_section_title);
	
	//$documentation_section_title = get_post_meta( $post->ID, 'documentation_section_title', true );	
	//$documentation_section_body = get_post_meta( $post->ID, 'documentation_section_body', true );
	
	//$documentation_section_hide = get_post_meta( $post->ID, 'documentation_section_hide', true );	
	
	//$documentation_section_title = $documentation_plus['section_title'];
	

		

	
	//$documentation_section_body = $documentation_plus['section_content'];
	//$documentation_section_hide = $documentation_plus['section_hide'];
?>




    <div class="para-settings">

        <div class="option-box">
            <p class="option-title">Shortcode</p>
            <p class="option-info">Copy this shortcode and paste on page or post where you want to display documentation, Use PHP code to your themes file to display documentation.</p>
        <br /> 
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[documentation_plus <?php echo ' id="'.$post->ID.'"';?> ]</textarea>
        <br />
        PHP Code:<br />
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[documentation_plus id='; echo "'".$post->ID."' ]"; echo '"); ?>'; ?></textarea>  
        
        </div>
        
        
        <ul class="tab-nav">
      
            <li nav="1" class="nav1 active">Content</li>
            
        </ul> <!-- tab-nav end -->
        
		<ul class="box">

            <li style="display: block;" class="box1 tab-box active ">
				<div class="option-box">
                    <p class="option-title">Product Link(Buy Link)</p>
                    <p class="option-info">URL to your orginal prduct link(buy link)</p>
                    
                    <input  type="text" placeholder="url" name="documentation_plus[buy_link]" value="<?php if(!empty($documentation_plus['buy_link'])) echo $documentation_plus['buy_link']; ?>"  />
                    
               	</div>
            
				<div class="option-box">
                    <p class="option-title">Content</p>
                    <p class="option-info"></p>
                    
                    <div class="documentation-content-buttons" >
                        <div class="button add-documentation">Add</div>
                        <br />
                    </div>
                <table width="100%" class="documentation-content" id="documentation-content">
                
                <?php

				foreach ($documentation_section_title as $index => $documentation_title)
					{
						
					?>
                    <tr index='<?php echo $index; ?>' valign="top">
                    
                    	<td class="section-dragHandle">*</td>
                    
                        <td style="vertical-align:middle;">
                        <div class="section-header">
                        	<div class="documentation-title-preview">
                            <?php if(!empty($documentation_title)) echo $documentation_title; ?>
                            </div>
							
                        <span class="removedocumentation">X</span>
                        
                        <?php
                        
							if(!empty($documentation_plus['section_hide'][$index]))
								{
									$checked = 'checked';
								}
							else
								{
									$checked = '';
								}
						
						
						?>
                        
                        <label class="switch" title="Hide on Frontend"><input  type="checkbox" name="documentation_plus[section_hide][<?php echo $index; ?>]" value="1" <?php echo $checked; ?> /> </label>
                        </div>
                        <div class="section-panel">
                        <input width="100%" placeholder="documentation Header" type="text" name="documentation_plus[section_title][<?php echo $index; ?>]" value="<?php if(!empty($documentation_title)) echo htmlentities($documentation_title); ?>" />

                        
                        
<?php
if(!empty($documentation_plus['section_content'][$index]))
	{
		wp_editor( stripslashes($documentation_plus['section_content'][$index]), 'section_content'.$index, $settings = array('textarea_name'=>'documentation_plus[section_content]['.$index.']') );
	}
else
	{
		wp_editor( '', 'section_content'.$index, $settings = array('textarea_name'=>'documentation_plus[section_content]['.$index.']') );
	}

	


?>
                        </div>


                        
                        
                        
                        
                        
                        
                        
                        
                        </td>           
                    </tr>
                    <?php
					
					
					}
				
				?>

                     
                 </table>



<script>

	jQuery(document).ready(function() {

		// Initialise the table
		jQuery("#documentation-content").tableDnD({
			
			dragHandle: "section-dragHandle",
			});

	});

</script>














                </div>  
            </li>
        
        </ul>
        


    </div> <!-- para-settings -->



<?php


	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function meta_boxes_documentation_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['meta_boxes_documentation_input_nonce'] ) )
    return $post_id;

  $nonce = $_POST['meta_boxes_documentation_input_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'meta_boxes_documentation_input' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;



  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
	   
	  
 	
	
	$documentation_plus = stripslashes_deep( $_POST['documentation_plus'] );	
	//$documentation_section_body = stripslashes_deep( $_POST['documentation_section_body'] );		
	
	//$documentation_section_hide = stripslashes_deep( $_POST['documentation_section_hide'] );	
	
			


  // Update the meta field in the database.


	
	update_post_meta( $post_id, 'documentation_plus', $documentation_plus );
	//update_post_meta( $post_id, 'documentation_section_body', $documentation_section_body );	
	
	//update_post_meta( $post_id, 'documentation_section_hide', $documentation_section_hide );





}
add_action( 'save_post', 'meta_boxes_documentation_save' );


























?>
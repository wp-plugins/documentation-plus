<div class="wrap">
	<?php echo "<h2>".__(documentation_plus_plugin_name.' Help')."</h2>";
	
    $documentation_plus_customer_type = get_option('documentation_plus_customer_type');
    $documentation_plus_version = get_option('documentation_plus_version');
	
	
	?>
    <br />



    <div class="para-settings">
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Help & Support</li>
        </ul> <!-- tab-nav end -->  
        
		<ul class="box">
        
            <li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
                    <p class="option-title">Need Help ?</p>
                    <p class="option-info">Feel free to contact with any issue for this plugin, Ask any question via forum <a href="<?php echo documentation_plus_qa_url; ?>"><?php echo documentation_plus_qa_url; ?></a> <strong style="color:#139b50;">(free)</strong><br />

    <?php

    if($documentation_plus_customer_type=="free")
        {
    
            echo 'You are using <strong> '.$documentation_plus_customer_type.' version  '.$documentation_plus_version.'</strong> of <strong>'.documentation_plus_plugin_name.'</strong>, To get more feature you could try our premium version. ';
            
            echo '<br /><a href="'.documentation_plus_pro_url.'">'.documentation_plus_pro_url.'</a>';
            
        }
    else
        {
    
            echo 'Thanks for using <strong> premium version  '.$documentation_plus_version.'</strong> of <strong>'.documentation_plus_plugin_name.'</strong> ';	
            
            
        }
    
     ?>       

                    
                    </p>

                </div>
                
                
				<div class="option-box">
                    <p class="option-title">Submit Reviews...</p>
                    <p class="option-info">We are working hard to build some awesome plugins for you and spend thousand hour for plugins. we wish your three(3) minute by submitting five star reviews at wordpress.org. if you have any issue please submit at forum.</p>
                	<img class="documentation_plus-pro-pricing" src="<?php echo documentation_plus_plugin_url."css/five-star.png";?>" /><br />
                    <a target="_blank" href="<?php echo documentation_plus_wp_reviews; ?>">
                		<?php echo documentation_plus_wp_reviews; ?>
               		</a>
                    
                    
                    
                </div>
                
				<div class="option-box">
                    <p class="option-title">Please Share</p>
                    <p class="option-info">If you like this plugin please share with your social share network.</p>
                    <?php
                    
						echo documentation_plus_share_plugin();
					?>
                </div>
                
<!-- 

				<div class="option-box">
                    <p class="option-title">Video Tutorial</p>
                    <p class="option-info">Please watch this video tutorial.</p>
                	<iframe width="640" height="480" src="<?php echo documentation_plus_tutorial_video_url; ?>" frameborder="0" allowfullscreen></iframe>
                </div>


-->
               

               
               
               
               
               
               
                
                
            </li>        
        
        
    
    </div>

        
</div> <!-- wrap end -->
<div id="sidebar">
		<aside class="widget">
			<h3><?php the_category('、') ?>下的最新文章</h3>
			<?php
    			if(is_single()){
    	        	$cats = get_the_category();
    	    	}
    	       	foreach($cats as $cat){
    	        	$posts = get_posts(array(
        	        	'category' => $cat->cat_ID,
            	       	'exclude' => $post->ID,
                	   	'showposts' => 6,
             		));
				echo '<ul>';
				foreach($posts as $post){
					echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
        	    }
				echo '</ul>';
	        	}
			?>
		</aside>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Single') ) : ?>
	<?php endif; ?>
</div>
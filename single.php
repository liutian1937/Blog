<?php get_header(); ?>
	<div id="main">
    	<div class="position">
		当前位置：<?php the_breadcrumb(); ?>
		</div>
        <div id="content">
    		
		<?php while ( have_posts() ) : the_post(); ?>
        	<article class="post">
				<h1><?php the_title(); ?></h1>
                <div class="info" id="post-meta"><span>作者：<?php the_author(); ?></span>|<time datatime="<?php the_time('Y-m-d'); ?>" pubdate>时间：<?php the_time('Y-m-d'); ?></time>|<span>分类目录：<?php the_category('、') ?></span>|<span>Tag标签：<?php the_tags(__(' '), '、'); ?></span>|<span>阅读（<?php if(function_exists('the_views')) { the_views(); } ?>）</span></div>
			<span class="comment"><?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?></span>
            <div id="post-content"><?php the_content(); ?></div>
            
             <section id="related-article">
					<h2>相关文章</h2>
						<ul>
		<?php
        $post_tags = wp_get_post_tags($post->ID);
		if ($post_tags) {
			$tag_list = '';
			foreach ($post_tags as $tag)
			{
				// 获取标签列表
				$tag_list .= $tag->term_id.',';
				}
			$tag_list = substr($tag_list, 0, strlen($tag_list)-1);
			$related_posts = $wpdb->get_results("
                SELECT post_title, ID
				FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
				WHERE {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
				AND ID = object_id
				AND taxonomy = 'post_tag'
				AND post_status = 'publish'
				AND post_type = 'post'
				AND term_id IN (" . $tag_list . ")
				AND ID != '" . $post->ID . "'
				ORDER BY RAND()
				LIMIT 6");
		if ( $related_posts ) {
			foreach ($related_posts as $related_post) {
?>
    <li><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><?php echo $related_post->post_title; ?></a></li>
<?php  } } else { ?>
    <li>暂无相关文章</li>
<?php } } ?><div class="clear"></div>
</ul>
					
				</section>
            
            <address id="copyright">
            <p>作者：痞子</p>
            <p>本文地址：<?php the_permalink() ?></p>
            <p>转载请注明：<a href="http://www.niumowang.org/" title="专注于web前端开发以及强大的用户体验设计">牛魔王的世界观</a> » <a href=<?php the_permalink() ?> title=<?php the_title(); ?>><?php the_title(); ?></a></p></address>
            
           
		
              </article>
            	
                <span id="post-pre">上一篇：<?php previous_post_link('%link') ?></span>
                <span id="post-next">下一篇：<?php next_post_link('%link') ?></span>
		<?php endwhile; ?>
       <?php comments_template(); ?>
	</div>
	<?php get_sidebar('single'); ?></div>
<?php get_footer(); ?>
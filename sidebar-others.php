<div id="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Others') ) : ?>
		<aside class="widget">
			<h3><?php _e("Random Posts"); ?></h3>
			<ul>
    			<?php $rand_posts = get_posts('numberposts=10&orderby=rand');  foreach( $rand_posts as $post ) : ?>
    			<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 42, '...'); ?></a></li>
    			<?php endforeach; ?>
			</ul>
		</aside>
		<?php wp_list_bookmarks('title_before=<h3>&title_after=</h3>&category_before=<aside id=%id class="linkcat widget">&category_after=</aside>'); ?>
	<?php endif; ?>
</div>
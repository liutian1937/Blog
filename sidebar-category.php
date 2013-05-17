<div id="sidebar">
	<aside class="widget widget_text">
				<h3><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h3>
				<?php echo category_description( $category_id ); ?>
	</aside>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Category') ) : ?>
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
<?php get_header(); ?>
	<div id="main">
    	<div class="position">
		当前位置：<?php the_breadcrumb(); ?>
		</div>
        <div id="content">
		<?php while ( have_posts() ) : the_post(); ?>
        <article class="post">
				<h1><?php the_title(); ?></h1>
				<div class="content"><?php the_content(); ?></div>
		</article>
		<?php endwhile; ?>
		
		<?php comments_template(); ?></div>
        
	<?php get_sidebar('others'); ?></div>
<?php get_footer(); ?>
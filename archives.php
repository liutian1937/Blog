<?php
/*
Template Name: archives
*/
?>
<?php get_header(); ?>
	<div id="main">
    	<div class="position">
		当前位置：<?php the_breadcrumb(); ?>
		</div>
        <section id="content">
				<h1 class="title"><?php the_title(); ?></h1>
				<div class="content"><?php the_content(); ?><a id="expand_collapse" href="javascript:void(0);">全部展开/收缩</a>
<div id="archives"><?php archives_list_SHe(); ?></div>
			</section>
	<?php get_sidebar('others'); ?></div>
<?php get_footer(); ?>
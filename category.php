<?php get_header(); ?>
	<div id="main">
    	<div class="position">
		当前位置：<?php the_breadcrumb(); ?>
		</div>
    
		<section id="content">
        	<h1 class="title">Category Archives:<a href="<?php echo get_category_link(the_category_ID(false));?>"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></a></h1>
            <?php while ( have_posts() ) : the_post(); ?>
            <article class="post">
			<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="content">
				<?php if (has_post_thumbnail()) { ?>
							<div class="thumbnail"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a></div>
						<?php } ?>
				<?php if (is_single() or is_page()) {the_content();} else {the_content();}?></div>
			<div class="info"><span>作者：<?php the_author(); ?></span>|<time datatime="<?php the_time('Y-m-d'); ?>" pubdate>时间：<?php the_time('Y-m-d'); ?></time>|<span>分类目录：<?php the_category('、') ?></span>|<span>Tag标签：<?php the_tags(__(' '), '、'); ?></span>|<span>阅读（<?php if(function_exists('the_views')) { the_views(); } ?>）</span></div>
			<span class="comment"><?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?></span>
		</article>
        <?php endwhile; ?>
        <div id="page_navi"><?php par_pagenavi(9);?></div>
        </section>
	<?php get_sidebar('category'); ?></div>
<?php get_footer(); ?>
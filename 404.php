<?php get_header(); ?>
	<section id="nofound">
		<h1>404错误，您要找的页面没有找到！</h1>
        <br/>
        <p>您可以<a href="http://www.niumowang.org/" title="牛魔王的世界观，专注于web前端开发以及强大的用户体验设计！">返回首页</a>，或者搜索您要找的内容</p>
		<div class="search">
			<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="30" />
				<button type="submit"><?php _e("Search"); ?></button>
			</form>
           
		</div>
	</section>
<?php get_footer(); ?>
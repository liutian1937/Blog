<!DOCTYPE html>
<html lang="zh-CN">
<head profile="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<title><?php if (is_home () ) {echo"关注web前沿,前端开发技术_";bloginfo('name');} elseif ( is_category() ) { single_cat_title();
	echo "_";bloginfo('name'); } elseif (is_single() || is_page() ) {single_post_title(); echo "_"; bloginfo('name'); }
	elseif (is_search() ) {echo "search results:"; echo wp_specialchars($s);echo "_"; bloginfo('name'); }
	else {wp_title('',true);echo "_"; bloginfo('name'); } ?></title>
<meta name="description" content="<?php if (is_home()){echo "牛魔王的世界观，关注前端资讯，分析用户行为，专注于web前端开发以及强大的用户体验设计！";}elseif (is_category()){echo trim(strip_tags(category_description($cat_ID)));}elseif (is_tag()){echo single_tag_title( '', false );echo "标签 - 牛魔王的世界观，专注web前端开发tag标签页面。"; }elseif(is_single()){echo single_post_title();echo "文章页面，所属分类：";$category = get_the_category(); echo $category[0]->cat_name;}elseif(is_page()){echo single_post_title();echo " - 牛魔王的世界观，专注web前端开发单页介绍页面。";}?>" />
<?php if (is_home()){?>
<meta name="keywords" content="web,html,css,前端开发,javascript,jquery,seo,php,用户体验设计" /><?PHP }?>
<link rel="shortcut icon" href="http://www.niumowang.org/favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body>
<header id="top-header">
<?PHP  if(is_home()) {?><hgroup id="header-info">
			<h1><a href="http://www.niumowang.org/" id="logo" title="关注web前沿,前端开发技术">牛魔王的世界观</a></h1>
			<h2>专注于web前端开发以及强大的用户体验设计！</h2>
		</hgroup>
<?PHP } else{?>
<div id="header-info"><a href="http://www.niumowang.org/" id="logo" title="关注web前沿,前端开发技术">牛魔王的世界观</a>
<h2>专注于web前端开发以及强大的用户体验设计！</h2></div>
<?PHP }?>

		<nav id="nav">
				<?php wp_nav_menu( array('menu' => 'header-menu', 'menu_class' => 'menu' )); ?>
		</nav>
		<div id="search">
            <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" size="30" x-webkit-speech />
				<button type="submit"><?php _e("Search"); ?></button>
			</form>
		</div>
</header>
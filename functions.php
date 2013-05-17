<?php

function scp_comment_post( $incoming_comment ) {
    $pattern = '/[一-龥]/u';
    // 禁止全英文评论
    if(!preg_match($pattern, $incoming_comment['comment_content'])) {
        wp_die( "You should type some Chinese word (like \"你好\") in your comment to pass the spam-check, thanks for your patience! 您的评论中必须包含汉字!" );
    }
    return( $incoming_comment );
}

add_filter('preprocess_comment', 'scp_comment_post');
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar Index',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

register_sidebar(array(
			'name' => 'Sidebar Category',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

register_sidebar(array(
			'name' => 'Sidebar Single',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

register_sidebar(array(
			'name' => 'Sidebar Others',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

}


register_nav_menus(
		array(
			'header-menu' => __( 'header-menu' )
		)

);



if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
		/*set_post_thumbnail_size( 642, 407, true );*/
}

class widget_test extends WP_Widget {
    function widget_test() {
        $widget_ops = array('description' => '随机日志与最新评论二合一');
        $this->WP_Widget('widget_test', '痞子二合一工具', $widget_ops);
    }

function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', esc_attr($instance['title']));
        $limit = strip_tags($instance['limit']);
		$type = esc_attr($instance['type']);
        echo $before_widget.$before_title.$title.$after_title;
		switch($type) {
			case 'rank':
			echo '<ul>'."\n";
			get_random_posts($limit);	
			echo '</ul>'."\n";
			break;
			case 'comments':
			echo '<ol>'."\n";
			post_limit($limit);
			echo '</ol>'."\n";				
			break;
		}
        echo $after_widget;
 }

function update($new_instance, $old_instance) {
        if (!isset($new_instance['submit'])) {
            return false;
        }
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['limit'] = strip_tags($new_instance['limit']);
	$instance['type'] = strip_tags($new_instance['type']);
        return $instance;
    }

    function form($instance) {
        global $wpdb;
        $instance = wp_parse_args((array) $instance, array('title' => '', 'limit' => '','type'=>''));
        $title = esc_attr($instance['title']);
        $limit = strip_tags($instance['limit']);
	$type = esc_attr($instance['type']);
?>

<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">标题：
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('type'); ?>">分类法：</label>
  <select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
    <option value="rank" <?php selected('rank', $type); ?>>随机日志</option>
    <option value="comments" <?php selected('comments', $type); ?>>最新评论</option>
  </select>
</p>
<p>
  <label for="<?php echo $this->get_field_id('limit'); ?>">数量：
  <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" />
  </label>
</p>
<input type="hidden" id="<?php echo $this->get_field_id('submit'); ?>" name="<?php echo $this->get_field_name('submit'); ?>" value="1" />
<?php

    }

}

add_action('widgets_init', 'widget_test_init');

function widget_test_init() {
    register_widget('widget_test');
}

function get_random_posts($limit){
	$random_posts = get_posts('numberposts=5&orderby=rand');
	foreach ( $random_posts as $post ) {
		$thepost = get_post( $post->ID );
		$random .=  "<li><a href=".get_permalink($thepost->ID)." title='".esc_attr(get_the_title($thepost->ID))."'>".get_the_title($thepost->ID)."</a></li>";
    }
	echo $random;
}

function post_limit($limit){
global $wpdb;

$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_content AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND comment_author != '痞子' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";

$comments = $wpdb->get_results($sql);
foreach ($comments as $comment) {
$output .= "\n<li><a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"" .$comment->post_title ."\">".$comment->post_title ."</a><p>".mb_strimwidth(strip_tags($comment->com_excerpt),0,50)."</p><span>--".$comment->comment_author."</span></li>";
}

$output = convert_smilies($output);
echo $output;
}



if ( ! function_exists( 'prower_comment' ) ) :

function prower_comment( $comment, $args, $depth ) {
load_theme_textdomain( 'prower', TEMPLATEPATH . '/languages' );
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
<p><?php _e( 'Pingback:', 'prower' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'prower' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
			break;

		default :

	?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>" class="comment-body">
  <div class="comment-author vcard">
    <?php

						$avatar_size = 30;

						if ( '0' != $comment->comment_parent )

							$avatar_size = 30;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */

						printf( __( '%1$s </div><div class="comment-meta commentmetadata"><span>%4$s</span>', 'prower' ),

							sprintf( '<span class="fn" id="reviewer-'.$comment->comment_ID.'">%s</span>', get_comment_author_link() ),

								esc_url( get_comment_link( $comment->comment_ID ) ),

								get_comment_time( 'c' ),

							/* translators: 1: date, 2: time */

								sprintf( __( '%1$s at %2$s', 'prower' ), get_comment_date(), get_comment_time() )

							)



					?>
    <?php edit_comment_link( __( 'Edit', 'prower' ) ); ?>
  </div>
  <?php if ( $comment->comment_approved == '0' ) : ?>
  <div class="comment-awaiting-moderation">
    <?php _e( 'Your comment is awaiting moderation.', 'prower' ); ?>
  </div>
  <?php endif; ?>
  <?php comment_text(); ?>
  <div class="reply">
    <?php if ($depth == get_option('thread_comments_depth')) : ?>
    <!-- 评论深度等于设置的最大深度 -->
    <!-- 将第二个参数改为父一级评论的id -->
    <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php echo $comment->comment_parent; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' );" href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
    <?php else: ?>
    <!-- 正常情况 -->
    <a onclick="return addComment.moveForm( 'comment-<?php comment_ID() ?>','<?php comment_ID() ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' );" href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
    <?php endif; ?>
  </div>
  <!-- .reply -->
  <?php
			break;

	endswitch;

}


endif; 







function my_avatar($avatar) {

$tmp = strpos($avatar, 'http');

$g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);

$tmp = strpos($g, 'avatar/') + 7;

$f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);

$w = get_bloginfo('wpurl');

$e = ABSPATH .'avatar/'. $f .'.jpg';

$t = 2592000; //偶改为30天, 单位:秒

if ( !is_file($e) || (time() - filemtime($e)) > $t ) { //當头像不存在或文件超过30天才更新

copy(htmlspecialchars_decode($g), $e);

} else $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.jpg'));

if ( filesize($e) < 500 ) copy($w.'/avatar/default.jpg', $e);

return $avatar;

}

add_filter('get_avatar', 'my_avatar');







/* comment_mail_notify v1.0 by willin kan. (所有回覆都發郵件) */



function comment_mail_notify($comment_id) {



  $comment = get_comment($comment_id);

  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';

  $spam_confirmed = $comment->comment_approved;

  if (($parent_id != '') && ($spam_confirmed != 'spam')) {

    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.

    $to = trim(get_comment($parent_id)->comment_author_email);

    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回应';

    $message = '

    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">

      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>

      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'

       . trim(get_comment($parent_id)->comment_content) . '</p>

      <p>' . trim($comment->comment_author) . ' 给您的回复:<br />'

       . trim($comment->comment_content) . '<br /></p>

      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看完整回复內容</a></p>

      <p>欢迎再度光临<a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>

      <p>(此邮件由系统发出，请勿回复.)</p>

    </div>';



    $from = "From: \"" . get_option('blogname') . "\" < $wp_email>";



    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";



    wp_mail( $to, $subject, $message, $headers );



    //echo 'mail to ', $to, '<br /> ' , $subject, $message; // for testing



  }



}



add_action('comment_post', 'comment_mail_notify');



// -- END ----------------------------------------







function archives_list_SHe() {



     global $wpdb,$month;



     $lastpost = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC LIMIT 1");



     $output = get_option('SHe_archives_'.$lastpost);



     if(empty($output)){



         $output = '';



         $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE 'SHe_archives_%'");



         $q = "SELECT DISTINCT YEAR(post_date) AS year, MONTH(post_date) AS month, count(ID) as posts FROM $wpdb->posts p WHERE post_date <'" . current_time('mysql') . "' AND post_status='publish' AND post_type='post' AND post_password='' GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";



         $monthresults = $wpdb->get_results($q);



         if ($monthresults) {



             foreach ($monthresults as $monthresult) {



             $thismonth    = zeroise($monthresult->month, 2);



             $thisyear    = $monthresult->year;



             $q = "SELECT ID, post_date, post_title, comment_count FROM $wpdb->posts p WHERE post_date LIKE '$thisyear-$thismonth-%' AND post_date AND post_status='publish' AND post_type='post' AND post_password='' ORDER BY post_date DESC";



             $postresults = $wpdb->get_results($q);



             if ($postresults) {



                 $text = sprintf('%d年 %s', $monthresult->year,$month[zeroise($monthresult->month,2)]);



                 $postcount = count($postresults);



                 $output .= '<article class="archives-list"><h2 class="archives-yearmonth">' . $text . ' &nbsp;(' . count($postresults) . '&nbsp;篇文章)</h2><ul class="archives-monthlisting">' . "\n";



             foreach ($postresults as $postresult) {



                 if ($postresult->post_date != '0000-00-00 00:00:00') {



                 $url = get_permalink($postresult->ID);



                 $arc_title    = $postresult->post_title;



                 if ($arc_title)



                     $text = wptexturize(strip_tags($arc_title));



                 else



                     $text = $postresult->ID;



                     $title_text = 'View this post, &quot;' . wp_specialchars($text, 1) . '&quot;';



                     $output .= '<li>|——' . mysql2date('d日', $postresult->post_date) . ':&nbsp;' . "<a href='$url' title='$title_text'>$text</a>";



                     $output .= '&nbsp;(' . $postresult->comment_count . ')';



                     $output .= '</li>' . "\n";



                 }



                 }



             }



             $output .= '</ul></article>' . "\n";



             }



         update_option('SHe_archives_'.$lastpost,$output);



         }else{



             $output = '<div class="errorbox">Sorry, no posts matched your criteria.</div>' . "\n";



         }



     }



     echo $output;



 }







function get_current_tag_id() {



 $current_tag = single_tag_title('', false);//获得当前TAG标签名称



 $tags = get_tags();//获得所有TAG标签信息的数组



   foreach($tags as $tag) {



  if($tag->name == $current_tag) return $tag->term_id; //获得当前TAG标签ID，其中term_id就是tag ID



 }



}







function par_pagenavi($range = 9){



	global $paged, $wp_query;



	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}



	if($max_page > 1){if(!$paged){$paged = 1;}



	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 返回首页 </a>";}



	previous_posts_link('上一页');



    if($max_page > $range){



		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";



		if($i==$paged)echo " class='current'";echo ">$i</a>";}}



    elseif($paged >= ($max_page - ceil(($range/2)))){



		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";



		if($i==$paged)echo " class='current'";echo ">$i</a>";}}



	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){



		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}



    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";



    if($i==$paged)echo " class='current'";echo ">$i</a>";}}



	next_posts_link('下一页');



    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 最后一页 </a>";}}



}







/*BREADCRUMB*/



function the_breadcrumb() {

if (!is_home()) {

echo '<a href="';

echo get_option('home');

echo '"/>';

echo "首页";

echo "</a> > ";

if(is_category()){

echo '<a href="';

echo get_category_link(the_category_ID(false));

echo '">';

echo single_cat_title( '', false );

echo "</a> ";

}

elseif(is_single()){

the_category(', ');

echo " > ";

echo '<a href="';

the_permalink();

echo '">';

the_title();

echo "</a> ";

}

elseif (is_page()) {

echo '<a href="';

the_permalink();

echo '">';

echo the_title();

echo "</a> ";

}

elseif (is_tag()) {

echo '标签为 "';

echo '<a href="';

echo get_tag_link(get_current_tag_id());

echo '">';

single_tag_title();

echo "</a> ";

echo '"'; }

elseif (is_day()) {echo "发表于 "; the_time(' Y-m-j');}

elseif (is_month()) {echo "发表于 "; the_time(' Y-m');}

elseif (is_year()) {echo "发表于 "; the_time(' Y');}

elseif (is_author()) {echo "作者归档";}

elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "本站归档";}

elseif (is_search()) {echo "搜索结果如下";}

}

}

remove_filter('comment_text', 'make_clickable', 9);//去掉评论网址超连接

remove_filter('the_content', 'wptexturize');//取消自动转义，单引号双引号

/*add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );*/

?>
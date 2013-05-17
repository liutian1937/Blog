<?php if ( post_password_required() ) : ?>
<?php _e( 'Enter your password to view comments.' ); ?>
<?php return; endif; ?>
<section id="comments">	
	<?php if ( have_comments() ) : ?>
		<h3><?php comments_number(__('No Comments', '1 Comment', '% Comments' ));?></h3>
		<ol id="comment_list">
			<?php wp_list_comments( array( 'callback' => 'prower_comment' ,'avatar_size' => '30') );?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div id="page_navi" style="text-align:right;">
<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
</div>
		<?php endif; ?>
	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php _e( 'Comments are closed.' ); ?></p>
	<?php endif; ?>
    
	<?php if ('open' == $post->comment_status) : ?>
    <section id="respond">
				<h3 id="reply-title">发表评论 <small><?php cancel_comment_reply_link(); ?></small></h3>
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<p class="comment-notes">电子邮件地址不会被公开。 必填项已用 <span class="required">*</span> 标注</p>	
                <p class="comment-form-author"><label for="author">姓名：</label><input id="author" name="author" type="text" required value="<?php echo $comment_author; ?>" size="30" aria-required="true"><span class="required">*</span></p>
<p class="comment-form-email"><label for="email">邮件：</label><input id="email" name="email" type="email" required value="<?php echo $comment_author_email; ?>" size="30" aria-required="true"><span class="required">*</span></p>
<p class="comment-form-url"><label for="url">站点：</label><input id="url" name="url" type="text" value="<?php echo $comment_author_url; ?>" size="30"></p>
				<p class="comment-form-comment"><textarea aria-required="true" rows="8" cols="45" name="comment" id="comment" onkeydown="if(event.ctrlKey){if(event.keyCode==13){document.getElementById('submit').click();return false}};"></textarea></p>
                					
						<p class="form-submit">
							<input name="submit" type="submit" id="submit" value="Ctrl+enter发表评论">
							<?php comment_id_fields(); ?>
                            <?php do_action('comment_form', $post->ID); ?>
						</p>
						</form>
			</section>
    <?php endif; ?>
</section>
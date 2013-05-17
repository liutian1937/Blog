<footer id="footer">
			<p>© 2011 牛魔王的世界观，专注于web<a href="http://www.niumowang.org/" title="专注于web前端开发">前端开发</a>. Powered by <a href="http://wordpress.org/" rel="external nofollow" target="_blank">WordPress</a>. Theme by 牛魔王的世界观</p>
</footer>
<?php if (is_single()) { ?>
<div id="shangxia"><div id="shang" title="返回头部"></div><div id="comt" title="转到评论"></div><div id="xia" title="回到底部"></div></div>
<?php } else if(!is_404()) { ?>
<div id="shangxia"><div id="shang" title="返回头部"></div><div id="xia" title="回到底部"></div></div>
<?php } ?>
</div>
<script type="text/javascript" src="http://www.niumowang.org/wp-content/themes/pizi/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="http://www.niumowang.org/wp-content/plugins/pizi_run_code/ZeroClipboard.js"></script>
<script type="text/javascript" src="http://www.niumowang.org/wp-content/themes/pizi/comments-ajax.js"></script>
<div style="display:none">
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F6e64a6232d15b126c13932fe8532ab11' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
<?php wp_footer(); ?>
</body>
</html>
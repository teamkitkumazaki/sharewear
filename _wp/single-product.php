<!doctype html>
<html dir="ltr" lang="ja">
<script id="datalayer-checker-script" src="chrome-extension://ffljdddodmkedhkcjhpmdajhjdbkogke/js/datalayer-checker.js"></script>
<head>
<?php get_template_part("parts/head");?>
</head>
<body>
	<div id="body-wrapper" class="clearfix">
		<?php get_template_part("parts/header");?>

		<?php
			$post_id = $post->ID; //ポストID
			$authorID = $post->post_author; // 著者のID
			$meta = get_post_meta($post_id); //ポストID
			$image = get_the_post_thumbnail_url($id, 'full');
			$image_sp = get_the_post_thumbnail_url($id, 'medium_large');
			$page_ttl = get_the_title($post_id);
		?>

		<ul id="main-wrapper">
			<li id="maincontent">
				<article id="post-483" class="post-483 page type-page status-publish hentry">
					<header>
						<hgroup>
							<h1 class="posttitle"><a href="javascript:void(0);" title="<?= $page_ttl;?>" rel="bookmark"><?= $page_ttl;?></a></h1>
						</hgroup>
					</header>
					<div class="storycontent">
						<?php the_content(); ?>
					</div>
					<footer class="clearfix fl"></footer>
				</article>
			</li>
			<li id="firstsidebar" role="complementary" class="el2">
				<?php get_template_part("parts/aside");?>
			</li> <!-- end firstsidebar -->
		</ul>
		<?php get_template_part("parts/footer");?>
	</div>
</body>
	<?php get_template_part("parts/script");?>
</html>

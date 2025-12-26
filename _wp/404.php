<!doctype html>
<html>
<head>
<?php get_template_part("parts/head");?>
</head>
<body>
<header>
<?php get_template_part("parts/header");?>
</header>
<article id="page404" class="page-404">
	<section class="section-404">
		<div class="section_inner_new">
			<h1 class="contact_ttl">404 NOT FOUND</h1>
			<p class="contact_desc"><span class="">お探しのページは見つかりませんでした</span></p>
			<div class="comp-link-button">
				<div class="button_item">
					<a class="red" href="#aaaa">
						<span class="arrow left">
							<span class="arrow_inner"></span>
						</span>
						<span class="txt">トップページに戻る</span>
						<span class="arrow right">
							<span class="arrow_inner"></span>
						</span>
					</a>
				</div>
			</div>
		</div><!-- section_inner -->
	</section>
	<?php get_template_part("parts/recruit");?>
</article>
<?php get_template_part("parts/hummenu");?>
<?php get_template_part("parts/footer");?>
</body>
<?php get_template_part("parts/script");?>
</html>

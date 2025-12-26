<!doctype html>
<html>
<head>
<?php get_template_part("parts/head");?>
</head>
<body>
<?php get_template_part("parts/header");?>
<?php if(have_posts()):while(have_posts()): the_post();?>
<article id="<?php the_field('page_id'); ?>" class="<?php the_field('page_class'); ?>">
	<section class="section-title">
		<div class="section_inner">
			<div class="comp-text-set center margin">
				<span class="ttl_en"><?php the_field('page_title_en'); ?></span>
				<h1 class="ttl_ja"><?php the_field('page_title_ja'); ?></h1>
			</div>
		</div>
	</section>
<?php the_content();?>
</article>
<?php endwhile; endif;?>
<?php get_template_part("parts/footer");?>
<?php get_template_part("parts/hummenu");?>
</body>
</html>

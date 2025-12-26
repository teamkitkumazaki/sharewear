<!doctype html>
<html>

<head>
	<?php get_template_part("parts/head"); ?>
</head>
<?php $url = $_SERVER['REQUEST_URI']; ?>
<body>
	<?php get_template_part("parts/header"); ?>

	<?php
		$post_id = $post->ID; //ポストID
		$authorID = $post->post_author; // 著者のID
		$meta = get_post_meta($post_id); //ポストID
		$image = get_the_post_thumbnail_url($id, 'full');
		$image_sp = get_the_post_thumbnail_url($id, 'medium_large');
		$date = get_the_date('Y.m.d');
		$page_ttl = get_the_title($post_id);
		$profile_flag = SCF::get('profile_flag',$post_id);
		$profile_img = SCF::get('profile_img',$post_id);
		$profile_img_url = wp_get_attachment_image_src($profile_img, 'medium_large');
		$profile_name = SCF::get('profile_name',$post_id);
		$desc_flag = SCF::get('desc_flag',$post_id);
		$article_content = SCF::get('article_content',$post_id);
		$contents_length = 0;

		/* カテゴリー */
		$terms = get_the_terms($post->ID, 'interview-category');

	?>

	<article id="interviewDetail" class="page-interview-detail">
		<section class="section-interview-header">
			<div class="section_wrapper">
				<?php if ($image):?>
				<div class="thumb_wrapper">
					<img src="<?= $image;?>" srcset="<?= $image;?> 1440w, <?= $image_sp;?> 768w, <?= $image;?> 2048w">
				</div>
				<?php endif; ?>
				<div class="article_header">
					<h1 class="article_ttl"><?= $page_ttl;?></h1>
					<div class="header_lower">
						<div class="comp-category-list">
							<?php if ($terms) :
								foreach ($terms as $term) {
									$category_name = $term->name;
									$category_slug = $term->slug;
									echo '<div class="category_item"><a class="'.$term->slug.'" href="/interview-category/'.$term->slug.'"><span>#</span>'. $term->name.'</a></div>';
								}
								endif;
							?>
						</div>
						<div class="date"><?= $date;?></div>
					</div><!-- header_lower -->
					<div class="lead_description">
						<?php
							$lead_description = SCF::get('lead_description');
							echo apply_filters('the_content', $lead_description);
						?>
					</div>
				</div><!-- article_header -->
			</div><!-- section_wrapper -->
		</section>
		<?php if($profile_flag):?>
		<section class="section-article-profile">
			<div class="section_inner">
				<div class="profile_flex_wrap">
					<div class="profile_img">
						<img src="<?= $profile_img_url[0];?>">
					</div>
					<div class="profile_txt">
						<h2 class="profile_ttl"><?= $profile_name;?></h2>
						<div class="profile_desc">
							<?php
								$profile_description = SCF::get('profile_description');
								echo apply_filters('the_content', $profile_description);
							?>
						</div>
					</div>
				</div>
			</div><!-- section_inner -->
		</section>
		<?php endif;?>
		<section class="section-article-content">
			<div class="section_inner">
				<div class="comp-article-contents">
					<?php foreach ($article_content as $d):?>
					<div class="article_item <?php if( $d['border'] ):?>border<?php endif; ?>">

						<?php if ($d['article_h2']):?>
							<h2><?= $d['article_h2'];?></h2>
						<?php endif; ?>

						<?php if ($d['article_img']):?>
						<div class="img_wrap">
							<img
								src="<?= wp_get_attachment_image_src($d['article_img'], 'large')[0]; ?>"
							>
							<?php if ($d['article_img_caption']): ?>
							<div class="caption">
								<?= $d['article_img_caption'];?>
							</div>
							<?php endif; ?>
						</div>
						<?php endif; ?>

						<?php if ($d['article_h3']):?>
							<h3><?= $d['article_h3'];?></h3>
						<?php endif; ?>

						<?php if ($d['article_description']):?>
						<div class="desc_wrap <?php if( $d['quote'] ):?>quote<?php endif; ?>">
							<!-- quote -->
							<?php
								$description = $d['article_description'];
								echo apply_filters('the_content', $description);
							?>
						</div>
						<?php endif; ?>
					</div>
					<?php endforeach; ?>
				</div><!-- comp-article-contents -->
				<?php
					$share_url = urlencode( get_permalink() );
					$share_title = urlencode( get_the_title() );
				?>
				<div class="comp-sns-share">
					<div class="share_ttl">SHARE</div>
					<div class="sns_wrapper">
						<div class="sns_item">
							<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>">
								<img src="<?php echo get_template_directory_uri();?>/assets/img/common/icon_fb.svg">
							</a>
						</div>
						<div class="sns_item">
							<a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>&title=<?php echo $share_title; ?>">
								<img src="<?php echo get_template_directory_uri();?>/assets/img/common/icon_linkedin.svg">
							</a>
						</div>
						<div class="sns_item">
							<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>">
								<img src="<?php echo get_template_directory_uri();?>/assets/img/common/icon_x.svg">
							</a>
						</div>
					</div><!-- sns_wrapper -->
				</div><!-- comp-sns-share -->
			</div><!-- section_inner -->
		</section>
		<?php get_template_part("parts/recruit"); ?>
	</article>
	<?php get_template_part("parts/hummenu"); ?>
	<?php get_template_part("parts/footer"); ?>
</body>
<?php get_template_part("parts/script"); ?>
</html>

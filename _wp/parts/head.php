	<?php $url = $_SERVER['REQUEST_URI']; ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(strstr($url,'member') || strstr($url,'result')) : ?>
	<meta name="robots" content="noindex,nofollow" />
	<?php endif; ?>
	<meta name="format-detection" content="telephone=no">
	<?php
	if ( is_home() || is_front_page() ) {
  	$site_title = '採用情報 | 株式会社スキルアップNeXt';
  	$site_permalink = home_url( '/' );
		$thumnail = get_template_directory_uri().'/assets/img/ogp/ogp.jpg';
		$description = "AI/DXや脱炭素/カーボンニュートラルなど先端技術領域の人材育成・法人研修・採用/組織構築支援。JDLA認定プログラム第一号";
	}else if( is_404()){
		$site_title = 'ページがみつかりません | 採用情報 | 株式会社スキルアップNeXt';
		$site_permalink = get_the_permalink();
		$thumnail = get_template_directory_uri().'/assets/img/ogp/ogp.jpg';
		$description = "AI/DXや脱炭素/カーボンニュートラルなど先端技術領域の人材育成・法人研修・採用/組織構築支援。JDLA認定プログラム第一号";
	} else if( is_archive() ){
	  if(strstr($url,'interview')){
			$page_title = 'メンバーインタビュー | 採用情報 | 株式会社スキルアップNeXt';
			$site_title = 'メンバーインタビュー | 採用情報 | 株式会社スキルアップNeXt';
	  	$site_permalink = get_the_permalink();
			$description = 'SANABURIの最新情報ページです。';
		}
	} else if( is_single() || is_page() ) {
  	$site_title = get_the_title($post->ID).' | 採用情報 | 株式会社スキルアップNeXt';
  	$site_permalink = get_the_permalink($post->ID);
		$first_image = catch_that_image();
		if (!empty(get_the_post_thumbnail_url($post->ID, 'large'))) {
			$image = get_the_post_thumbnail_url($post->ID, 'large');
			$thumnail = $image;  // サムネイル画像を出力
		} else if ($first_image != 'no_image') {
			$thumnail = $first_image; // function.php定義した投稿1枚目の画像を出力
		} else {
			$thumnail = get_template_directory_uri() . '/assets/img/blog/blog_thumb.jpg'; // デフォルトのサムネイル画像を出力
		}
	}else{
		$page_title = '採用情報 | 株式会社スキルアップNeXt';
		$site_title = '採用情報 | 株式会社スキルアップNeXt';
  	$site_permalink = get_the_permalink();
		$description = "AI/DXや脱炭素/カーボンニュートラルなど先端技術領域の人材育成・法人研修・採用/組織構築支援。JDLA認定プログラム第一号";
		$thumbnail_id = get_post_thumbnail_id($post->ID);
		$site_image_attach = wp_get_attachment_image_src( $thumbnail_id, 'large' );
		if (!empty($site_image_attach)) {
			$site_image = $site_image_attach[0];
		}
	}

  	if (empty($description)) {
  		$description = "AI/DXや脱炭素/カーボンニュートラルなど先端技術領域の人材育成・法人研修・採用/組織構築支援。JDLA認定プログラム第一号";
  	}
		$site_image = "";

	?>
	<title><?php echo $site_title; ?></title>
	<meta property="og:title" content="<?php echo $site_title; ?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?php echo $site_permalink; ?>">
	<meta property="og:image" content="<?php echo $thumnail; ?>">
	<meta name="description" content="<?php echo $description; ?>">
	<meta property="og:locale" content="ja_JP">
	<meta property="og:type" content="article">
	<meta property="og:title" content="<?php echo $site_title; ?>">
	<meta property="og:description" content="<?php echo $description; ?>">
	<meta property="og:site_name" content="SANABURI | 秋田・男鹿発アップサイクルクラフト酒">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:description" content="<?php echo $description; ?>">
	<meta name="twitter:title" content="<?php echo $site_title; ?>">
	<meta name="twitter:image" content="<?php echo $thumnail; ?>">
	<link href="<?php echo get_template_directory_uri();?>/assets/img/icon/icon.png" rel="apple-touch-icon" sizes="180x180">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/assets/img/icon/icon.png">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/yakuhanjp@4.0.1/dist/css/yakuhanjp.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://skillup-next.co.jp/wp-content/themes/skillupai_corp/assets/css/common.css?<?php echo date('Ymd-Hi');?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/style.css?<?php echo date('Ymd-Hi');?>">
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5R3JVZN');</script>
	<!-- End Google Tag Manager -->
	<?php wp_head(); ?>

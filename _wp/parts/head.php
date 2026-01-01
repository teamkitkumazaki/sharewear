	<?php $url = $_SERVER['REQUEST_URI']; ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if(strstr($url,'member') || strstr($url,'result')) : ?>
	<meta name="robots" content="noindex,nofollow" />
	<?php endif; ?>
	<meta name="format-detection" content="telephone=no">
	<?php
	if ( is_home() || is_front_page() ) {
  	$site_title = 'shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
  	$site_permalink = home_url( '/' );
		$thumnail = get_template_directory_uri().'/assets/img/ogp/ogp.jpg';
		$description = "AI/DXや脱炭素/カーボンニュートラルなど先端技術領域の人材育成・法人研修・採用/組織構築支援。JDLA認定プログラム第一号";
	}else if( is_404()){
		$site_title = 'ページがみつかりません | shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
		$site_permalink = get_the_permalink();
		$thumnail = get_template_directory_uri().'/assets/img/ogp/ogp.jpg';
		$description = "AI/DXや脱炭素/カーボンニュートラルなど先端技術領域の人材育成・法人研修・採用/組織構築支援。JDLA認定プログラム第一号";
	} else if( is_archive() ){
	  if(strstr($url,'interview')){
			$page_title = 'メンバーインタビュー | shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
			$site_title = 'メンバーインタビュー | shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
	  	$site_permalink = get_the_permalink();
			$description = 'SANABURIの最新情報ページです。';
		}
	} else if( is_single() || is_page() ) {
  	$site_title = get_the_title($post->ID).' | shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
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
		$page_title = 'shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
		$site_title = 'shareWear | Tシャツを選んで着る。それが新しい支援のかたち';
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
	<link rel="pingback" href="http://sharewear.jp/xmlrpc.php">
	<link rel="shortcut icon" type="image/x-icon" href="http://sharewear.jp/wp-content/themes/presswork/admin/images/favicon.ico">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">
	<link rel="alternate" type="application/rss+xml" title="shareWear » フィード" href="http://sharewear.jp/?feed=rss2">
	<link rel="alternate" type="application/rss+xml" title="shareWear » コメントフィード" href="http://sharewear.jp/?feed=comments-rss2">
	<link rel="stylesheet" id="pw_google_font-css" href="./assets/img/css" type="text/css" media="all">
	<script type="text/javascript" src="./assets/js/jquery.js"></script>
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://sharewear.jp/xmlrpc.php?rsd">
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://sharewear.jp/wp-includes/wlwmanifest.xml">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/style.css?<?php echo date('Ymd-Hi');?>">
	<!-- PressWork Theme Option CSS -->
	<style type="text/css">
		body {
			font-family: Open Sans;
			font-size: 12px;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		h1 a,
		h2 a,
		h3 a,
		h4 a,
		h5 a,
		h6 a {
			font-family: Quattrocento;
		}

		#body-wrapper {
			color: #444444;
			width: 880px;
			padding: 0px;
			background-color: #FFFFFF;
		}

		#headerbanner,
		#footer {
			width: 880px;
		}

		#headerbanner li.mainl#header_image {
			background-size: 880px;
		}

		#main-wrapper>li {
			margin: 0 15px;
		}

		#main-wrapper .el3 {
			*margin-left: 30px;
		}

		#firstsidebar {
			width: 250px;
		}

		#secondsidebar {
			width: 180px;
		}

		#maincontent {
			width: 600px;
		}

		body.fullwidth #maincontent {
			width: 880px;
		}

		.siteheader a {
			color: #222222;
		}

		.siteheader a:hover {
			color: #444444;
		}

		#description {
			color: #444444;
		}

		a {
			color: #444444;
		}

		a:hover {
			color: #8a191b;
		}

		#nav nav ul {
			background: #FFFFFF;
		}

		#nav nav a {
			color: #222222
		}

		#nav nav a:hover,
		#nav nav .sub-menu li,
		#nav nav li:hover {
			color: #444444;
			background: #EEEEEE;
		}

		#subnav nav ul {
			background: #FFFFFF;
		}

		#subnav nav a {
			color: #222222
		}

		#subnav nav a:hover,
		#subnav nav .sub-menu li,
		#subnav nav li:hover {
			color: #222222;
			background: #EEEEEE;
		}

		#footer nav ul {
			background: #FFFFFF;
		}

		#footer nav a {
			color: #222222
		}

		#footer nav a:hover,
		#footer nav .sub-menu li,
		#footer nav li:hover {
			color: #222222;
			background: #EEEEEE;
		}

		h1.catheader {
			color: #222222;
		}

		article .meta {
			color: #888888;
		}

		article .posttitle,
		article .posttitle a {
			color: #222222;
		}

		article .posttitle a:hover {
			color: #222222;
		}

		article .content-col {
			padding-left: 165px;
		}

		@media only screen and (max-device-width: 768px),
		only screen and (max-width: 768px) {
			#body-wrapper {
				width: 720px !important;
				padding: 0 10px;
			}

			body.fullwidth #maincontent,
			#headerbanner,
			#footer {
				width: 720px !important;
			}

			#header_image {
				background-size: 720px !important;
				height: 130.909090909px !important;
			}

			#maincontent {
				width: 480.909090909px !important;
			}

			#firstsidebar {
				width: 204.545454545px !important;
			}

			#secondsidebar {
				width: 132.272727273px !important;
			}
		}

		@media only screen and (max-width: 480px),
		only screen and (max-device-width: 480px) {
			#body-wrapper {
				width: 420px !important;
				padding: 0 10px;
			}

			body.fullwidth #maincontent,
			#headerbanner,
			#footer {
				width: 420px !important;
			}

			#maincontent {
				width: 420px !important;
			}

			#header_image {
				background-size: 420px !important;
				height: 76.3636363636px !important;
			}

			.home article {
				width: 100%;
			}

			#firstsidebar,
			#secondsidebar {
				float: none;
				width: 100% !important;
			}

			#main-wrapper>li {
				margin: 0 !important;
			}

			#extendedfooter .bottom-widget {
				width: 100%;
				margin: 0 0 20px;
			}
		}
	</style>
	<style type="text/css">
		#header_image {
			background: url(http://sharewear.jp/wp-content/uploads/2012/04/header-logo.png);
			height: 160px;
			width: 880px;
		}
	</style>
	<link rel="stylesheet" href="./assets/css/ninja_onetag.css">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap');
	</style>
	<?php wp_head(); ?>

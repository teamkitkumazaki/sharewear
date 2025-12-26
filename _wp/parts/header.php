<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5R3JVZN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header <?php if ( is_home() || is_front_page() ):?>class="index"<?php endif; ?>>
	<div class="header_inner">
		<div class="header_logo">
			<a href="/recruit">
				<img src="<?php echo get_template_directory_uri();?>/assets/img/common/h_logo.svg">
			</a>
		</div>
		<div class="header_navigation">
			<nav class="navigation_list">
				<ul>
					<li><a href="/recruit/benefits">働きやすさと成長支援</a></li>
					<li><a href="/recruit/interview">メンバーインタビュー</a></li>
					<li><a href="/recruit/faq">よくある質問</a></li>
				</ul>
				<div class="comp-link-button flex">
					<div class="button_item">
						<a target="_blank" class="blue" href="https://recruit.jobcan.jp/suai/list?category_id=48915">
							<span class="arrow left">
								<span class="arrow_inner"></span>
							</span>
							<span class="txt align_left">新卒採用</span>
							<span class="arrow right">
								<span class="arrow_inner"></span>
							</span>
						</a>
					</div>
					<div class="button_item">
						<a target="_blank" class="red align_left" href="https://recruit.jobcan.jp/suai/list?category_id=48916">
							<span class="arrow left">
								<span class="arrow_inner"></span>
							</span>
							<span class="txt align_left">中途採用</span>
							<span class="arrow right">
								<span class="arrow_inner"></span>
							</span>
						</a>
					</div>
				</div><!-- comp-link-button -->
			</nav>
			<div class="header_menu">
				<button id="humButton" title="menu">
					<span></span>
					<span></span>
				</button>
			</div>
		</div>
	</div><!-- header_inner -->
</header>

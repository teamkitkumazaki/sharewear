<!doctype html>
<html>
<head>
	<?php
	/*Template Name: 福利厚生 */
	get_template_part("parts/head");
	?>
</head>
<body>
	<header>
		<?php get_template_part("parts/header"); ?>
	</header>

	<?php
		$post_id = $post->ID; //ポストID
		$authorID = $post->post_author; // 著者のID
		$relation01 = SCF::get('relation01',$post_id);
		$relation02 = SCF::get('relation02',$post_id);
		$contents_length01 = 0;
		$contents_length02 = 0;

		/* カテゴリー */
		$terms = get_the_terms($post->ID, 'interview-category');

	?>

	<?php foreach ($relation01 as $d):?>
		<?php $contents_length01 = intval($contents_length01) + intval(1);?>
	<?php endforeach; ?>

	<?php foreach ($relation02 as $d):?>
		<?php $contents_length02 = intval($contents_length02) + intval(1);?>
	<?php endforeach; ?>

	<article id="benefits" class="page-benefits">
		<section class="section-underpage-main comp-underpage-main">
			<div class="main_img">
				<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/benefits/main.jpg">
				<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/benefits/main_pc.jpg">
			</div>
			<h1 class="underpage_ttl effect animate-fadeup">働きやすさと成長支援</h1>
		</section>
		<section class="section-benefit comp-first-contents gray">
			<div class="section_inner effect animate-fadeup">
				<div class="inner_box">
					<div class="comp-benefit-title">
						<div class="ttl_flex_wrap">
							<h2 class="ttl">働きやすさと<br>成長支援</h2>
							<div class="desc_wrap">
								<p>スキルアップNeXtには、育児との両立支援や副業OKなど、多様な働き方を支える制度のほか、社員の学びを会社として積極的に支援する制度があります。一方、職場の雰囲気も大切にしており、そのためのちょっとした試行錯誤もしています。</p>
							</div>
						</div>
					</div><!-- comp-benefit-title -->
					<div class="comp-benefit-list list02">
						<h2 class="benefits_ttl">学びの支援</h2>
						<div class="list_wrapper">
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit02_01.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">自社コンテンツ<br>受講無料</h3>
									</div>
									<div class="benefit_desc">
										<p>当社が持つ豊富な学習コンテンツを、社員は無料で受講できます。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit02_02.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">検定取得制度</h3>
									</div>
									<div class="benefit_desc">
										<p>資格取得にかかる費用を会社が一部負担し、スキルアップを支援。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit02_03.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">書籍レンタル<br>購入制度</h3>
									</div>
									<div class="benefit_desc">
										<p>業務に必要な書籍や資料の購入費を補助。レンタルも可能。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit02_04.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">外部研修費用補助</h3>
									</div>
									<div class="benefit_desc">
										<p>専門知識や最新技術を学ぶ外部セミナーや研修参加費を補助します。</p>
									</div>
								</div>
							</div>
							<div class="list_item wide">
								<div class="benefit_img">
									<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit02_05.jpg">
									<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit02_05_pc.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">大学院修士<br>博士課程在籍OK</h3>
									</div>
									<div class="benefit_desc">
										<p>高度な専門性を追求するため、大学院との両立も応援します。</p>
									</div>
								</div>
							</div>
						</div><!-- list_wrapper -->
					</div><!-- comp-benefit-list -->
				</div><!-- inner_box -->
			</div><!-- inner_box -->
			</div><!-- section_inner -->
		</section>
		<?php if($contents_length01 > 0):?>
		<section class="section-related-article comp-section-related-article">
			<div class="section_inner effect animate-fadeup">
				<div class="comp-interview-list row0<?= $contents_length01;?>">
					<?php foreach ($relation01 as $post_id):?>
						<?php
							$title = get_the_title($post_id);
							$url = get_permalink($post_id);
							$date = get_the_date('Y.m.d', $post_id);
							$image = get_the_post_thumbnail_url($post_id, 'full');
							$image_sp = get_the_post_thumbnail_url($post_id, 'full');
							$terms = get_the_terms($post_id, 'interview-category');
						;?>
						<div class="interview_item">
              <div class="interview_img">
                <a href="<?= $url;?>">
                  <?php if ($image) : ?>
									<img src="<?= $image ?>" srcset="<?= $image ?> 1440w, <?= $image_sp ?> 768w, <?= $image ?> 2048w">
                  	<?php endif; ?>
                </a>
              </div>
              <div class="interview_txt">
                <div class="comp-category-list">
                  <?php if ($terms) :
                    foreach ($terms as $term) {
                      $category_name = $term->name;
                      $category_slug = $term->slug;
                      echo '<div class="category_item"><a class="'.$term->slug.'" href="/interview-category/'.$term->slug.'"><span>#</span>'. $term->name.'</a></div>';
                    }
                    endif;
                  ?>
                </div><!-- comp-category-list -->
                <h3 class="interview_ttl"><a href="<?= $url;?>"><?= $title;?></a></h3>
                <div class="interview_lower">
                  <div class="date"><?= $date;?></div>
                  <div class="link_button">
                    <a href="<?= $url;?>">
                      <span class="txt">記事を読む</span>
                      <span class="arrow"></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
					<?php endforeach; ?>
				</div><!-- section_inner -->
			</section>
		<?php endif; ?>
		<section class="section-benefit2">
			<div class="section_inner effect animate-fadeup">
				<div class="inner_box">
					<div class="comp-benefit-list list01">
						<h2 class="benefits_ttl">働きやすさを支える制度</h2>
						<div class="list_wrapper">
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_01.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">フレックス制<span>コアタイム有り</span></h3>
									</div>
									<div class="benefit_desc">
										<p>コアタイムは11時-15時。それ以外の時間は7時-22時の中で調整してください。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_02.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">各種保険加入<span>関東ITS健康保険組合</span></h3>
									</div>
									<div class="benefit_desc">
										<p>提携施設でお得に宿泊できたり、食事ができる特典等ございます。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_03.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">リモートワーク可</h3>
									</div>
									<div class="benefit_desc">
										<p>週2～3回リモートワークを利用される方が多いです。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_04.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">副業可<span>申請制</span></h3>
									</div>
									<div class="benefit_desc">
										<p>スキルアップのために、申請の上、副業が可能です。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_05.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">長期表彰制度</h3>
									</div>
									<div class="benefit_desc">
										<p>長く貢献してくれた社員を表彰。感謝を込めて休暇とプレゼントを贈呈。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_06.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">結婚休暇5日付与</h3>
									</div>
									<div class="benefit_desc">
										<p>結婚の際に、特別休暇を5日間付与します。ハネムーンなどにご利用ください。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_07.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">年間休日約126日</h3>
									</div>
									<div class="benefit_desc">
										<p>しっかり休める環境。カレンダー通りのお休みに加え、特別休暇も。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_08.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">交通費支給<span>上限3万円/月</span></h3>
									</div>
									<div class="benefit_desc">
										<p>通勤にかかる費用を最大3万円まで会社が負担します。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_09.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">リフレッシュ休暇</h3>
									</div>
									<div class="benefit_desc">
										<p>1000日以上勤務いただいた方に付与。心身ともに休んでいただく特別休暇です。</p>
									</div>
								</div>
							</div>
							<div class="list_item">
								<div class="benefit_img">
									<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/benefit01_10.jpg">
								</div>
								<div class="benefit_txt">
									<div class="ttl_wrap">
										<h3 class="benefit_ttl">おやつ有り</h3>
									</div>
									<div class="benefit_desc">
										<p>小腹が空いた時や気分転換に。無料のおやつを用意しています。</p>
									</div>
								</div>
							</div>
						</div><!-- list_wrapper -->
					</div><!-- comp-benefit-list -->
				</div><!-- inner_box -->
			</div><!-- inner_box -->
			</div><!-- section_inner -->
		</section>
		<?php if($contents_length02 > 0):?>
		<section class="section-related-article comp-section-related-article">
			<div class="section_inner effect animate-fadeup">
				<div class="comp-interview-list row0<?= $contents_length02;?>">
					<?php foreach ($relation02 as $post_id):?>
						<?php
							$title = get_the_title($post_id);
							$url = get_permalink($post_id);
							$date = get_the_date('Y.m.d', $post_id);
							$image = get_the_post_thumbnail_url($post_id, 'full');
							$image_sp = get_the_post_thumbnail_url($post_id, 'full');
							$terms = get_the_terms($post_id, 'interview-category');
						;?>
						<div class="interview_item">
              <div class="interview_img">
                <a href="<?= $url;?>">
                  <?php if ($image) : ?>
									<img src="<?= $image ?>" srcset="<?= $image ?> 1440w, <?= $image_sp ?> 768w, <?= $image ?> 2048w">
                  	<?php endif; ?>
                </a>
              </div>
              <div class="interview_txt">
                <div class="comp-category-list">
                  <?php if ($terms) :
                    foreach ($terms as $term) {
                      $category_name = $term->name;
                      $category_slug = $term->slug;
                      echo '<div class="category_item"><a class="'.$term->slug.'" href="/interview-category/'.$term->slug.'"><span>#</span>'. $term->name.'</a></div>';
                    }
                    endif;
                  ?>
                </div><!-- comp-category-list -->
                <h3 class="interview_ttl"><a href="<?= $url;?>"><?= $title;?></a></h3>
                <div class="interview_lower">
                  <div class="date"><?= $date;?></div>
                  <div class="link_button">
                    <a href="<?= $url;?>">
                      <span class="txt">記事を読む</span>
                      <span class="arrow"></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
					<?php endforeach; ?>
				</div><!-- section_inner -->
		</section>
		<?php endif; ?>
		<?php get_template_part("parts/recruit"); ?>
		<section class="section-kufu">
			<div class="section_inner effect animate-fadeup">
				<div class="comp-benefit-title">
					<div class="ttl_flex_wrap">
						<h2 class="ttl">働きやすさのための<br>その他の工夫</h2>
						<div class="desc_wrap">
							<p>執務室は、全席モニター完備。オンライン会議などを行うブースのほか、月に2回、会社からコーヒーとお菓子を提供して雑談をする休憩時間なども。集中したい人は十分集中できる一方、日頃の横のつながりが相談のしやすさや柔軟な連携に寄与しています。</p>
						</div>
					</div>
				</div><!-- comp-benefit-title -->
				<div class="comp-workspace-feature">
					<div class="feature_item">
						<div class="feature_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/feature_img01.jpg">
						</div>
						<div class="feature_txt">
							<p>小上がりエリアがあります。クッションもあるため、リラックスタイムにオススメです</p>
						</div>
					</div>
					<div class="feature_item">
						<div class="feature_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/feature_img02.jpg">
						</div>
						<div class="feature_txt">
							<p>チームごとの固定エリアで、日常的な会話から生まれるアイデアと、迅速な連携を大切にしています。</p>
						</div>
					</div>
					<div class="feature_item">
						<div class="feature_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/feature_img03.jpg">
						</div>
						<div class="feature_txt">
							<p>打ち合わせや集中作業のためのブース。<br>モニターも設置されています。</p>
						</div>
					</div>
					<div class="feature_item">
						<div class="feature_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/feature_img04.jpg">
						</div>
						<div class="feature_txt">
							<p>出社したら自由に食べられるお菓子が待っています。バラエティも豊富です。</p>
						</div>
					</div>
					<div class="feature_item">
						<div class="feature_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/feature_img05.jpg">
						</div>
						<div class="feature_txt">
							<p>フィーカタイムを開催しています。コーヒーやお菓子と共に自由に交流を楽しめます。</p>
						</div>
					</div>
					<div class="feature_item">
						<div class="feature_img">
							<img src="<?php echo get_template_directory_uri();?>/assets/img/benefits/feature_img06.jpg">
						</div>
						<div class="feature_txt">
							<p>社員の資格取得を応援しています。<br>社員自身もスキルアップしています。</p>
						</div>
					</div>
				</div><!-- comp-workspace-feature -->
			</div><!-- section_inner -->
		</section>
		<section class="section-numbers">
			<div class="section_inner effect animate-fadeup">
				<div class="comp-benefit-title">
					<div class="ttl_flex_wrap">
						<h2 class="ttl">数字でわかる<br>スキルアップNeXt</h2>
						<div class="desc_wrap">
							<p>スキルアップNeXtの特徴を数字でご紹介します。<span>※2025年10月現在</span></p>
						</div>
					</div>
				</div><!-- comp-benefit-title -->
				<div class="comp-number-graph">
					<div class="graph_wrapper effect animate-fadeup">
						<h3 class="graph_ttl">基礎情報</h3>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>創業年数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number01.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number01_pc.jpg">
							</div>
						</div>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>役員・社員数（連結）</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number02.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number02_pc.jpg">
							</div>
						</div>
					</div><!-- graph_wrapper -->
					<div class="graph_wrapper effect animate-fadeup">
						<h3 class="graph_ttl">事業</h3>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>支援企業数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number03.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number03_pc.jpg">
							</div>
						</div>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>受講者数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number04.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number04_pc.jpg">
							</div>
						</div>
					</div><!-- graph_wrapper -->
					<div class="graph_wrapper effect animate-fadeup">
						<h3 class="graph_ttl">社員構成</h3>
						<div class="graph_item pc31">
							<h4 class="item_ttl"><span>平均年齢</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number05.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number05_pc.jpg">
							</div>
						</div>
						<div class="graph_item pc32">
							<h4 class="item_ttl"><span>男女比</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number06.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number06_pc.jpg">
							</div>
						</div>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>新卒・中途比率</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number07.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number07_pc.jpg">
							</div>
						</div>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>文系・理系比率</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number08.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number08_pc.jpg">
							</div>
						</div>
						<div class="graph_item pc32">
							<h4 class="item_ttl"><span>出身地割合</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number09.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number09_pc.jpg">
							</div>
						</div>
						<div class="graph_item pc31">
							<h4 class="item_ttl"><span>女性管理職比率</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number10.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number10_pc.jpg">
							</div>
						</div>
					</div><!-- graph_wrapper -->
					<div class="graph_wrapper effect animate-fadeup">
						<h3 class="graph_ttl">働き方</h3>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>平均残業時間</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number11.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number11_pc.jpg">
							</div>
						</div>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>年間休日日数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number12.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number12_pc.jpg">
							</div>
						</div>
						<div class="graph_item triple_pc">
							<h4 class="item_ttl"><span>リモートワーク頻度(週)</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number13.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number13_pc.jpg">
							</div>
						</div>
						<div class="graph_item triple_pc">
							<h4 class="item_ttl"><span>育児休業取得率</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number14.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number14_pc.jpg">
							</div>
						</div>
						<div class="graph_item triple_pc">
							<h4 class="item_ttl"><span>平均通勤時間</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number15.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number15_pc.jpg">
							</div>
						</div>
					</div><!-- graph_wrapper -->
					<div class="graph_wrapper effect animate-fadeup">
						<h3 class="graph_ttl">カルチャー</h3>
						<div class="graph_item half_pc">
							<h4 class="item_ttl"><span>部活動の数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number16.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number16_pc.jpg">
							</div>
						</div>
						<div class="graph_item half half_pc">
							<h4 class="item_ttl"><span>飲み会回数(月)</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number17.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number17_pc.jpg">
							</div>
						</div>
						<div class="graph_item half triple_pc">
							<h4 class="item_ttl"><span>保有資格の数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number18.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number18_pc.jpg">
							</div>
						</div>
						<div class="graph_item half triple_pc">
							<h4 class="item_ttl"><span>業務に生かせる資格の数</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number19.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number19_pc.jpg">
							</div>
						</div>
						<div class="graph_item half triple_pc">
							<h4 class="item_ttl"><span>趣味トップ3</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number20.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number20_pc.jpg">
							</div>
						</div>
					</div><!-- graph_wrapper -->
					<div class="graph_wrapper">
						<h3 class="graph_ttl">メンバーに聞きました</h3>
						<div class="graph_item full effect animate-fadeup">
							<h4 class="item_ttl"><span>会社のどんなところが好き？</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number21.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number21_pc.jpg">
							</div>
						</div>
						<div class="graph_item full effect animate-fadeup">
							<h4 class="item_ttl"><span>やりがいを感じるのは？</span></h4>
							<div class="img_wrap">
								<img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number22.jpg">
								<img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/number/number22_pc.jpg">
							</div>
						</div>
					</div>
				</div><!-- comp-number-graph -->
			</div><!-- section_inner -->
		</section>
		<?php get_template_part("parts/recruit");?>
	</article>
	<?php get_template_part("parts/hummenu");?>
	<?php get_template_part("parts/footer"); ?>
</body>
	<?php get_template_part("parts/script"); ?>
</html>

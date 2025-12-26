<!doctype html>
<html>

<head>
  <?php get_template_part("parts/head"); ?>
</head>

<?php
  $post_per_page = 12;
  $wp_query2 = new WP_Query();
  $param2 = array(
    'post_type' => 'iterview',
    'post_status' => 'publish',
  );
  $the_query2 = new WP_Query( $param2 );
  $post_num = $the_query2->found_posts;
  $page_num = $post_num / $post_per_page;
  $pager_num = ceil($page_num);
  wp_reset_query();
?>

<body>
  <?php get_template_part("parts/header"); ?>
  <article id="interviewList" class="page-interview-list" pager="<?= $pager_num;?>">
    <section class="section-underpage-main comp-underpage-main">
      <div class="main_img">
        <img class="sp_img" src="<?php echo get_template_directory_uri();?>/assets/img/interview/main.jpg">
        <img class="pc_img" src="<?php echo get_template_directory_uri();?>/assets/img/interview/main_pc.jpg">
      </div>
      <h1 class="underpage_ttl effect animate-fadeup">メンバーインタビュー</h1>
    </section>
    <section class="section-underpage-contents comp-first-contents gray">
      <div class="section_inner effect animate-fadeup">
        <div class="inner_box">
          <div class="category_wrapper">
            <div class="comp-category-list">
              <div class="category_item">
                <a class="active" href="/recruit/interview"><span class=>#</span>すべて</a>
              </div>
              <?php
              // カスタム分類名
              $taxonomy = 'interview-category';
              $args = array(
                'pad_counts' => true,
                'hide_empty' => true,
              );
              $terms = get_terms( $taxonomy , $args );
              if ( count( $terms ) != 0 ) {
                foreach ( $terms as $term ) {
                  $term_id = $term->term_id;
                  $term_name = $term->name;
                  $term_slug = $term->slug;
                  $term_idsp = $taxonomy."_".$term_id;
                  $term_link = get_term_link( $term, $taxonomy );
                  if ( is_wp_error( $term_link ) ) {
                    continue;
                  }
                  echo '<div class="category_item"><a href="'.esc_url( $term_link ).'" class="'.$term_slug.'"><span>#</span>'.$term_name.'</a></div>';
                }
              }
              ?>
            </div><!-- comp-category-list -->
          </div><!-- category_wrapper -->
          <div class="comp-interview-list">
            <?php
              $order = 0;
              $paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
              $wp_query = new WP_Query();
              $param = array(
                'posts_per_page' => '12',
                'order' => 'DESC',
                'post_type' => 'interview',
                'paged' => $paged,
                'post_status'  => 'publish'
              );
              $the_query = new WP_Query( $param );
              $article_num = $the_query->found_posts;
              $wp_query->query($param);
              $post_per_page = 12;
              $page_num = $article_num / $post_per_page;
              $pager_num = ceil($page_num);
              $wp_query->query($param);
              if($wp_query->have_posts()): while($wp_query->have_posts()) : $wp_query->the_post();
              $post_id = get_the_ID();
              $post_id = get_the_ID();
              $page_ttl = get_the_title($post_id);
              $date = get_the_date('Y.m.d');
              $image = get_the_post_thumbnail_url($id, 'full');
							$image_sp = get_the_post_thumbnail_url($id, 'full');
              /* カテゴリー */
              $terms = get_the_terms($post->ID, 'interview-category');
            ?>
            <div class="interview_item">
              <div class="interview_img">
                <a href="<?php the_permalink();?>">
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
                <h3 class="interview_ttl"><a href="<?php the_permalink();?>"><?= $page_ttl;?></a></h3>
                <div class="interview_lower">
                  <div class="date"><?= $date;?></div>
                  <div class="link_button">
                    <a href="<?php the_permalink();?>">
                      <span class="txt">記事を読む</span>
                      <span class="arrow"></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <?php endwhile; else : endif; wp_reset_postdata();?>
          </div>
          <?php
            if($paged == 0){$paged = 1;}
            $previous_paged = $paged - 1;
            $next_paged = $paged + 1;
          ?>
          <?php if ($pager_num > 1) :?>
          <div class="comp-pager">
            <div class="comp_inner">
              <?php if ($paged != 1){
                echo '<a class="link previous" href="'.site_url().'/interview/page/'.$previous_paged.'/"><span>前へ</span></a>';
              }else{
                echo '<a class="link previous disabled" style="pointer-events: none; opacity: 0.5; background: #f8f8f8;" href="'.site_url().'/interview/page/'.$previous_paged.'/"><span>前へ</span></a>';
              };?>
              <div class="pager_select">
                <select class="pjax-select" name="pager" onchange="location.href=value;">
                  <?php for ($i = 1; $i <= $pager_num; $i++) {
                    if ($i == $paged){
                      echo '<option value="'.site_url().'/interview/page/'.$i.'/" selected="selected">'.$i.'/'.intval($pager_num).'</option>';
                    }else{
                      echo '<option value="'.site_url().'/interview/page/'.$i.'/">'.$i.'/'.intval($pager_num).'</option>';
                    }
                  };?>
                </select>
                <div class="pager_select_label">
                <?php for ($i = 1; $i <= $pager_num; $i++) {
                  if ($i == $paged){
                    echo '<span class="label_text">'.$i.'<span class="label_divider">/</span>'.intval($pager_num).'</span>';
                  }
                };?>
                <span class="label_arrow"></span>
                </div>
              </div>
              <?php if ($paged != intval($pager_num)){
                echo '<a class="link next" href="'.site_url().'/interview/page/'.$next_paged.'/"><span>次へ</span></a>';
              }else{
                echo '<a class="link next disabled" style="pointer-events: none; opacity: 0.5; background: #f8f8f8;" href="'.site_url().'/interview/page/'.$next_paged.'/"><span>次へ</span></a>';
              };?>
            </div><!-- comp_inner -->
          </div><!-- comp-pager -->
          <?php endif; ?>
        </div><!-- inner_box -->
      </div><!-- section_inner -->
    </section>
    <?php get_template_part("parts/recruit"); ?>
  </article>
  <?php get_template_part("parts/hummenu"); ?>
  <?php get_template_part("parts/footer"); ?>
</body>
  <?php get_template_part("parts/script");?>
</html>

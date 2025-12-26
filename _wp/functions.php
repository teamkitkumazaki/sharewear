<?php
global $wp_rewrite;
$wp_rewrite->flush_rules();

//
add_image_size('small', 160, 9999);

add_filter('redirect_canonical','disable_redirect_canonical');

add_theme_support('post-thumbnails');

function disable_redirect_canonical( $redirect_url ) {
  if (is_single()){
    $redirect_url = false;
    return $redirect_url;
  }
}

/*update_option( 'siteurl', 'https://izumigaoka-cc.com//' );
update_option( 'home', 'https://izumigaoka-cc.com/' );*/


function remove_menus() {
  remove_menu_page( 'edit.php' ); // 投稿
}

add_action( 'admin_menu', 'remove_menus', 999 );

//カスタム投稿タイプの追加
add_action( 'init', 'create_post_type' );
function create_post_type() {
  $customPostSupports = [  // supports のパラメータを設定する配列（初期値だと title と editor のみ投稿画面で使える）
    'title',  // 記事タイトル,
    'editor',  // 記事本文
    'custom-fields' ,//カスタムフィールド
    'thumbnail',  // アイキャッチ画像*/
  ];
  //カスタム投稿タイプ１（商品）
  register_post_type(
    'interview',  // カスタム投稿名
    array(
      'labels' => array(
        'name' => __( 'インタビュー' ), // 管理画面の左メニューに表示されるテキスト
        'singular_name' => __( 'interview' ),
        'rewrite' => array('slug' => 'interview-post'),
        'rewrite' => array( 'with_front' => false ),
      ),
      'public' => true,  // 投稿タイプをパブリックにするか否か
      'menu_position' => 5,  // 管理画面上でどこに配置するか ※「5」で「投稿」の下に配置
      'has_archive' => true,  // アーカイブを有効にするか否か
      'supports' => array(
        'title',
        'custom-fields',
        'thumbnail'
      )
    )
  );
  register_taxonomy(
    'interview-category', //タグ名（任意）
    'interview', //カスタム投稿名
    array(
      'hierarchical' => true, //タグタイプの指定（階層をもつかどうか？）
      //ダッシュボードに表示させる名前
      'label' => 'カテゴリ',
      'show_in_rest' => true,
      'public' => true,
      'show_ui' => true,
      'rewrite' => true,
    )
  );
}

function post_output_css() {
    $pt = get_post_type();
    if ($pt == 'page' || $pt == 'post') {
        $hide_postdiv_css = '<style type="text/css">#postdiv, #postdivrich { display: none; }</style>';
        echo $hide_postdiv_css;
    }
}
add_action('admin_head', 'post_output_css');

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  if ($output) {
    $first_img = $matches [1][0];
  }
  if (empty($first_img)) {
    $first_img = "no_image";
  }
  return $first_img;
}

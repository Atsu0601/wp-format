<?php

//削除　停止ーーーーーーーーーーーー
// ヘッダーにある不要なタグを削除する
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_print_styles', 8);
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'recent_comments_style');

// 管理画面　WP ロゴ削除
function hide_admin_logo()
{
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'hide_admin_logo');


//JS cssのversionを隠す
function remove_cssjs_ver($src)
{
  if (strpos($src, '?ver='))
    $src = remove_query_arg('ver', $src);
  return $src;
}
add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('wp_get_attachment_image_attributes', 'my_get_attachment_image_attributes', 10, 2);
function my_get_attachment_image_attributes($attr, $attachment)
{
  $attr['alt'] = $attr['title'] = '';
  return $attr;
}

// 抜粋文字数
function custom_excerpt_length($length)
{
  return 100;
}
add_filter('excerpt_length', 'custom_excerpt_length');

//抜粋の文末文字を指定
function custom_excerpt_more($more)
{
  return ' ... ';
}
add_filter('excerpt_more', 'custom_excerpt_more');


// 機能有効化
/* アイキャッチ画像 */
add_theme_support('post-thumbnails');

//ビジュアルエディタ
add_editor_style(array('css/editor-style.css'));

// 自動フィードリンク
add_theme_support('automatic-feed-links');



//管理画面記事一覧ページにサムネイル表示
function customize_manage_posts_columns($columns)
{
  $columns['thumbnail'] = __('Thumbnail');
  return $columns;
}
add_filter('manage_posts_columns', 'customize_manage_posts_columns');

function customize_manage_posts_custom_column($column_name, $post_id)
{
  if ('thumbnail' == $column_name) {
    $thum = get_the_post_thumbnail($post_id, 'small', array('style' => 'width:100px;height:auto;'));
  }
  if (isset($thum) && $thum) {
    echo $thum;
  } else {
    echo __('None');
  }
}
add_action('manage_posts_custom_column', 'customize_manage_posts_custom_column', 10, 2);



/**
 * 投稿の設定変更
 * post_has_archive()
 *
 * @param object $args args.
 * @param string $post_type post_type.
 * @return object $args args.
 */
// function post_has_archive( $args, $post_type ) {
//     if ( 'post' === $post_type ) {
//         $args['rewrite']     = true;
//         $args['has_archive'] = 'news';
//     }
//     return $args;
// }
// add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

/**
 * 投稿のパーマリンク変更.
 * add_article_post_permalink()
 *
 * @param string $permalink permalink.
 * @return string $permalink permalink.
 */
// function add_article_post_permalink( $permalink ) {
//     $permalink = '/news' . $permalink;
//     return $permalink;
// }
// add_filter( 'pre_post_link', 'add_article_post_permalink' );

/**
 * 投稿のリライトルール変更
 * add_article_post_rewrite_rules()
 *
 * @param object $post_rewrite post_rewrite.
 * @return string $return_rule return_rule.
 */
// function add_article_post_rewrite_rules( $post_rewrite ) {
//     $return_rule = array();
//     foreach ( $post_rewrite as $regex => $rewrite ) {
//         $return_rule[ 'news/' . $regex ] = $rewrite;
//     }
//     return $return_rule;
// }
// add_filter( 'post_rewrite_rules', 'add_article_post_rewrite_rules' );


//コピーライトの自動取得
function get_copyright_date () {
	$all_posts = get_posts('post_status=publish&order=ASC');
	$first_post = $all_posts[0];
	$then = get_the_date('Y', $first_post);
	$now = date('Y');
	if ($then < $now) {
		return $then.' - '.$now;
	} else {
		return $then;
	}
}


// imgタグのpタグを削除
function filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


// プラグイン自動インストール
require get_parent_theme_file_path( '/plugins/tgm-plugin-activation/tgm-plugin-activation/tgm-config.php' );



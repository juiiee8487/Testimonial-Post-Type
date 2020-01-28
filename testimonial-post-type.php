<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://profiles.wordpress.org/juiiee8487
 * @since             1.1
 * @package           Testimonial_Post_Type
 *
 * @wordpress-plugin
 * Plugin Name:       Testimonial Post Type
 * Plugin URI:        https://wordpress.org/plugins/testimonial-post-type/
 * Description:       Create a Testimonial post types, it's Taxonomy & Tags with Slider Shortcode.
 * Version:           1.1
 * Author:            Elsner Technologies Pvt. Ltd.
 * Author URI:        http://www.elsner.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       testimonial-post-type
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-testimonial-post-type-activator.php
 */
function activate_testimonial_post_type() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-post-type-activator.php';
	Testimonial_Post_Type_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-testimonial-post-type-deactivator.php
 */
function deactivate_testimonial_post_type() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-post-type-deactivator.php';
	Testimonial_Post_Type_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_testimonial_post_type' );
register_deactivation_hook( __FILE__, 'deactivate_testimonial_post_type' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-post-type.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_testimonial_post_type() {

	$plugin = new Testimonial_Post_Type();
	$plugin->run();

}
run_testimonial_post_type();


define('TPT_SLIDER_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('tpt_slider_plugin_dir', plugin_dir_path( __FILE__ ) );


function tpt_slider_load_textdomain(){
	load_plugin_textdomain('tptslider', false, dirname(plugin_basename( __FILE__ )) . '/languages/');
}
add_action('plugins_loaded', 'tpt_slider_load_textdomain');




function tpt_slider_script_initial(){
 wp_enqueue_style('tpt-slider-transitions-css', TPT_SLIDER_PLUGIN_PATH.'css/owl.transitions.css');
 wp_enqueue_style('tpt-slider-slider-css', TPT_SLIDER_PLUGIN_PATH.'css/owl.carousel.css');
 wp_enqueue_style('tpt-slider-awesome-css', TPT_SLIDER_PLUGIN_PATH.'css/font-awesome.css');
 wp_enqueue_style('tpt-slider-theme-css', TPT_SLIDER_PLUGIN_PATH.'css/owl.theme.css');
 wp_enqueue_script('tpt-slider-slider-js', plugins_url( '/js/owl.carousel.js', __FILE__ ), array('jquery'), '1.0', false);
 }
add_action('wp_enqueue_scripts', 'tpt_slider_script_initial');


// Post thumbnails
if (function_exists('add_theme_support')) {
  add_theme_support('post-thumbnails');
}
add_image_size( 'post-slider-thumb', 600, 400, true );


function tpt_slider_register_shortcode($atts, $content = null){
		extract(shortcode_atts( array(  
			'post_styles' => 'style1',
			'category' => '-1',
			'show_items' => '3',
			'order_by' => 'date',
			'order' => 'DESC',
			'number' => '-1',
			'show_pagination' => 'true',
			'auto_play' => 'true',
		), $atts));
		global $post;
		$psrndn = rand(1,1000);
		// 	query posts
		
		$args =	array ( 'post_type' => 'testimonial',
						'posts_per_page' => $number,
						'orderby' => $order_by,
						'order' => $order );
		
		if($category > -1) {
			$args['tax_query'] = array(array('taxonomy' => 'taxonomy','field' => 'slug','terms' => $category ));
		}
		
		

		
			$tptslider_query = new WP_Query( $args );
			
			
			
			
				$result='';
				if($post_styles=="style1")
					{
					$result .= '
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$("#tpt-main-slider-'.$psrndn.'").owlCarousel({
							autoPlay: '.$auto_play.',
							stopOnHover: true,
							items : '.$show_items.',
							itemsDesktop : [1199,3],
							itemsDesktopSmall : [979,3],
							navigation : false,
							navigationText : ["‹","›"],
							paginationNumbers: false,
							pagination: '.$show_pagination.',
							});
						});
					</script>';
					$result.='
					<style type="text/css">
						.elss_single_slider_items-'.$psrndn.' {
							border-bottom: medium none;
							box-shadow: none;
							margin: 0 10px;
							transition: all 0.4s ease-in-out 0s;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_post_images-'.$psrndn.'{
							position: relative;
							overflow: hidden;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_post_images-'.$psrndn.':before{
							content: "";
							width: 100%;
							height: 100%;
							position: absolute;
							top: 0;
							left: 0;
							background: rgba(0, 0, 0, 0);
							transition: all 0.4s linear 0s;
						}
						.elss_single_slider_items-'.$psrndn.':hover .elss_single_slider_items_post_images-'.$psrndn.':before{
							background: rgba(0, 0, 0, 0.6);
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_post_images-'.$psrndn.' img{
							width: 100%;
							height: auto;
						}
						.elss_single_slider_items-'.$psrndn.' img {
						  border-radius: 0;
						  box-shadow: none;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_category-'.$psrndn.' {
							width: 100%;
							font-size: 16px;
							color: #fff;
							line-height: 11px;
							text-align: center;
							text-transform: capitalize;
							padding: 11px 0;
							background: #ff9412;
							position: absolute;
							bottom: 0;
							left: -100%;
							transition: all 0.5s ease-in-out 0s;
						}
						.elss_single_slider_items-'.$psrndn.':hover .elss_single_slider_items_category-'.$psrndn.'{
							left: 0;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_item_reviews-'.$psrndn.'{
							padding: 20px 20px;
							background: #fff;
							position: relative;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_item_post_title-'.$psrndn.'{
							margin: 0;
						}
						.elss_single_slider_item_reviews-'.$psrndn.' h3.elss_single_slider_item_post_title-'.$psrndn.' {
						  font-size: 15px;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_item_post_title-'.$psrndn.' a{
							border-bottom: medium none;
							color: #ff9412;
							display: inline-block;
							font-size: 15px;
							font-weight: normal;
							letter-spacing: 2px;
							margin-bottom: 25px;
							text-decoration: none;
							transition: all 0.3s linear 0s;
							box-shadow: none;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_item_post_title-'.$psrndn.' a:hover{
							text-decoration: none;
							color: #555;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_item_description-'.$psrndn.'{
							font-size: 15px;
							color: #555;
							line-height: 26px;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_category-'.$psrndn.' > a {
						  border: medium none;
						  box-shadow: none;
						  color: #000;
						  margin-right: 8px;
						  text-decoration: none;
						}
						.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_category-'.$psrndn.' > a:hover {
						  color: #fff;
						}
						.elss_single_slider_item_reviews-'.$psrndn.' .elss_single_slider_admin_description-'.$psrndn.'{
							margin-top: 20px;
						}
						.elss_single_slider_admin_description-'.$psrndn.' span{
							display: inline-block;
							font-size: 14px;
						}
						.elss_single_slider_admin_description-'.$psrndn.' span i{
							margin-right: 5px;
							color: #999;
						}
						.elss_single_slider_admin_description-'.$psrndn.' span a{
							color: #999;
							text-transform: uppercase;
						}
						.elss_single_slider_admin_description-'.$psrndn.' span a:hover{
							text-decoration: none;
							color: #ff9412;
						}
						.elss_single_slider_admin_description-'.$psrndn.' span.comments{
							float: right;
						}
						@media only screen and (max-width: 359px) {
							.elss_single_slider_items-'.$psrndn.' .elss_single_slider_items_category-'.$psrndn.'{ font-size: 13px; }
						}
					</style>';
					$result.='<div class="tpt-slider-area'.$psrndn.'">';
					$result.='<div id="tpt-main-slider-'.$psrndn.'" class="owl-carousel">';
					// Creating a new side loop
					while ( $tptslider_query->have_posts() ) : $tptslider_query->the_post();
						
						$catid = get_the_ID();
						$cats = get_the_category($catid);
						
						setup_postdata( $post );
						$excerpt = get_the_excerpt();

						$result.='
						<div class="elss_single_slider_items-'.$psrndn.'">
							<div class="elss_single_slider_items_post_images-'.$psrndn.'">';
								if ( has_post_thumbnail() ) {
									$result .= '<div class="elss-slider-thumb">';
									$result .= '<a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail( $post->ID, 'post-slider-thumb', array( 'class' => "img-responsive" ) ).'</a>';
									$result .= '</div>';
								}
								$result.='<div class="elss_single_slider_items_category-'.$psrndn.'">';
								foreach ( $cats as $cat ){
									$result.='<a href="'.get_category_link($cat->cat_ID).'">'.$cat->name.'</a>';
									
								}
								
								$result.='</div>';
							$result.='</div>
							<div class="elss_single_slider_item_reviews-'.$psrndn.'">
								<h3 class="elss_single_slider_item_post_title-'.$psrndn.'"><a href="'.esc_url(get_the_permalink()).'">'.esc_attr(get_the_title()).'</a></h3>
								<div class="elss_single_slider_item_description-'.$psrndn.'">'.wpautop($excerpt).'
								</div>
								<div class="elss_single_slider_admin_description-'.$psrndn.'">
									<span><i class="fa fa-user"></i> <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ).'">'.get_the_author().'</a></span>
								</div>
							</div>
						</div>

						';

							
							
					endwhile;
					wp_reset_postdata();
								
					$result .='</div></div><div class="clearfix"></div>';
			
					return $result; 
					}
				if($post_styles=="style2")
					{
					$result .= '
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$("#tpt-main-slider-'.$psrndn.'").owlCarousel({
							autoPlay: '.$auto_play.',
							stopOnHover: true,
							items : '.$show_items.',
							itemsDesktop : [1199,3],
							itemsDesktopSmall : [979,3],
							navigation : false,
							navigationText : ["‹","›"],
							paginationNumbers: false,
							pagination: '.$show_pagination.',
							});
						});
					</script>';
					$result.='
					<style type="text/css">
						.post_slider_'.$psrndn.'_style_two{
							padding: 0 15px;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_img{
							position: relative;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_img > a{
							display:block;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_img img{
							border-radius: 0;
							box-shadow: none;
							height: auto;
							width: 100%;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_img:hover:before{
							content: "";
							position: absolute;
							width: 100%;
							height:100%;
							background-color: rgba(220, 0, 90, 0.6);
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_img:hover:after{
							opacity: 1;
							transform: scale(1);
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_title{
							margin-bottom: 10px;
							margin-top: 10px;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_title > a{
							color:#222;
							display: block;
							font-size: 17px;
							font-weight: 600;
							text-transform: uppercase;
							text-decoration:none;
							border-bottom:none;
							box-shadow: none;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_title > a:hover{
							text-decoration: none;
							color:#dc005a;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_bar{
							padding: 0;
							list-style: none;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_bar > li{
							display: inline-block;
							margin: 0 15px 0 0;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_date,
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_author,
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_author > a{
							color:#8f8f8f;
							font-size: 12px;
							margin-right: 16px;
							text-transform: uppercase;
							font-style: italic;
							text-decoration:none;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_date > i,
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_author > i{
							margin-right: 5px;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_author > a:hover{
							color:#dc005a;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_description{
							color:#8f8f8f;
							font-size: 14px;
							line-height: 24px;
							padding-top: 5px;
						}
						.post_slider_'.$psrndn.'_style_two .post_slider_'.$psrndn.'_style_post_description:before{
							content: "";
							display: block;
							border-top: 4px solid #dc005a;
							padding-bottom: 12px;
							width: 50px;
						}
					</style>';
					$result.='<div class="tpt-slider-area'.$psrndn.'">';
					$result.='<div id="tpt-main-slider-'.$psrndn.'" class="owl-carousel">';
					// Creating a new side loop
					while ( $tptslider_query->have_posts() ) : $tptslider_query->the_post();
						
						$catid = get_the_ID();
						$cats = get_the_category($catid);
						
						setup_postdata( $post );
						$excerpt = get_the_excerpt();

						$result.='
						<div class="post_slider_'.$psrndn.'_style_two">
								<div class="post_slider_'.$psrndn.'_style_img">';
								if ( has_post_thumbnail() ) {
									$result .= '<div class="elss-slider-thumb-style2">';
									$result .= '<a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail( $post->ID, 'post-slider-thumb', array( 'class' => "img-responsive" ) ).'</a>';
									$result .= '</div>';
								}
								$result.='</div>
							<h5 class="post_slider_'.$psrndn.'_style_title">
								<a href="'.esc_url(get_the_permalink()).'">'.esc_attr(get_the_title()).'</a>
							</h5>
							<ul class="post_slider_'.$psrndn.'_style_bar">
								<li class="post_slider_'.$psrndn.'_style_post_date">
								<i class="fa fa-calendar"></i> '.get_the_date('Y-m-d').'</li>
								<li class="post_slider_'.$psrndn.'_style_post_author">
								<i class="fa fa-user"></i>
								<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ).'">'.get_the_author().'</a></li>
							</ul>'.wpautop($excerpt).'
						</div>';
							
					endwhile;
					wp_reset_postdata();
								
					$result .='</div></div><div class="clearfix"></div>';
			
					return $result; 
					}
				if($post_styles=="style3")
					{
					$result .= '
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							$("#tpt-main-slider-'.$psrndn.'").owlCarousel({
							autoPlay: '.$auto_play.',
							stopOnHover: true,
							items : '.$show_items.',
							itemsDesktop : [1199,3],
							itemsDesktopSmall : [979,3],
							navigation : false,
							navigationText : ["‹","›"],
							paginationNumbers: false,
							pagination: '.$show_pagination.',
							});
						});
					</script>';
					$result.='
					<style type="text/css">
						.post_slider_'.$psrndn.'_style3{
							border: 1px solid #eee;
							padding: 20px;
							margin: 0 15px;
							position: relative;
						}
						.post_slider_'.$psrndn.'_style3:before{
							content: "";
							border-top:1px solid transparent;
							position: absolute;
							top:0;
							left:0;
							width: 100%;
							transition:all 0.3s ease-in-out 0s;
						}
						.post_slider_'.$psrndn.'_style3:hover:before{
							border-top: 1px solid #3398db;
						}
						.post_slider_'.$psrndn.'_style3:hover{
							border-top: 1px solid #3398db;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_img > img{
							width: 100%;
							height:auto;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_title > a{
							font-size: 20px;
							text-transform: capitalize;
							color:#333;
							transition:all 0.3s ease-in-out 0s;
							text-decoration:none;
							border-bottom:none;
							box-shadow: none;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_title > a:hover{
							text-decoration: none;
							color:#3398db;
							text-decoration:none;
							
						}
						.elss-slider-thumb-style3 a img {
						  border-radius: 0;
						  box-shadow: none;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_bars{
							padding: 0;
							list-style: none;
							overflow: hidden;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_bars > li{
							border-right: 1px solid #999;
							display: inline-block;
							float: left;
							margin: 0;
							padding: 0 10px;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_bars > li:first-child{
							padding: 0 10px 0 0;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_bars > li:last-child{
							border: 0px none;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_dates,
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_autors,
						.post_slider_'.$psrndn.'_style3 .comment{
							color:#3398db;
							text-transform: uppercase;
							font-size: 11px;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_autors > a,
						.post_slider_'.$psrndn.'_style3 .comment > a,
						.post_slider_'.$psrndn.'_style3 .comment > i{
							color:#999;
							transition:all 0.3s ease-in-out 0s;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_autors > a:hover,
						.post_slider_'.$psrndn.'_style3 .comment > a:hover{
							text-decoration: none;
							color:#333;
						}
						.post_slider_'.$psrndn.'_style3 .comment > i{
							margin-right: 8px;
							font-size: 15px;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_p_description{
							line-height: 1.7;
							color:#666;
							font-size: 13px;
							margin-bottom: 20px;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_p_readmores{
							display: inline-block;
							padding: 10px 35px;
							background: #3398db;
							color: #ffffff;
							border-radius: 5px;
							font-size: 15px;
							font-weight: 900;
							letter-spacing: 1px;
							line-height: 20px;
							margin-bottom: 5px;
							text-transform: uppercase;
							transition:all 0.3s ease-in-out 0s;
							text-decoration:none;
						}
						.post_slider_'.$psrndn.'_style3 .post_slider_'.$psrndn.'_style3_p_readmores:hover{
							text-decoration: none;
							color:#fff;
							background: #333;
						}
						@media only screen and (max-width: 360px) {
							.post_slider_'.$psrndn.'_style3_bars > li:last-child{
								margin-top: 8px;
								padding: 0;
							}
						}
					</style>';
					$result.='<div class="tpt-slider-area'.$psrndn.'">';
					$result.='<div id="tpt-main-slider-'.$psrndn.'" class="owl-carousel">';
					// Creating a new side loop
					while ( $tptslider_query->have_posts() ) : $tptslider_query->the_post();
						
						$catid = get_the_ID();
						$cats = get_the_category($catid);
						
						setup_postdata( $post );
						$excerpt = get_the_excerpt();

					$result.='
					<div class="post_slider_'.$psrndn.'_style3">
						<div class="post_slider_'.$psrndn.'_style3_img">';
							if ( has_post_thumbnail() ) {
								$result .= '<div class="elss-slider-thumb-style3">';
								$result .= '<a href="'.esc_url(get_the_permalink()).'">'.get_the_post_thumbnail( $post->ID, 'post-slider-thumb', array( 'class' => "img-responsive" ) ).'</a>';
								$result .= '</div>';
							}
						$result.='</div>
						<h5 class="post_slider_'.$psrndn.'_style3_title"><a href="'.esc_url(get_the_permalink()).'">'.esc_attr(get_the_title()).'</a></h5>
						<ul class="post_slider_'.$psrndn.'_style3_bars">
							<li class="post_slider_'.$psrndn.'_style3_dates">'.get_the_date('Y-m-d').'</li>
							<li class="post_slider_'.$psrndn.'_style3_autors"><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ).'">'.get_the_author().'</a></li>
						</ul>'.wpautop($excerpt).'
						<a href="'.esc_url(get_the_permalink()).'" class="post_slider_'.$psrndn.'_style3_p_readmores">more</a>
					</div>';

					endwhile;
					wp_reset_postdata();
								
					$result .='</div></div><div class="clearfix"></div>';
			
					return $result; 
					}
				else{
					
					echo 'Nothing Found !!';
					
				}

		
}
add_shortcode('tptslider', 'tpt_slider_register_shortcode');

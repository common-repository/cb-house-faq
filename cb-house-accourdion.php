<?php 
/*
Plugin Name: Cb House FAQ
Plugin URI: http://www.developernayon.com/plugin/cb-house-faq
Author: Jahedul Islam Nayon
Author URI: http://www.developernayon.com
Version: 1.0
Description: Show display FAQ shortcode [cb_house_accordion]
*/

define('CB_HOUSE_FAQ_POST_URL', plugin_dir_url(__FILE__));


//Enqueue style for the plugin
function cb_house_faqs_script(){

	wp_enqueue_style('boostrap', CB_HOUSE_FAQ_POST_URL.'css/bootstrap.min.css');
	wp_enqueue_style('faq-style', CB_HOUSE_FAQ_POST_URL.'css/style.css');

	wp_enqueue_script('boostrap', CB_HOUSE_FAQ_POST_URL.'js/bootstrap.min.js', array('jquery'),'4.3.1',true);

}
add_action('wp_enqueue_scripts','cb_house_faqs_script');


//Register Shortcode
function cb_house_faq($attrs, $content = NULL){
	ob_start();
	extract(shortcode_atts(array(

		'post_type'		=> 'post',
		'post_count'	=> 5,

	),$attrs)); 

	?>

	<div class="container">
		<div class="home-solvers-faq">
			<!--Accordion wrapper-->
			<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

				<?php  $p_house_faq = new WP_Query(array(
					'post_type'			=> $post_type,
					'posts_per_page'	=> $post_count,
				));

				if($p_house_faq->have_posts()) : while($p_house_faq->have_posts()) : $p_house_faq->the_post(); ?>

					<!-- Accordion card -->
					<div class="card">
						<!-- Card header -->
						<div class="card-header" role="tab" id="heading<?php echo get_the_ID(); ?>">
							<a data-toggle="collapse" data-parent="#accordionEx" href="#collapse<?php echo get_the_ID(); ?>" aria-expanded="true"
								aria-controls="collapse<?php echo get_the_ID(); ?>" class="collapsed">
								<h5 class="mb-0">
									<?php the_title(); ?>
									<i class="fas fa-angle-down rotate-icon"></i>
								</h5>
							</a>
						</div>
						<!-- Card body -->
						<div id="collapse<?php echo get_the_ID(); ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo get_the_ID(); ?>"
							data-parent="#accordionEx">
							<div class="card-body">
								<?php the_content(); ?>
							</div>
						</div>

					</div>
					<!-- Accordion card -->
				<?php endwhile; endif; ?>

			</div>
			<!-- Accordion wrapper -->
		</div>
		<!--/house faq end -->
	</div>



	<?php 
	
	return ob_get_clean();
}

add_shortcode('cb_house_accordion','cb_house_faq'); 
<?php
/**
 * Front page template file.
 *
 * @author  Tomo Zaidem
 * @package Gloss_Dev_Test
 * @version 1.0.0
 */
defined( 'ABSPATH' ) || die();

get_header();

if( have_rows('info_blocks') ):
	$row = 0;
	while ( have_rows('info_blocks') ) : the_row();
		$row++;
		$info_meta = array();
		$info_meta['info_title'] = get_sub_field('info_title');
		$info_meta['info_content'] = get_sub_field('info_content');
		$info_meta['info_image'] = get_sub_field('info_image');
		$info_meta['info_button_enabled'] = get_sub_field('info_button_enabled');
		$info_meta['info_button_text'] = get_sub_field('info_button_text');
		$info_meta['info_button_type'] = get_sub_field('info_button_type');
		$info_meta['info_page_link'] = get_sub_field('info_page_link');
		$info_meta['info_post_link'] = get_sub_field('info_post_link');
		$info_meta['info_attachment_link'] = get_sub_field('info_attachment_link');
		$info_meta['info_external_url'] = get_sub_field('info_external_url');
		$info_meta['info_new_tab'] = get_sub_field('info_new_tab');
		$info_meta['info_even'] = ( ($row % 2) == 0 ) ? true:false;

		gt_render_template_part( 'templates/home/info', 'block', $info_meta );

	endwhile;

endif;

$team_args = array(
	'post_type'   => 'gt_team_section',
	'post_status' => 'publish',
	'order'       => 'ASC'
);

$team_members = new WP_Query( $team_args );

if( $team_members->have_posts() ) :?>

<section class="team__wrap">
	<div class="team__wrap-inner">
		<h3 class="team__title">Lorem Ipsum Dolor Sit Amet</h3>
		<h4 class="team__subtitle">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</h4>
		<div class="team__section-wrap">
			<?php
			while( $team_members->have_posts() ) :
				$team_members->the_post();
				$member_id = get_the_ID();
				$team_meta = array();

				$team_meta['name'] = get_the_title();
				$team_meta['position'] = get_field('position', $member_id);
				$team_meta['image'] = get_field('image', $member_id);

				gt_render_template_part( 'templates/home/team', 'block', $team_meta );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<?php
endif;
?>
<section class="cta-section__wrap">
	<div class="cta-section__wrap-inner">
		<h5 class="cta-section__tagline">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h5>
		<a class="btn btn-outline-secondary btn-lg cta-section__btn" href="#">Improve Thinking</a>
	</div>
</section>
<?php

get_footer();
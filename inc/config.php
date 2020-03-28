<?php
/**
 * Main application configuration file.
 * Used to configure set of services that available in the application.
 *
 * @author    Tomo Zaidem
 * @package   Gloss_Dev_Test
 * @version   1.0.0
 */

return array(
	'app' => array(
		'GT_Application',
	),
	'register' => array(
		'BT_Register',
		array(
			'data' => array(
				'autoinit_services' => array(
					'image_manager',
				),
			),
		),
	),
	'header_section' => array(
		'GT_Header_Section',
	),
	'image_manager' => array(
		'BT_Image_Manager',
		array(
			'sizes' => array(
				'blog_grid_thumb' => array(
					'width' => 358,
					'height' => 240,
					'crop' => true,
				),
				'featured_single' => array(
					'width' => 940,
					'height' => 406,
					'crop' => true,
				),
				'team_member_thumb' => array(
					'width' => 304,
					'height' => 308,
					'crop' => true,
				),
			),
		),
	),
);

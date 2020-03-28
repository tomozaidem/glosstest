<?php
/**
 * Team block template part.
 *
 * @author    Tomo Zaidem
 * @version   1.0.0
 */

/**
 * No direct access to this file.
 *
 * @since 1.0.0
 */
defined( 'ABSPATH' ) || die();

/**
 * Page header view for the banner mode.
 *
 * @var string $name
 * @var string $position
 * @var string $image
 */

printf( '<div class="team__member">
					<img class="team__member-image" src=%s />
					<h4 class="team__member-name">%s</h4>
					<span class="team__member-position">%s</span>
				</div>',
	$image,
	$name,
	$position
);

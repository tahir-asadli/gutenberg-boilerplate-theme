<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

if (!defined('ABSPATH')) {
	exit;
}
$name = !empty($attributes['name']) ? $attributes['name'] : '';
$title = !empty($attributes['title']) ? $attributes['title'] : '';
$quote = !empty($attributes['quote']) ? $attributes['quote'] : '';
$imageUrl = !empty($attributes['imageUrl']) ? $attributes['imageUrl'] : '';
$imageAlt = !empty($attributes['imageAlt']) ? $attributes['imageAlt'] : '';

?>
<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php if (!empty($name)) { ?>
		<h3><?php echo $name; ?></h3>
	<?php } ?>
	<?php if (!empty($title)) { ?>
		<h4><?php echo $title; ?></h4>
	<?php } ?>
	<?php if (!empty($quote)) { ?>
		<p><?php echo $quote; ?></p>
	<?php } ?>
	<?php if (!empty($imageUrl)) { ?>
		<img src="<?php echo $imageUrl; ?>" alt="<?php echo $imageAlt ? $imageAlt : ''; ?>" />
	<?php } ?>
</div>
<?php

add_action('init', function () {
  register_block_style('core/button', [
    'name' => 'blue',
    'label' => __('Blue', 'gutenberg-boilerplate'),
    'style_handle' => 'blue',
  ]);

  register_block_style('core/button', [
    'name' => 'orange',
    'label' => __('Orange', 'gutenberg-boilerplate'),
    'style_handle' => 'custom-button-styles',
  ]);
});
if (!function_exists('gb_enqueue_css')) {
  function gb_enqueue_css()
  {
    wp_enqueue_style(
      'base',
      get_parent_theme_file_uri('/assets/css/base.css'),
      array(),
      wp_get_theme()->get('Version')
    );
    wp_enqueue_style(
      'gb-style',
      get_stylesheet_uri(),
      array(),
      wp_get_theme()->get('Version')
    );
  }
  add_action('wp_enqueue_scripts', 'gb_enqueue_css');
}

function mytheme_setup_editor_styles()
{
  add_theme_support('align-wide');
  // Add theme support for editor styles.
  // add_theme_support('editor-styles');

  // add_theme_support('align-wide');

  // add_theme_support('wp-block-styles');

  // Enqueue your base.css file for the editor.
  // The path is relative to your theme's root directory.
  // add_editor_style('assets/css/base.css');
}
add_action('after_setup_theme', 'mytheme_setup_editor_styles');
// function wpdocs_theme_add_editor_styles()
// {
//   add_editor_style('/assets/css/base.css');
// }
// add_action('admin_init', 'wpdocs_theme_add_editor_styles');
?>
<?php
add_action('init', function () {
  register_block_type('my-plugin/my-php-block', array(
    "html" => false,
    'title' => 'My PHP Block',
    'icon' => 'welcome-learn-more',
    'category' => 'text',
    'attributes' => array(
      'headingText' => array(
        'type' => 'string',
        'default' => 'Hello World',
      ),
      'showBorder' => array(
        'type' => 'boolean',
        'default' => false,
      ),
    ),
    'supports' => array(
      'autoRegister' => true, // 👈 The magic flag that removes JS requirements
      'color' => true, // Inherits Gutenberg core color panel
      'spacing' => true, // Inherits Gutenberg core spacing panel
      'typography' => [
        'fontSize' => true,
        'lineHeight' => true,
        'textAlign' => true,
      ]
    ),
    'render_callback' => 'my_php_block_render_callback',
  ));
});

function my_php_block_render_callback($attributes)
{
  // Safely pull Gutenberg wrapper classes/styles (colors, padding, etc.)
  $wrapper_attributes = get_block_wrapper_attributes();

  $heading = esc_html($attributes['headingText']);
  $border_style = $attributes['showBorder'] ? 'border: 2px solid red;' : '';

  return sprintf(
    '<div %1$s style="%2$s">
            <h3>%3$s</h3>
            <p>Rendered entirely via server-side PHP!</p>
         </div>',
    $wrapper_attributes,
    esc_attr($border_style),
    $heading
  );
}
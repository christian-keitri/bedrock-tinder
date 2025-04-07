<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/src/autoguru.php';

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Timber\Timber::init();

// Sets the directories (inside your theme) to find .twig files.
Timber::$dirname = [ 'templates', 'views' ];

new AutoGuruTheme();

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');

function crb_attach_theme_options() {
  Container::make( 'theme_options', __( 'Theme Options' ) )
    ->add_fields( array(
      Field::make( 'text', 'crb_text', 'Text Field' ),
    ) );
}

add_action('after_setup_theme', 'crb_load');
function crb_load() {
  require_once __DIR__ . '/vendor/autoload.php';
  \Carbon_Fields\Carbon_Fields::boot();
}

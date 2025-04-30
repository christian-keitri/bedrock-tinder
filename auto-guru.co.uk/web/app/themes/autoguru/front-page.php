<?php
use Timber\Timber;
use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Carbon_Fields;

$context = Timber::context();

// Define default hero values
$default_hero = [
    'title'      => 'Driving the Future of Automotive Data',
    'subtitle1'  => 'Fuel your automotive business with data-driven insights, efficiency, and innovation',
    'subtitle2'  => 'Auto-Guru is your trusted partner for insights, growth, and innovation',
    'buttonText' => 'Let\'s Work Together',
    'image'      => get_template_directory_uri() . '/static/images/header2.jpg',
];

// Override with Carbon Fields if values exist
$context['hero'] = [
    'title'      => carbon_get_theme_option('hero_title') ?: $default_hero['title'],
    'subtitle1'  => carbon_get_theme_option('subtitle_1') ?: $default_hero['subtitle1'],
    'subtitle2'  => carbon_get_theme_option('subtitle_2') ?: $default_hero['subtitle2'],
    'buttonText' => carbon_get_theme_option('hero_button_text') ?: $default_hero['buttonText'],
    'image'      => wp_get_attachment_image_url(carbon_get_theme_option('hero_image'), 'full') ?: $default_hero['image'],
];

Timber::render('views/front-page.twig', $context);

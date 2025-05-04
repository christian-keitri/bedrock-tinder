<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 */

// Composer dependencies
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/autoguru.php';

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Timber\Timber;

// Initialize Timber
Timber::init();
Timber::$dirname = ['templates', 'views'];

// Initialize theme
new AutoGuruTheme();

// Init Carbon Fields
add_action('after_setup_theme', function () {
    \Carbon_Fields\Carbon_Fields::boot();
});

// Admin styles for Carbon Fields cards
add_action('admin_enqueue_scripts', function () {
    wp_register_style('crb-admin-style', false);
    wp_enqueue_style('crb-admin-style');
    wp_add_inline_style('crb-admin-style', '
        .crb-card {
            border: 3px solid rgb(17, 17, 17);
            padding: 10px;
            background: linear-gradient(135deg,rgb(34, 177, 46),rgb(5, 119, 24),rgb(105, 197, 19));
            box-shadow: 0 6px 12px rgba(178, 175, 187, 0.3);
            border-radius: 10px;
            transition: transform 0.3s ease-in-out;
        }
        .crb-card:hover {
            transform: scale(1.05);
        }
        .crb-card h2 {
            color: #ffffff;
            font-weight: bold;
        }
    ');
});


// Add Timber context for frontend sections
add_filter('timber/context', function ($context) {
    // HERO
    $default_hero = [
        'title'      => 'Driving the Future of Automotive Data',
        'subtitle1'  => 'Fuel your automotive business with data-driven insights, efficiency, and innovation',
        'subtitle2'  => 'Auto-Guru is your trusted partner for insights, growth, and innovation',
        'buttonText' => 'Let\'s Work Together',
        'image'      => get_template_directory_uri() . '/static/images/header2.jpg',
    ];

    $context['hero'] = [
        'title'      => carbon_get_theme_option('hero_title') ?: $default_hero['title'],
        'subtitle1'  => carbon_get_theme_option('hero_subtitle1') ?: $default_hero['subtitle1'],
        'subtitle2'  => carbon_get_theme_option('hero_subtitle2') ?: $default_hero['subtitle2'],
        'buttonText' => carbon_get_theme_option('hero_button_text') ?: $default_hero['buttonText'],
        'image'      => wp_get_attachment_image_url(carbon_get_theme_option('hero_image'), 'full') ?: $default_hero['image'],
    ];

    // CAROUSEL
    $default_carousel = [
        [
            'title'   => 'Auto-Code, our <br>Unique Coding <br>Solution',
            'excerpt' => 'Explore how our innovative Auto-Code technology seamlessly integrates your datasets...',
            'image'   => get_template_directory_uri() . '/static/images/Auto-Code.jpg',
            'more'    => 'Auto-Code',
            'url'     => '/auto-code',
        ],
        [
            'title'   => 'DVLA & <br>VOSA Data<br>Provider',
            'excerpt' => 'Discover our extensive automotive aftermarket data solutions...',
            'image'   => get_template_directory_uri() . '/static/images/DVLA-&-VOSA.jpg',
            'more'    => 'DVLA Data',
            'url'     => '/dvla-data',
        ],
        [
            'title'   => 'Manufacturer<br>Vehicle<br>Build Data',
            'excerpt' => 'Unlock the full potential of Manufacturer Build Data at the VIN level...',
            'image'   => get_template_directory_uri() . '/static/images/Manufacturer-Vehicle-Build.jpg',
            'more'    => 'Build Data',
            'url'     => '/build-data',
        ],
    ];
       $custom_carousel = carbon_get_theme_option('carousel_posts');
       $context['carousel_posts'] = !empty($custom_carousel) ? $custom_carousel : $default_carousel;



    // CTA
    $default_cta = [
        'image'      => get_template_directory_uri() . '/static/images/readytotake.jpg',
        'title'      => 'Ready to take your automotive<br>business to the next level?',
        'buttonText' => 'Let\'s Talk',
    ];
    $context['cta_section'] = [
        'image'      => carbon_get_theme_option('cta_image') ?: $default_cta['image'],
        'title'      => carbon_get_theme_option('cta_title') ?: $default_cta['title'],
        'buttonText' => carbon_get_theme_option('cta_button_text') ?: $default_cta['buttonText'],
    ];

    // SERVICES
    $default_services = [
        [
            'title'   => 'Service 1,<br>Placeholder<br>text for now',
            'excerpt' => 'Explore how our innovative Auto-Code techonology seamlessly integrates your datasets...',
            'image'   => get_template_directory_uri() . '/static/images/service1.jpg',
            'more'    => 'Auto-Code',
            'url'     => '/auto-code',
        ],
        [
            'title'   => 'Service 2,<br>Placeholder<br>text for now',
            'excerpt' => 'Discover our extensive automotive aftermarket data solutions...',
            'image'   => get_template_directory_uri() . '/static/images/service2.jpg',
            'more'    => 'DVLA Data',
            'url'     => '/dvla-data',
        ],
        [
            'title'   => 'Service 3,<br>Placeholder<br>text for now',
            'excerpt' => 'Unlock the full potential of Manufacturer Build Data at the VIN level...',
            'image'   => get_template_directory_uri() . '/static/images/service3.jpg',
            'more'    => 'Build Data',
            'url'     => '/build-data',
        ],
    ];
        $custom_services = carbon_get_theme_option('home_services');
        $context['services'] = !empty($custom_services) ? $custom_services : $default_services;


    // TEXT ACTION: COMPANY
    $context['text_action_company'] = [
        'title'      => carbon_get_theme_option('text_action_title') ?: 'You\'re in Good Company',
        'subtitle'   => carbon_get_theme_option('text_action_subtitle') ?: 'Auto-Guru provides customisable solutions...',
        'buttonText' => carbon_get_theme_option('text_action_button_text') ?: 'Let\'s Get Started',
    ];

    // GALLERY
     $gallery_images = carbon_get_theme_option('gallery_images');
     $default_gallery_images = [
        get_template_directory_uri() . '/static/images/bently-logo.svg',
        get_template_directory_uri() . '/static/images/bridgestone-logo.png',
        get_template_directory_uri() . '/static/images/camry-logo.png',
        get_template_directory_uri() . '/static/images/honda-logo.webp',
        get_template_directory_uri() . '/static/images/tesla-logo.jpg',
        get_template_directory_uri() . '/static/images/volvo-logo.jpg',
];


       $custom_gallery = [];
        if (is_array($gallery_images)) {
         foreach ($gallery_images as $item) {
          if (!empty($item['image'])) {
            $custom_gallery[] = $item['image'];
        }
    }
}


$context['gallery_images'] = !empty($custom_gallery) ? $custom_gallery : $default_gallery_images;


    // TEXT ACTION: TEAM
    $context['text_action_team'] = [
        'title'      => carbon_get_theme_option('text_action_team_title') ?: 'Let our team of industry experts help...',
        'subtitle'   => carbon_get_theme_option('text_action_team_subtitle') ?: 'The team at Auto-Guru have vast experience...',
        'buttonText' => carbon_get_theme_option('text_action_team_button_text') ?: 'Read Our Blog',
        'buttonUrl'  => carbon_get_theme_option('text_action_team_button_url') ?: '/blog',
    ];

    // TEAM MEMBERS
    $default_team_members = [
        ['name' => 'J Balvin',     'image' => get_template_directory_uri() . '/static/images/jbalvin.png', 'role' => 'CEO'],
        ['name' => 'Bad Bunny',    'image' => get_template_directory_uri() . '/static/images/badbunny.png', 'role' => 'CTO'],
        ['name' => 'Nicki Minaj',  'image' => get_template_directory_uri() . '/static/images/nickinminaj.png', 'role' => 'COO'],
    ];
     $custom_team_members = carbon_get_theme_option('team_members');
     $context['team_members'] = !empty($custom_team_members) ? $custom_team_members : $default_team_members;

    

    // NEWSLETTER
    $context['newsletter'] = [
        'title'    => carbon_get_theme_option('newsletter_title') ?: 'Sign up for our newsletter',
        'subtitle' => carbon_get_theme_option('newsletter_subtitle') ?: 'Be the first to receive updates from Auto-Guru...',
        'video'    => carbon_get_theme_option('newsletter_video') ?: get_template_directory_uri() . '/static/videos/newsletter-video.mp4',
    ];

    return $context;
});

// Register Theme Options (Carbon Fields)
add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', __('Theme Options'))
        ->add_fields([
            // Hero Section
            Field::make('html', 'hero_card_start')->set_html('<div class="crb-card"><h3>Hero Section</h3>'),
            Field::make('text', 'hero_title', 'Hero Title'),
            Field::make('text', 'hero_subtitle1', 'Subtitle 1'),
            Field::make('text', 'hero_subtitle2', 'Subtitle 2'),
            Field::make('text', 'hero_button_text', 'Button Text'),
            Field::make('image', 'hero_image', 'Hero Image'),
            Field::make('html', 'hero_card_end')->set_html('</div>'),

            // Carousel Section
            Field::make('html', 'carousel_card_start')->set_html('<div class="crb-card"><h3>Homepage Carousel</h3>'),
            Field::make('complex', 'carousel_posts', 'Homepage Carousel')
                ->set_layout('tabbed-horizontal')
                ->add_fields('carousel_item', [
                    Field::make('text', 'title', 'Title'),
                    Field::make('textarea', 'excerpt', 'Excerpt'),
                    Field::make('text', 'more', '"More" Label'),
                    Field::make('text', 'url', 'Button Link'),
                    Field::make('image', 'image', 'Image')->set_value_type('url'),
                ]),
            Field::make('html', 'carousel_card_end')->set_html('</div>'),

            // CTA Section
            Field::make('html', 'cta_card_start')->set_html('<div class="crb-card"><h3>CTA Section</h3>'),
            Field::make('image', 'cta_image', 'CTA Image')->set_value_type('url'),
            Field::make('text', 'cta_title', 'CTA Title'),
            Field::make('text', 'cta_button_text', 'CTA Button Text'),
            Field::make('html', 'cta_card_end')->set_html('</div>'),

            // Services Section
            Field::make('html', 'services_card_start')->set_html('<div class="crb-card"><h3>Services Carousel</h3>'),
            Field::make('complex', 'home_services', 'Homepage Services')
                ->set_layout('tabbed-horizontal')
                ->add_fields('service_item', [
                    Field::make('text', 'title', 'Title'),
                    Field::make('textarea', 'excerpt', 'Excerpt'),
                    Field::make('text', 'more', '"More" Label'),
                    Field::make('text', 'url', 'Button Link'),
                    Field::make('image', 'image', 'Image')->set_value_type('url'),
                ]),
            Field::make('html', 'services_card_end')->set_html('</div>'),

            // You're in Good Company Section
            Field::make('html', 'text_action_card_start')->set_html('<div class="crb-card"><h3>Company Text Action</h3>'),
            Field::make('text', 'text_action_title', 'CTA Title'),
            Field::make('textarea', 'text_action_subtitle', 'CTA Subtitle'),
            Field::make('text', 'text_action_button_text', 'CTA Button Text'),
            Field::make('html', 'text_action_card_end')->set_html('</div>'),

            // Gallery Section
            Field::make('html', 'gallery_card_start')->set_html('<div class="crb-card"><h3>Gallery</h3>'),
            Field::make('complex', 'gallery_images', 'Image Gallery')
                ->set_layout('tabbed-horizontal')
                ->add_fields('gallery_item', [
                    Field::make('image', 'image', 'Image')->set_value_type('url'),
                ]),
            Field::make('html', 'gallery_card_end')->set_html('</div>'),

            // Blog CTA Section
            Field::make('html', 'blog_action_team_card_start')->set_html('<div class="crb-card"><h3>Blog CTA</h3>'),
            Field::make('text', 'text_action_team_title', 'Team CTA Title'),
            Field::make('textarea', 'text_action_team_subtitle', 'Team CTA Subtitle'),
            Field::make('text', 'text_action_team_button_text', 'Team CTA Button Text'),
            Field::make('text', 'text_action_team_button_url', 'Team CTA Button URL'),
            Field::make('html', 'blog_action_team_card_end')->set_html('</div>'),

            // Team Members
            Field::make('html', 'team_members_card_start')->set_html('<div class="crb-card"><h3>Team Members</h3>'),
            Field::make('complex', 'team_members', 'Team Members')
                ->set_layout('tabbed-horizontal')
                ->add_fields('member', [
                    Field::make('text', 'name', 'Name'),
                    Field::make('image', 'image', 'Photo')->set_value_type('url'),
                    Field::make('text', 'role', 'Role'),
                ]),
            Field::make('html', 'team_members_card_end')->set_html('</div>'),

            // Newsletter
            Field::make('html', 'newsletter_card_start')->set_html('<div class="crb-card"><h3>Newsletter</h3>'),
            Field::make('text', 'newsletter_title', 'Newsletter Title'),
            Field::make('textarea', 'newsletter_subtitle', 'Newsletter Subtitle'),
            Field::make('file', 'newsletter_video', 'Newsletter Video')->set_value_type('url'),
            Field::make('html', 'newsletter_card_end')->set_html('</div>'),
        ]);
});

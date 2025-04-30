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
use Timber\Timber;

// Initialize Timber
Timber::init();

// Set .twig template directories
Timber::$dirname = ['templates', 'views'];

// Initialize theme class
new AutoGuruTheme();

// Initialize Carbon Fields
add_action('after_setup_theme', function () {
    \Carbon_Fields\Carbon_Fields::boot();
});

// Add Hero, Carousel,CTA, Card Carousel 2 sections to Timber context
add_filter('timber/context', function ($context) {
    // Default Hero content
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

    // Default Carousel content
    $default_carousel = [
        [
            'title'   => 'Auto-Code, our <br>Unique Coding <br>Solution',
            'excerpt' => 'Explore how our innovative Auto-Code technology seamlessly integrates your datasets, enhancing efficiency and connectivity.',
            'image'   => get_template_directory_uri() . '/static/images/Auto-Code.jpg',
            'more'    => 'Auto-Code',
            'url'     => '/auto-code',
        ],
        [
            'title'   => 'DVLA & <br>VOSA Data<br>Provider',
            'excerpt' => 'Discover our extensive automotive aftermarket data solutions. Explore our cutting-edge services and partnerships...',
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

    $carousel_posts = carbon_get_theme_option('carousel_posts');
    $custom_carousel = is_array($carousel_posts) ? $carousel_posts : [];
    $context['carousel_posts'] = array_merge($custom_carousel, $default_carousel);

    // Default CTA Section
    $default_cta = [
        'image'      => get_template_directory_uri() . '/static/images/readytotake.jpg',
        'title'      => 'Ready to take your automotive<br>business to the next level?',
        'buttonText' => 'Let\'s Talk',
        // Optional: 'url' => '#contact' (if you want a button link)
    ];

    $context['cta_section'] = [
        'image'      => carbon_get_theme_option('cta_image') ?: $default_cta['image'],
        'title'      => carbon_get_theme_option('cta_title') ?: $default_cta['title'],
        'buttonText' => carbon_get_theme_option('cta_button_text') ?: $default_cta['buttonText'],
        // Optional: add 'url' => carbon_get_theme_option('cta_button_url') ?: $default_cta['url'],
    ];

    // Default Services Carousel content
$default_services = [
  [
      'title'   => 'Service 1,<br>Placeholder<br>text for now',
      'excerpt' => 'Explore how our innovative Auto-Code techonology seamlessly integrates your datasets, enhancing efficiency and connectivity. Learn more about how we can elevate your business to the next level.',
      'image'   => get_template_directory_uri() . '/static/images/service1.jpg',
      'more'    => 'Auto-Code',
      'url'     => '/auto-code',
  ],
  [
      'title'   => 'Service 2,<br>Placeholder<br>text for now',
      'excerpt' => 'Discover our extensive automotive aftermarket data solutions. Explore our cutting-edge services and partnerships to elevate your business with the DVLA Bulk Data License.',
      'image'   => get_template_directory_uri() . '/static/images/service2.jpg',
      'more'    => 'DVLA Data',
      'url'     => '/dvla-data',
  ],
  [
      'title'   => 'Service 3,<br>Placeholder<br>text for now',
      'excerpt' => 'Unlock the full potential of Manufacturer Build Data at the VIN level to significantly improve vehicle identification accuracy.',
      'image'   => get_template_directory_uri() . '/static/images/service3.jpg',
      'more'    => 'Build Data',
      'url'     => '/build-data', // fixed typo from "/biuld-data"
  ],
];

// Load from Carbon Fields or fallback to defaults
$services = carbon_get_theme_option('home_services');
$custom_services = is_array($services) ? $services : [];
$context['services'] = array_merge($custom_services, $default_services);


    //youre in good company
    $default_text_action = [
      'title'      => 'You\'re in Good Company',
      'subtitle'   => 'Auto-Guru provides customisable solutions to large and small businesses in<br>different markets accross the UK - why not be one of them?',
      'buttonText' => 'Let\'s Get Started',
  ];
  
  $context['text_action_company'] = [
      'title'      => carbon_get_theme_option('text_action_title') ?: $default_text_action['title'],
      'subtitle'   => carbon_get_theme_option('text_action_subtitle') ?: $default_text_action['subtitle'],
      'buttonText' => carbon_get_theme_option('text_action_button_text') ?: $default_text_action['buttonText'],
  ];

    // Default logos for the image gallery
    $gallery_images = carbon_get_theme_option('gallery_images'); // <== This is required first

$default_gallery_images = [
    get_template_directory_uri() . '/static/images/bently-logo.svg',
    get_template_directory_uri() . '/static/images/bridgestone-logo.png',
    get_template_directory_uri() . '/static/images/camry-logo.png',
    get_template_directory_uri() . '/static/images/honda-logo.webp',
    get_template_directory_uri() . '/static/images/tesla-logo.jpg',
    get_template_directory_uri() . '/static/images/volvo-logo.jpg',
];

$custom_gallery_images = [];

if (is_array($gallery_images)) {
    foreach ($gallery_images as $item) {
        if (!empty($item['image'])) {
            $custom_gallery_images[] = $item['image'];
        }
    }
}

$context['gallery_images'] = array_merge($default_gallery_images, $custom_gallery_images);

    
    // let our team section
$default_text_action_team = [
  'title'      => 'Let our team of industry experts help<br>drive your business through data',
  'subtitle'   => 'The team at Auto-Guru have vast experience and knowledge...',
  'buttonText' => 'Read Our Blog',
  'buttonUrl'  => '/blog',
];

$context['text_action_team'] = [
  'title'      => carbon_get_theme_option('text_action_team_title') ?: $default_text_action_team['title'],
  'subtitle'   => carbon_get_theme_option('text_action_team_subtitle') ?: $default_text_action_team['subtitle'],
  'buttonText' => carbon_get_theme_option('text_action_team_button_text') ?: $default_text_action_team['buttonText'],
  'buttonUrl'  => carbon_get_theme_option('text_action_team_button_url') ?: $default_text_action_team['buttonUrl'],
];

    //team members section
    $default_team_members = [
      [
          'name' => 'J Balvin',
          'image' => get_template_directory_uri() . '/static/images/jbalvin.png',
          'role' => 'Chief Executive Officer',
      ],
      [
          'name' => 'Bad Bunny',
          'image' => get_template_directory_uri() . '/static/images/badbunny.png',
          'role' => 'Chief Executive Officer',
      ],
      [
          'name' => 'Nicki Minaj',
          'image' => get_template_directory_uri() . '/static/images/nickinminaj.png',
          'role' => 'Chief Executive Officer',
      ],
  ];
  
  $team_members = carbon_get_theme_option('team_members');
  $custom_team_members = is_array($team_members) ? $team_members : [];
  
  $context['team_members'] = array_merge($default_team_members, $custom_team_members);
  

    // Newsletter Section Defaults
$default_newsletter = [
  'title'    => 'Sign up for our newsletter',
  'subtitle' => 'Be the first to receive updates from Auto-Guru on our latest<br>service advancements and industry updates',
  'video'    => get_template_directory_uri() . '/static/videos/newsletter-video.mp4',
];

$context['newsletter'] = [
  'title'    => carbon_get_theme_option('newsletter_title') ?: $default_newsletter['title'],
  'subtitle' => carbon_get_theme_option('newsletter_subtitle') ?: $default_newsletter['subtitle'],
  'video'    => carbon_get_theme_option('newsletter_video') ?: $default_newsletter['video'],
];


    return $context;
});

// Register Theme Options with Carbon Fields
add_action('carbon_fields_register_fields', function () {
    Container::make('theme_options', __('Theme Options'))
        ->set_page_parent('themes.php') // Places under Appearance
        ->add_fields([
            // Hero section
            Field::make('text', 'hero_title', 'Hero Title'),
            Field::make('text', 'hero_subtitle1', 'Subtitle 1'),
            Field::make('text', 'hero_subtitle2', 'Subtitle 2'),
            Field::make('text', 'hero_button_text', 'Button Text'),
            Field::make('image', 'hero_image', 'Hero Image'),

            // Carousel section
            Field::make('complex', 'carousel_posts', 'Homepage Carousel')
                ->set_layout('tabbed-horizontal')
                ->add_fields('carousel_item', 'Carousel Item', [
                    Field::make('text', 'title', 'Title'),
                    Field::make('textarea', 'excerpt', 'Excerpt'),
                    Field::make('text', 'more', '"More" Label'),
                    Field::make('text', 'url', 'Button Link'),
                    Field::make('image', 'image', 'Image')->set_value_type('url'),
                ]),

            // CTA section
            Field::make('image', 'cta_image', 'CTA Image')->set_value_type('url'),
            Field::make('text', 'cta_title', 'CTA Title'),
            Field::make('text', 'cta_button_text', 'CTA Button Text'),
            // Optional: Field::make('text', 'cta_button_url', 'CTA Button Link'),

            // Carousel services section
            Field::make('complex', 'home_services', 'Homepage Services')
    ->set_layout('tabbed-horizontal')
    ->add_fields('service_item', [
        Field::make('text', 'title', 'Title'),
        Field::make('textarea', 'excerpt', 'Excerpt'),
        Field::make('text', 'more', '"More" Label'),
        Field::make('text', 'url', 'Button Link'),
        Field::make('image', 'image', 'Image')->set_value_type('url'),
    ]),

          //youre in good company
        
Field::make('text', 'text_action_title', 'CTA Text Title'),
Field::make('textarea', 'text_action_subtitle', 'CTA Text Subtitle'),
Field::make('text', 'text_action_button_text', 'CTA Button Text'),

        // Image gallery section
        Field::make('complex', 'gallery_images', 'Image Gallery')
    ->set_layout('tabbed-horizontal')
    ->add_fields('gallery_item', [
        Field::make('image', 'image', 'Image')->set_value_type('url'),
    ]),

      // let our team
      Field::make('text', 'text_action_team_title', '"Team" CTA Title'),
Field::make('textarea', 'text_action_team_subtitle', '"Team" CTA Subtitle'),
Field::make('text', 'text_action_team_button_text', '"Team" CTA Button Text'),
Field::make('text', 'text_action_team_button_url', '"Team" CTA Button URL'),

     //team members section
     Field::make('complex', 'team_members', 'Team Members')
    ->set_layout('tabbed-horizontal')
    ->add_fields('member', [
        Field::make('text', 'name', 'Name'),
        Field::make('image', 'image', 'Photo')->set_value_type('url'),
        Field::make('text', 'role', 'Role'),
    ]),
      
      // Newsletter section
Field::make('text', 'newsletter_title', 'Newsletter Title'),
Field::make('textarea', 'newsletter_subtitle', 'Newsletter Subtitle'),
Field::make('file', 'newsletter_video', 'Newsletter Video')->set_value_type('url'),


      

      


        ]);
});

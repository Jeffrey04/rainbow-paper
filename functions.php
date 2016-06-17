<?php

namespace rainbow_paper;

$default_colors = ['#FFF479', '#FFF15B', '#FFE900', '#8E8200', '#685F00'];

function rainbow_paper_colors() {
    global $default_colors;
    return functional\map(
        $default_colors,
        function($color, $index) {
            return get_theme_mod("rainbow-paper-settings-colors-{$index}", $color);
        }
    );
}

add_action('wp_enqueue_scripts',
           function() {
               // Theme stylesheet
               wp_enqueue_style('rainbow-paper-style', get_stylesheet_uri());

               wp_enqueue_script('underscore',
                                 '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js',
                                 [],
                                 TRUE);

               wp_enqueue_script('rainbow-paper-script',
                                 get_template_directory_uri() . '/scripts/functions.js',
                                 ['jquery', 'underscore'],
                                 TRUE);

               add_theme_support('html5', ['search-form']);
           });

add_action('after_setup_theme',
           function() {
               add_theme_support('automatic-feed-links');
               add_theme_support('title-tag');
               add_theme_support('post-thumbnails');
           });

add_action('parse_request',
           function(&$wp) {
               if('color.css' === $wp->query_vars['name']) {
                   header('Content-type: text/css');
                   $colors = rainbow_paper_colors();
                   include sprintf('%s/styles/color.template.css', __DIR__);
                   exit();
               }
           });

add_action('widgets_init',
           function() {
               register_sidebar([
                   'name' => 'Sidebar',
                   'id' => 'sidebar',
                   'description' => 'Add widgets here to appear in your sidebar.',
                   'before_widget' => '<li id="%1$s" class="widget %2$s">',
                   'after_widget' => '</li>',
                   'before_title' => '<h3 class="widget-title">',
                   'after_title' => '</h3>',
               ]);
           });

add_action('customize_register',
           function($wp_customize) use($default_colors) {
               $wp_customize->add_section(
                   'rainbow-paper-panel-colors',
                   ['title' => 'Color Settings',
                    'description' => 'Color settings for the theme',
                    'priority' => 35]);

               functional\each(
                   $default_colors,
                   function($color, $index) use($wp_customize) {
                       $wp_customize->add_setting(
                           "rainbow-paper-settings-colors-{$index}",
                           ['default' => $color]
                       );
                       $wp_customize->add_control(
                           "rainbow-paper-settings-colors-{$index}",
                           ['label' => sprintf('Color %s', $index + 1),
                            'section' => 'rainbow-paper-panel-colors',
                            'type' => 'text']
                       );
                   }
               );
           });

namespace rainbow_paper\functional;

function map(array $array, callable $function, $user_data = NULL) {
    return \array_map(
        function($key) use($array, $function) {
            return call_user_func_array(
                $function,
                array_merge([$array[$key], $key],
                            is_null($user_data)
                            ? []
                            : [$user_data]));
        },
        array_keys($array));
}

function each(array $array, callable $function, $user_data = NULL) {
    return call_user_func_array(
        'array_walk',
        array_merge([&$array, $function],
                    is_null($user_data)
                    ? []
                    : [$user_data]));
}

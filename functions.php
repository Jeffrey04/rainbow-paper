<?php

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

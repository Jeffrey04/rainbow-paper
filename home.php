<?php
    if((get_query_var('paged') ?: 1) == 1) :
        get_header();
?>
        <div id="content">
        <?php if (have_posts()): the_post(); ?>
            <main typeof="schema:BlogPosting" resource="<?php echo esc_url(get_permalink()); ?>" class="card" id="post-<?php the_ID(); ?>" <?php post_class('section'); ?>>
                <article>
                    <header>
                        <h1 class="title" id="post-<?php the_ID(); ?>">
                            <a href="<?php the_permalink(); ?>"><?php echo the_title('', '', FALSE); ?></a>
                        </h1>
                    </header>
                    <?php get_template_part('postmeta'); ?>
                    <div class="content">
                    <?php
                        /* translators: %s: Name of current post */
                        global $more; $more = TRUE; 
                        the_content(sprintf(
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'rainbow-paper'),
                            get_the_title()
                        ));
                    ?>
                    </div>
                </article>
            </main>
        <?php endif; ?>

        <?php $more = FALSE; while(have_posts()) : the_post(); ?>
            <article typeof="schema:BlogPosting" resource="<?php echo esc_url(get_permalink()); ?>" class="card" id="post-<?php the_ID(); ?>" <?php post_class('section'); ?>>
                <h1 class="title" id="post-<?php the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>"><?php echo the_title('', '', FALSE); ?></a>
                </h1>
                <?php get_template_part('postmeta'); ?>
                <div class="content" property="dc:description schema:articleBody">
                <?php
                    /* translators: %s: Name of current post */
                    global $more; $more = TRUE; 
                    the_content(sprintf(
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'rainbow-paper'),
                        get_the_title()
                    ));
                ?>
                </div>
            </article>
        <?php endwhile; ?>

            <ul class="card" id="navigation">
                <li class="previous"><?php echo next_posts_link(__('&laquo; Previous Posts')); ?></li>
                <li class="next"><?php echo previous_posts_link(__('Newer Posts &raquo;')); ?></li>
            </ul>
        </div>
<?php
    get_footer();
    else: get_template_part('index'); endif;

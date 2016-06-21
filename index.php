<?php get_header(); ?>
        <div id="content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article typeof="schema:BlogPosting" resource="<?php echo esc_url(get_permalink()); ?>" class="card" id="post-<?php the_ID(); ?>" <?php post_class('section'); ?>>
                <header>
                    <h2 property="dc:title schema:name"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                        <?php echo the_title('', '', FALSE); ?>
                    </a></h2>
                </header>
                <?php get_template_part('postmeta'); ?>
                <div class="content">
                <?php
                    /* translators: %s: Name of current post */
                    the_content(sprintf(
                        __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'rainbow-paper'),
                        get_the_title()
                    ));
                ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
        </div>
<?php get_footer(); ?>

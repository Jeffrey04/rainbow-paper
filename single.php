<?php get_header(); ?>
        <div id="content">
        <?php if(have_posts()) : the_post(); ?>
            <main typeof="schema:BlogPosting" resource="<?php echo esc_url(get_permalink()); ?>" class="card" id="post-<?php the_ID(); ?>" <?php post_class('section'); ?>>
                <article>
                    <header>
                        <h1 class="title" id="post-<?php the_ID(); ?>">
                            <a href="<?php the_permalink(); ?>"><?php echo the_title('', '', FALSE); ?></a>
                        </h1>
                    </header>
                    <?php get_template_part('postmeta'); ?>
                    <div class="content" property="dc:description schema:articleBody">
                    <?php
                        /* translators: %s: Name of current post */
                        the_content(sprintf(
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'rainbow-paper'),
                            get_the_title()
                        ));
                    ?>
                    </div>
                </article>
            </main>

            <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template('', TRUE);
                endif;
            ?>
        <?php endif; ?>
        </div>
<?php get_footer(); ?>

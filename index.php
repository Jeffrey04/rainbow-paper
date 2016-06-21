<?php get_header(); ?>
        <div id="content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article typeof="schema:BlogPosting" resource="<?php echo esc_url(get_permalink()); ?>" class="card" id="post-<?php the_ID(); ?>" <?php post_class('section'); ?>>
                <h1 property="dc:title"><a href="" rel="bookmark">
                    <?php echo the_title('', '', FALSE); ?>
                </a></h1>
                <dl class="meta">
                    <dt class="author"><?php echo __('Author'); ?></dt>
                    <dd class="author" typeof="foaf:Person" property="dc:creator" resource="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <?php
                        $avatar_url = get_avatar_url(get_the_author_meta('ID'), ['size' => 20]);
                        $author_url = get_author_posts_url(get_the_author_meta('ID'));
                    ?>
                        <img property="foaf:img" src="<?php echo $avatar_url; ?>" resource="<?php echo $avatar_url; ?>" />
                        <a property="foaf:page" href="<?php echo $author_url; ?>" resource="<?php echo $author_url; ?>">
                            <?php echo get_the_author(); ?>
                        </a>
                    </dd>
                    <dt class="category"><?php echo __('Category'); ?></dt>
                    <dd class="category"><?php the_category('&bull;'); ?></dd>
                    <?php if(has_tag()) : ?>
                    <dt class="tags"><?php echo __('tag list'); ?></dt>
                    <dd class="tags"><?php echo get_the_tag_list(NULL, ' &bull; ', NULL); ?></dd>
                    <?php endif; ?>
                    <dt class="date"><?php echo __('Date'); ?></dt>
                    <dd class="date" property="dc:created" content="<?php echo the_date('c'); ?>">
                        <a href="<?php echo get_year_link(get_the_time('Y')); ?>"><?php the_time('Y'); ?></a>-<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('m'); ?></a>-<a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('j')); ?>"><?php the_time('j'); ?></a>
                    </dd>
                    <dt class="time"><?php echo __('Time'); ?></dt>
                    <dd class="time"><?php the_time('H:i'); ?></dd>
                </dl>
                <?php // TODO include description only when we r in single post ?>
                <div class="content" property="dc:description">
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

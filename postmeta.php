
                <dl class="meta">
                    <dt class="author"><?php echo __('Author'); ?></dt>
                    <dd class="author" typeof="foaf:Person schema:Person" property="dc:creator schema:author" resource="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <?php
                        $avatar_url = get_avatar_url(get_the_author_meta('ID'), ['size' => 30]);
                        $author_url = get_author_posts_url(get_the_author_meta('ID'));
                    ?>
                        <img property="foaf:img schema:image" src="<?php echo $avatar_url; ?>" resource="<?php echo $avatar_url; ?>" />
                        <a property="foaf:page schema:url" href="<?php echo $author_url; ?>" resource="<?php echo $author_url; ?>">
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
                    <dd class="date" property="dc:created schema:datePublished" content="<?php echo the_date('c'); ?>">
                        <a href="<?php echo get_year_link(get_the_time('Y')); ?>"><?php the_time('Y'); ?></a>-<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('m'); ?></a>-<a href="<?php echo get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('j')); ?>"><?php the_time('j'); ?></a>
                    </dd>
                    <dt class="time"><?php echo __('Time'); ?></dt>
                    <dd class="time"><?php the_time('H:i'); ?></dd>
                </dl>


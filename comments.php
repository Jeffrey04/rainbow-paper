
            <form id="comment-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="card">
                <header>
                    <h2><?php echo __('Leave a Reply'); ?></h2>
                </header>
                <input type="hidden" name="comment_post_ID" value="<?php the_ID(); ?>">
                <dl>
                <?php if(is_user_logged_in()) : ?>
                    <dt><label for="author"><?php echo __('Name'); ?></label></dt>
                    <dd><?php echo $user_identity; ?></dd>
                <?php else : ?>
                    <dt><label for="author"><?php echo __('Name'); ?></label></dt>
                    <dd><input name="author" id="author" /><p><?php if ($req) echo 'name is required'; ?></p></dd>

                    <dt><label for="email"><?php echo __('Email'); ?></label></dt>
                    <dd><input name="email" id="email" /><p><?php if ($req) echo 'email is required'; ?></p></dd>

                    <dt><label for="url"><?php echo __('Homepage'); ?></label></dt>
                    <dd><input name="url" id="url" /><p>have a blog?</p></dd>
                <?php endif; ?>
                    <dt><label for="comment"><?php echo __('Comment'); ?></label></dt>
                    <dd><textarea name="comment" id="comment"></textarea></dd>
                </dl>
                <div class="disclaimer">
                    <p>Posted comments are automatically moderated. The author of
                    this blog post does not hold responsibility of the content
                    of each of the comment. Civilized and calm conversations are
                    welcomed, and please don't be a dick.</p></div>
                <input id="submit" type="submit" value="Submit Comment" />
            </form>

            <?php if (have_comments()) : ?>
                <?php if(!empty($comments_by_type['pings'])): ?>
                <div class="card">
                    <header><h2>Pings</h2></header>
                    <ul id="list-ping">
                        <?php wp_list_comments(array('style' => 'ul', 'type' => 'pings', 'callback' => 'rainbow_paper\comment')); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if(!empty($comments_by_type['comment'])): ?>
                    <?php wp_list_comments(array('style' => 'div', 'type' => 'comment', 'callback' => 'rainbow_paper\comment', 'reverse_top_level' => TRUE)); ?>
                <?php endif; ?>
            <?php endif; ?>


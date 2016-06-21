            <?php if(get_comment_type() == 'comment') : ?>
                <div class="card comment">
                    <dl class="meta">
                        <dt class="author"><?php echo __('author'); ?></dt>
                        <dd class="author">
                            <?php echo get_avatar($comment, 30); ?>
                            <?php echo comment_author_link(); ?>
                        </dd>
                        <dt class="date"><?php echo __('date'); ?></a></dt>
                        <dd class="date"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><?php echo comment_date('Y-m-j'); ?></a></dd>
                        <dt class="time"><?php echo __('time'); ?></dt>
                        <dd class="time"><?php echo comment_time('H:i:s'); ?></dd>
                    </dl>
                    <div class="content">
                        <?php comment_text(); ?>
                    </div>
                <? /*</div>*/ ?>
            <?php else : ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class('ping'); ?>>
                    <?php comment_author_link(); ?>
                <? /*</li>*/ ?>
            <?php endif; ?>


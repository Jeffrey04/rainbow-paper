<?php get_header(); ?>
        <div id="content">
            <div class="sub">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('section'); ?>>
                    <?php the_title( sprintf( '<h1><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
                    <?php
                        /* translators: %s: Name of current post */
                        the_content( sprintf(
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
                            get_the_title()
                        ) );
                    ?>
                </article>
                <div class="section">
                    <ul id="comment-list">
                        <?php /* ?>
                        <li id="comment-form">
                            <h2>Leave a comment</h2>
                            <form>
                                <label for="author">Author</label>
                                <input placeholder="John Doe" type="text" id="author" name="author" />
                                <label for="email">Email</label>
                                <input placeholder="meow@example.com" type="text" id="email" name="email" />
                                <label for="url">Site</label>
                                <input placeholder="http://meow.example.org/" type="text" id="url" name="url" />
                                <label for="comment">Comment</label>
                                <textarea placeholder="You suck!" id="comment" name="comment"></textarea>
                                <p class="disclaimer">Disclaimer something something no bad guy</p>
                                <input type="submit" id="submit" name="submit" />
                            </form>
                        </li>
                        <li class="comment">
                            <img src="" width="50px" height="50px" class="author" />
                            <h3>John doe <small>Some date</small></h3>
                            <p>lorem ipsum dolor sit</p>
                            <p>You suck</p>
                        </li>
                        <?php */ ?>
                    </ul>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
<?php get_footer(); ?>

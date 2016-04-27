        <nav id="meta">
            <ul class="sub">
                <li id="header" class="widget">
                    <h2><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
                    <p><?php bloginfo('name'); ?></p>
                </li>
                <?php
                    if (is_active_sidebar('sidebar')):
                        dynamic_sidebar('sidebar');
                    endif;
                ?>
            </ul>
        </nav>

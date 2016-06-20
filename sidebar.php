        <nav id="meta">
            <div id="header">
                <script type="text/template" id="template-header-toggle">
                    <i class="material-icons toggle">menu</i>
                </script>
                <h2><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
                <p><?php bloginfo('description'); ?></p>
            </div>
            <ul id="sidebar">
            <?php
                if (is_active_sidebar('sidebar')):
                    dynamic_sidebar('sidebar');
                endif;
            ?>
            </ul>
        </nav>

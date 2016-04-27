        <nav id="meta">
            <ul class="sub">
                <li id="header" class="widget">
                    <h2>Something</h2>
                    <p>Something something slogan</p>
                </li>
                <?php
                    if (is_active_sidebar('sidebar')):
                        dynamic_sidebar('sidebar');
                    endif;
                ?>
            </ul>
        </nav>

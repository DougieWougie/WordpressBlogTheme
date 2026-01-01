    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <a href="https://wordpress.org/">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'Proudly powered by %s', 'dougiewougie-theme' ), 'WordPress' );
                    ?>
                </a>
                <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf( esc_html__( 'Theme: %1$s by %2$s.', 'dougiewougie-theme' ), 'dougiewougie-theme', '<a href="https://dougiewougie.com">Gemini</a>' );
                    ?>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->

<?php wp_footer(); ?>
</body>
</html>

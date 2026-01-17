<div class="card">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php
            if ( is_singular() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;
            ?>
        </header><!-- .entry-header -->

        <?php
        $tags_list = get_the_tag_list( '<div class="tags-links">', '', '</div>' );
        if ( $tags_list ) {
            echo $tags_list;
        }
        ?>

        <div class="entry-content">
            <?php
            the_content( sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dougiewougie-theme' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dougiewougie-theme' ),
                'after'  => '</div>',
            ) );
            ?>
        </div><!-- .entry-content -->



        <footer class="entry-footer">
            <?php
            if ( get_edit_post_link() ) :
                ?>
                <a class="edit-button" href="<?php echo esc_url( get_edit_post_link() ); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    <?php esc_html_e( 'Edit', 'dougiewougie-theme' ); ?>
                </a>
                <?php
            endif;
            ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
</div>

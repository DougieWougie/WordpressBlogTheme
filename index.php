<?php get_header(); ?>

<div id="primary" class="content-area">
    <div class="container">

        <main id="main" class="site-main">

            <?php
            if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_format() );

                endwhile;

                ?>
                <div class="posts-navigation">
                    <div class="nav-previous">
                        <?php echo get_previous_posts_link( '<span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg></span> Newer Posts' ); ?>
                    </div>
                    <div class="nav-next">
                        <?php echo get_next_posts_link( 'Older Posts <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></span>' ); ?>
                    </div>
                </div>
                <?php

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

        </main><!-- #main -->
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>
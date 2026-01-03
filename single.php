<?php get_header(); ?>

<div id="primary" class="content-area">
    <div class="container">
        <main id="main" class="site-main">

            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', get_post_format() );

                ?>
                <div class="posts-navigation">
                    <?php if ( get_previous_post_link() ) : ?>
                        <div class="nav-box previous">
                            <?php previous_post_link( '%link', '<span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></span> Previous Post' ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ( get_next_post_link() ) : ?>
                        <div class="nav-box next">
                            <?php next_post_link( '%link', 'Next Post <span class="nav-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></span>' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div>
</div><!-- #primary -->

<?php get_footer(); ?>

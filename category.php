<?php get_header(); ?>

<div class="content divider divider-content">

    <div class="core core-content">
    
        <div class="row">

            <main class="main-content col col-5" role="main">
    
                <?php if (have_posts()) : ?>
        
                    <h1 class="main-content-title">
                        <?php _e( 'Categorie', 'thema_vertalingen' ); ?>: <?php single_cat_title() ?>
                    </h1>
        
                    <?php /* Start the Loop */ ?>
                    <?php while (have_posts()) : the_post(); ?>
    
                        <?php get_template_part( 'post', '' ); ?>
    
                    <?php endwhile; ?>
        
                <?php else : ?>
        
                    <article <?php post_class(); ?>>
                                                
                        <h1 class="post-title">
                            <?php _e( 'Deze pagina bestaat niet', 'thema_vertalingen' ); ?>
                        </h1>
        
                        <div class="post-entry">
                        
                            <p>
                                <?php _e( 'Sorry, we hebben deze pagina niet gevonden. Maar misschien kun je zoeken om de juiste pagina te vinden:', 'thema_vertalingen' ); ?>
                            </p>
                        
                            <?php get_search_form(); ?>
                        
                        </div>
    
                    </article>
        
                <?php endif; ?>
                
            </main> <!-- .main-content -->
    
            <aside class="sidebar col col-3" role="complementary">
    
                <?php if ( !function_exists('dynamic_sidebar')
                    || !dynamic_sidebar('Widget') ) : ?>
                <?php endif; ?>
    
            </aside> <!-- .sidebar -->
            
        </div> <!-- .row -->

    </div> <!-- .core -->

</div> <!-- .divider -->

<?php get_footer(); ?>
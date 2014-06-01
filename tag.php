<?php get_header(); ?>

<div id="content" class="content wrapper wrapper-content">

    <div class="holder holder-content">

        <div class="maincontent grid-column grid-column-5">

            <?php if ( have_posts() ) : ?>
    
    			<header class="maincontent-header">
    				<h1 class="maincontent-title">
    				    <?php _e( 'Tag', 'thema_vertalingen' ); ?>: <?php single_cat_title() ?>
    				</h1>
    			</header>
    
    			<?php /* Start the Loop */ ?>
    			
    			<?php while (have_posts()) : the_post(); ?>

                    <article class="l-post">

            			<header class="l-post-header">
                            
                            <h1 class="l-post-title">
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Directe link naar', 'thema_vertalingen' ); ?> <?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h1>
                            
                            <time datetime="<?php the_time('Y-m-d') ?>" pubdate="pubdate">
                                <?php the_time('j F Y') ?> &mdash; <?php the_time('g:ia') ?> <?php edit_post_link('Edit','<strong> |</strong> ',''); ?>
                            
                            </time>
                        </header>
                        
                        <div class="l-post-entry">
            				
            				<?php the_excerpt(); ?>
            				
            				<span class="l-post-options">
                				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Directe link naar', 'thema_vertalingen' ); ?> <?php the_title_attribute(); ?>"><?php _e( 'Verder lezen', 'thema_vertalingen' ); ?></a>&nbsp;|&nbsp;
                				<?php comments_popup_link('Reageer als eerste', 'Er is 1 reactie', 'Er zijn % reacties'); ?>
                            </span>

                        </div>
                        
                    </article>

    			<?php endwhile; ?>    

    		<?php else : ?>

    			<article class="l-post no-results not-found">

    				<header class="l-post-header">
    					<h1 class="l-post-title"><?php _e( 'Deze pagina bestaat niet', 'thema_vertalingen' ); ?></h1>
    				</header>
    
    				<div class="l-post-entry">
    					<p><?php _e( 'Sorry, we hebben deze pagina niet gevonden. Maar misschien kun je zoeken om de juiste pagina te vinden:', 'thema_vertalingen' ); ?></p>
    					<?php get_search_form(); ?>
    				</div>

    			</article>

    		<?php endif; ?>
    		
        </div> <!-- #maincontent -->

        <aside class="sidebar grid-column grid-column-3 no-margin">

            <?php if ( !function_exists('dynamic_sidebar')
                || !dynamic_sidebar('Blog') ) : ?>
            <?php endif; ?>

        </aside> <!-- #sidebar -->

    </div> <!-- #holder-content -->

</div> <!-- #wrapper-content -->

<?php get_footer(); ?>
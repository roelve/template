<?php get_header(); ?>

<div class="content divider divider--content">

    <div class="core core--content">
    
        <div class="row">

            <main class="page-content col col--5" role="main">
    
                <?php if (have_posts()) : ?>
    
                    <?php /* Start the Loop */ ?>              
                    <?php while (have_posts()) : the_post(); ?>
                    
                        <!-- Using templates/post -->
                        <?php get_template_part( 'templates/post', '' ); ?>
    
                    <?php endwhile; ?>
                    
                    <?php if (!is_single() && !is_page()) { ?>
    
                        <?php
                            $temp = $wp_query;
                            $wp_query = null;
                            $wp_query = new WP_Query();
        
                            $show_posts = 10;                           //How many post you want on a page
                            $permalink = 'Post name';                   // Default, Post name
                            $req_uri =  $_SERVER['REQUEST_URI'];        // Know the current URI
        
                            // Permalink set to default
                            if ($permalink == 'Default') {
                            
                                $req_uri = explode('paged=', $req_uri);
        
                                if ($_GET['paged']) {
                                    $uri = $req_uri[0] . 'paged=';
                                } else {
                                    $uri = $req_uri[0] . '&paged=';
                                }
                                
                            // Permalink is set to Post name
                            } elseif ($permalink == 'Post name') {
                            
                                if (strpos($req_uri, 'page/') !== false) {
                                    $req_uri = explode('page/', $req_uri);
                                    $req_uri = $req_uri[0];
                                }
                                $uri = $req_uri . 'page/';
                                
                            }
        
                            // The query
                            $wp_query->query('showposts=' . $show_posts . '&post_type=post&paged=' . $paged);
                            $count_posts = wp_count_posts('post');
        
                            // Determine number of posts
                            $count_post = round($count_posts->publish / $show_posts);
                            
                            if ($count_posts->publish % $show_posts == 1) {
                            
                                $count_post++;
                                $count_post = intval($count_post);
                                
                            }
        
                            // The navigation
                            if ($count_post > 1) {
                        ?>
                        
                        <ul class="paging">
                        
                            <li class="paging__navigation paging__navigation--prev">
                            
                                <?php previous_posts_link('Vorige'); ?>
                                
                            </li>
                            
                            <li class="paging__navigation paging__navigation--next">
                            
                                <?php next_posts_link('Volgende'); ?>
                                
                            </li>
                            
                            <?php for ($i = 1; $i <= $count_post; $i++) { ?>
                            
                                <li class="paging__number <?php if ($paged == $i) { echo ' paging__number--active'; } ?>">
                                
                                    <a href="<?php echo $uri . $i; ?>" title="<?php _e( 'Naar pagina ', 'thema_vertalingen' ); ?><?php echo $i; ?>">
                                        
                                        <?php echo $i; ?>
                                        
                                    </a>
                                    
                                </li>
                                
                            <?php } ?>
                            
                        </ul>
                        
                        <?php }
                            // Reset
                            $wp_query = null;
                            $wp_query = $temp;
                        ?>
    
                    <?php } ?>
            
                <?php endif; ?>
                
            </main>
    
            <aside class="sidebar col col--3" role="complementary">
            
                <div class="sidebar__section">
                
                    <h2 class="sidebar__section__title">
                        
                        <?php _e( 'Sidebar section', 'thema_vertalingen' ); ?>
                        
                    </h2>
                                    
                </div>
    
                <?php if ( !function_exists('dynamic_sidebar')
                    || !dynamic_sidebar('Widget') ) : ?>
                <?php endif; ?>
    
            </aside>
            
        </div>

    </div>

</div>

<?php get_footer(); ?>

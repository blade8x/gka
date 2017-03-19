<?php
/**
 * Template Name: Template Projects
 *
 * @package WordPress
 * @subpackage The Architect
 * @since The Architect 1.0.0
 */
?>
<?php get_header(); ?>
<?php
$pid = $post->ID;
$layout = ot_get_option('wpl_projects_cat_layout');
?>	
<section id="main" class="cf" role="main">

    <div class="m-all t-all d-all">
        
        <div class="module-title wrap cf" style="padding: 20px 0 20px 0;">
            <div class="two_third">
                <?php
                $cat_title = single_cat_title('', false);
                if(empty($cat_title) && isset($_GET['location'])){
                    $cat_title = $_GET['location'];
                }
                ?>
                <h3><?php echo $cat_title; ?></h3>
                <p><?php echo category_description(); ?></p>
            </div>

            <div class="one_third last">
                <div class="filter right">
                    <a class="btn medium black" href="<?php echo get_permalink(ot_get_option('wpl_projects_page')); ?>"><?php _e('Browse all', 'thearchitect-wpl'); ?></a>
                    <ul>
                        <li><a href=""><?php _e('By sectors', 'thearchitect-wpl'); ?> <span>&rsaquo;</span></a>
                            <ul class="sectors">
                                <?php
                                $terms = get_terms('projects_cat');
                                $pLocation = isset($_GET['location'])?$_GET['location']:'';
                                foreach ($terms as $term) {
                                    if($pLocation != ''){
                                        $pUrl = esc_url(add_query_arg(['location' => $pLocation], get_term_link($term, 'projects_cat') ) );
                                    } else {
                                        $pUrl = esc_url(get_term_link($term, 'projects_cat'));
                                    }
                                    echo "<li><a href=" . $pUrl . " title=" . sprintf(__("View all projects in %s", 'thearchitect-wpl'), $term->name) . ">" . $term->name . "</a></li>";
                                }
                                ?>
                            </ul>
                        </li>
                    </ul>
                    <?php
                    // get meta location
                    global $wpdb;
                    $term = get_queried_object();
                    $isProjectCat = false;
                    if(!empty($term->taxonomy) && $term->taxonomy == 'projects_cat'){
                        $pr_locations = $wpdb->get_results("
                                                            SELECT `pm`.* 
                                                            FROM `wp_postmeta` `pm`
                                                            LEFT JOIN `wp_term_relationships` `tr` ON `tr`.`object_id` = `pm`.`post_id`
                                                            LEFT JOIN `wp_term_taxonomy` `tt` ON `tt`.`term_taxonomy_id` = tr.`term_taxonomy_id`
                                                            LEFT JOIN `wp_terms` `t` ON `t`.`term_id` = tt.`term_id` 
                                                            WHERE pm.`meta_key` = 'sbwp_project_location' AND t.`slug` = '".$term->slug."'
                                                            GROUP BY pm.`meta_value`
                                                            " );
                        $isProjectCat = true;
                    } else {
                        $pr_locations = $wpdb->get_results("SELECT `pm`.* 
                                                            FROM `wp_postmeta` `pm`                                                            
                                                            WHERE pm.`meta_key` = 'sbwp_project_location'
                                                            GROUP BY pm.`meta_value`" );
                    }
                    if (!empty($pr_locations)) {
                        ?>
                        <ul>
                            <li><a href=""><?php _e('By locations', 'thearchitect-wpl'); ?> <span>&rsaquo;</span></a>
                                <ul class="locations">
                                    <?php
                                    foreach ($pr_locations as $pr_location) {
                                        if($isProjectCat){
                                            $lUrl = esc_url(add_query_arg(['location' => $pr_location->meta_value]));
                                        } else {
                                            $lUrl = esc_url(add_query_arg(['location' => $pr_location->meta_value], '/projects'));
                                        }
                                        echo "<li><a href='" . $lUrl . "' title='" . sprintf(__("View all projects in %s", 'thearchitect-wpl'), $pr_location->meta_value) . "'>" . $pr_location->meta_value . "</a></li>";
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="block-grid projects-listing <?php echo $layout; ?> cf">

            <?php if (have_posts()) : ?>
                <?php
                while (have_posts()) : the_post();
                    $terms = wp_get_post_terms(get_the_ID(), 'projects_cat');
                    $project_text_color = get_post_meta(get_the_ID(), 'wpl_project_text_color', true);
                    $project_location = get_post_meta(get_the_ID(), 'wpl_project_location', true);

                    $post_featured_image = get_post_thumbnail_id(get_the_ID());
                    if ($post_featured_image) {
                        $project_thumbnail = wp_get_attachment_image_src($post_featured_image, 'full', false);
                        if ($project_thumbnail)
                            (string) $project_thumbnail = $project_thumbnail[0];
                    }
                    ?>

                    <?php
                    if ($layout == "columns-2") {
                        echo "<article class='block-item half-width half-height cf'>";
                    } elseif ($layout == "columns-3") {
                        echo "<article class='block-item third-width third-height cf'>";
                    } elseif ($layout == "columns-4") {
                        echo "<article class='block-item quarter-width quarter-height cf'>";
                    } else {
                        echo "<article class='block-item third-width third-height cf'>";
                    }
                    ?>
                    <a href="<?php the_permalink(); ?>" rel='bookmark' title="<?php the_title(); ?>">
                        <div class="image" style="background-image: url(<?php echo $project_thumbnail; ?>);"></div>
                        <div class="text <?php echo $project_text_color; ?>">
                            <h1><?php the_title(); ?></h1>
                            <span class="line medium <?php echo $project_text_color; ?>"></span>
                            <p>
                                <?php
                                if ($terms) {
                                    $numTerms = count($terms);
                                    $i = 1;
                                    foreach ($terms as $term) {
                                        echo "$term->name";
                                        if ($i < $numTerms)
                                            echo ", ";
                                        $i++;
                                    }
                                }
                                if ($terms && $project_location) {
                                    echo ", ";
                                }
                                if ($project_location) {
                                    echo $project_location;
                                }
                                ?>
                            </p>
                        </div>
                    </a>
                    </article>

    <?php endwhile; ?>



<?php else : ?>

                <article id="post-not-found" class="hentry cf">
                    <header class="article-header">
                        <h1><?php _e('Oops, Post Not Found!', 'thearchitect-wpl'); ?></h1>
                    </header>
                </article>
            </div>

<?php endif; ?>

<?php bones_page_navi() ?>

    </div>

</section>


<?php get_footer(); ?>

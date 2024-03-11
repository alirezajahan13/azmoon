<?php
get_header();
?>
<main id="primary" class="site-main mainView">
    <div class="archiveTestsParent">
        <div class="headingArchiveTests">
            <h1 class="">آزمون ها</h1>
        </div>
        <div class="liveSearchSectionParent">
            <input class="input-field" type="text" name="" id="searchQuizInput">
        </div>
		<div class="searchResult testsCategorySections"></div>
        <div class="testsCategoryParent">
            <?php 
            $terms = get_terms( array(
                'taxonomy'   => 'test-cat',
                'hide_empty' => false,
            ) );
            foreach($terms as $term){
                ?>
                <h3 class="titleOfCategory"><?php echo $term->name ?></h3>
                <div class="testsCategorySectionOne testsCategorySections">
                <?php
                    $args = array(
                        'post_type' => 'test',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'test-cat',
                                'field'    => 'id',
                                'terms'    => $term->term_id,
                            ),
                        ),
                        'posts_per_page' => 10,
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();
                            ?>
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-image">
                                            <div class="imageTestCardArchive"><?php the_post_thumbnail('thumbnail'); ?></div>
                                            <a href="<?php the_permalink(); ?>" class="btn-floating halfway-fab waves-effect waves-light linkBtnTestCardArchive"><svg width="25" height="25" fill="#fff" viewBox="0 0 0.3 0.3" xmlns="http://www.w3.org/2000/svg"><path d="M.15.037a.02.02 0 0 0-.019.019v.075H.056a.019.019 0 1 0 0 .037h.075v.075a.019.019 0 1 0 .037 0V.169h.075a.019.019 0 1 0 0-.037H.169V.056A.02.02 0 0 0 .15.037"/></svg></a>
                                        </div>
                                        <div class="card-content">
                                            <h3 class="card-title titleTestCardArchive"><?php the_title(); ?></h3>
                                            <p class="explainTestCardArchive"><?php echo get_field('azmoon_single_test_shortdec') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_postdata();
                    } else {
                        echo 'No posts found';
                    }
                ?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
<?php
/**
 * Template Name: WP Refers Home page Template
 */

get_header();

?>

<div <?php Bunyad::markup()->attribs('main'); ?>>

    <div class="ts-row">
        <div class="col-12">
            <h1>Who we are?</h1>

            <p>
                We are expert team with years of experience to establish sound and perfect website for you.
                We refers only hand-picked, tested, genuine and carefully picked  themes and plugins that suit your website that make great impact.
                We refer you the right tools for your <b>NEXT</b> big thing.
            </p>

           <h2>What do we do?</h2>

            <p>
                We refers you right <b>themes</b> and <b>plugins</b> for smart beginning.
                Know more about <b>WordPress</b>, <b>themes</b> and <b>plugins</b> and start your own site.
                <b>WpRefers</b> make it easy to move step forward.
            </p>

            <p><b>WpRefers</b> - Complete refers guide for beginner.</p>

            <form role="search" method="get" class="search-form"
                  action="<?php echo esc_url(home_url('/')); ?>">

                <div class="input-group" style="width: 100%;">
                    <input type="search"
                           style="width: 100%;height:var(--input-height, 50px);"
                           placeholder="<?php echo esc_attr_x('Starting your own ...', 'placeholder', 'text domain'); ?>"
                           value="<?php the_search_query(); ?>"
                           name="s">
                </div>

                <button type="submit" style="height: 50px;" class="btn btn-primary">
                    <i class="tsi tsi-search"></i>
                </button>

            </form>
        </div>
    </div> <!-- .row -->

    <div class="ts-row" style="margin-top: 10px">
        <div class="col-12">
            <h3><b style="font-size: 85%;">Popular inquiries</b></h3>
        </div>

        <div class="col-2">
            <b><a href="" style="font-size: 85%;text-decoration: underline;">Blog</a></b>
        </div>
        <div class="col-2">
            <b><a href="" style="font-size: 85%;text-decoration: underline;">Online Store</a></b>
        </div>
        <div class="col-2">
            <b><a href="" style="font-size: 85%;text-decoration: underline;">Hosting</a></b>
        </div>
        <div class="col-2">
            <b><a href="" style="font-size: 85%;text-decoration: underline;">SEO</a></b>
        </div>
        <div class="col-2">
            <b><a href="" style="font-size: 85%;text-decoration: underline;">Security</a></b>
        </div>
        <div class="col-2">
            <b><a href="" style="font-size: 85%;text-decoration: underline;">Errors</a></b>
        </div>

    </div>

    <section class="related-posts">
        <div class="block-head block-head-ac block-head-a block-head-a1 is-left">
            <h4 class="heading">Recent <span class="color">Blog</span></h4>
            <span class="pull-right">
                <a href="<?php echo site_url('category/blog/'); ?>">View All</a>
            </span>
        </div>

        <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="2">

            <div class="block-content">

                <div class="loop loop-grid loop-grid-sm grid grid-5 md:grid-2 xs:grid-1">

                    <?php foreach (wprefers_core_get_recent_blogs() as $blog) : ?>
                        <article class="l-post  grid-sm-post grid-post">
                            <div class="media">
                                <a href="<?php echo get_permalink($blog['ID']); ?>"
                                   class="image-link media-ratio ratio-16-9" title="<?php echo $blog['post_title']; ?>">
                                <span data-bgsrc="<?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?>"
                                      class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium no-display appear lazyloaded"
                                      data-bgset="<?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?> 450w, <?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?> 300w, <?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?> 768w, <?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?> 150w, <?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?> 1013w"
                                      data-sizes="(max-width: 377px) 100vw, 377px" role="img"
                                      aria-label="dark-wordpress-themes"
                                      style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($blog['ID']), 'full'); ?>');"></span>
                                </a>
                            </div>
                            <div class="content">
                                <div class="post-meta post-meta-a has-below">
                                    <h2 class="is-title post-title">
                                        <a href="<?php echo get_permalink($blog['ID']); ?>"><?php echo $blog['post_title']; ?></a>
                                    </h2>
                                    <div class="post-meta-items meta-below">
                                    <span class="meta-item date">
                                        <span class="date-link">
                                            <time class="post-date" datetime="<?php echo $blog['post_date']; ?>">
                                                <?php echo date('M j, Y', strtotime($blog['post_date'])) ?>
                                            </time>
                                        </span>
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </article>
                    <?php endforeach; ?>

                </div>


            </div>

        </section>

    </section>

    <section class="related-posts">
        <div class="block-head block-head-ac block-head-a block-head-a1 is-left">
            <h4 class="heading">Recent <span class="color">Themes</span></h4>
            <span class="pull-right">
                <a href="<?php echo site_url('category/themes/'); ?>">View All</a>
            </span>
        </div>

        <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="2">

            <div class="block-content">

                <div class="loop loop-grid loop-grid-sm grid grid-5 md:grid-2 xs:grid-1">

                    <?php
                    $featuredTheme = wprefers_core_get_featured_blogs('post', 'wprefers_core_button_is_featured', 'on', 5);
                    ?>

                    <?php
                    if ($featuredTheme->have_posts()) {
                        while ($featuredTheme->have_posts()) {
                            $featuredTheme->the_post();
                            ?>

                            <article class="l-post  grid-sm-post grid-post">
                                <div class="media">
                                    <a href="<?php echo get_permalink(get_the_ID()); ?>"
                                       class="image-link media-ratio ratio-16-9"
                                       title="<?php echo get_the_title(); ?>">
                                <span data-bgsrc="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>"
                                      class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium no-display appear lazyloaded"
                                      data-bgset="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 450w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 300w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 768w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 150w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 1013w"
                                      data-sizes="(max-width: 377px) 100vw, 377px" role="img"
                                      aria-label="<?php echo basename( get_permalink() ); ?>"
                                      style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>');"></span>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="post-meta post-meta-a has-below">
                                        <h2 class="is-title post-title">
                                            <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                        <div class="post-meta-items meta-below">
                                    <span class="meta-item date">
                                        <span class="date-link">
                                            <time class="post-date" datetime="<?php echo get_the_date(); ?>">
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </time>
                                        </span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                            </article>

                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </div>


            </div>

        </section>

    </section>

    <section class="related-posts">
        <div class="block-head block-head-ac block-head-a block-head-a1 is-left">
            <h4 class="heading">Recent <span class="color">Plugins</span></h4>
            <span class="pull-right">
                <a href="<?php echo site_url('category/plugins/'); ?>">View All</a>
            </span>
        </div>

        <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="2">

            <div class="block-content">

                <div class="loop loop-grid loop-grid-sm grid grid-5 md:grid-2 xs:grid-1">

                    <?php
                    $featuredPlugin = wprefers_core_get_featured_blogs('post', 'wprefers_core_button_is_featured', 'on', 5);
                    ?>

                    <?php
                    if ($featuredPlugin->have_posts()) {
                        while ($featuredPlugin->have_posts()) {
                            $featuredPlugin->the_post();
                            ?>

                            <article class="l-post  grid-sm-post grid-post">
                                <div class="media">
                                    <a href="<?php echo get_permalink(get_the_ID()); ?>"
                                       class="image-link media-ratio ratio-16-9"
                                       title="<?php echo get_the_title(); ?>">
                                <span data-bgsrc="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>"
                                      class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium no-display appear lazyloaded"
                                      data-bgset="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 450w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 300w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 768w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 150w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 1013w"
                                      data-sizes="(max-width: 377px) 100vw, 377px" role="img"
                                      aria-label="<?php echo basename( get_permalink() ); ?>"
                                      style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>');"></span>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="post-meta post-meta-a has-below">
                                        <h2 class="is-title post-title">
                                            <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                        <div class="post-meta-items meta-below">
                                    <span class="meta-item date">
                                        <span class="date-link">
                                            <time class="post-date" datetime="<?php echo get_the_date(); ?>">
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </time>
                                        </span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                            </article>

                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </div>


            </div>

        </section>

    </section>

    <section class="related-posts">
        <div class="block-head block-head-ac block-head-a block-head-a1 is-left">
            <h4 class="heading">Recent <span class="color">Hostings</span></h4>
            <span class="pull-right">
                <a href="<?php echo site_url('category/hostings/'); ?>">View All</a>
            </span>
        </div>

        <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="2">

            <div class="block-content">

                <div class="loop loop-grid loop-grid-sm grid grid-5 md:grid-2 xs:grid-1">

                    <?php
                    $featuredHosting = wprefers_core_get_featured_blogs('post', 'wprefers_core_button_is_featured', 'on', 5);
                    ?>

                    <?php
                    if ($featuredHosting->have_posts()) {
                        while ($featuredHosting->have_posts()) {
                            $featuredHosting->the_post();
                            ?>

                            <article class="l-post  grid-sm-post grid-post">
                                <div class="media">
                                    <a href="<?php echo get_permalink(get_the_ID()); ?>"
                                       class="image-link media-ratio ratio-16-9"
                                       title="<?php echo get_the_title(); ?>">
                                <span data-bgsrc="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>"
                                      class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium no-display appear lazyloaded"
                                      data-bgset="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 450w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 300w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 768w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 150w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 1013w"
                                      data-sizes="(max-width: 377px) 100vw, 377px" role="img"
                                      aria-label="<?php echo basename( get_permalink() ); ?>"
                                      style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>');"></span>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="post-meta post-meta-a has-below">
                                        <h2 class="is-title post-title">
                                            <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                        <div class="post-meta-items meta-below">
                                    <span class="meta-item date">
                                        <span class="date-link">
                                            <time class="post-date" datetime="<?php echo get_the_date(); ?>">
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </time>
                                        </span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                            </article>

                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </div>


            </div>

        </section>

    </section>

    <section class="related-posts">
        <div class="block-head block-head-ac block-head-a block-head-a1 is-left">
            <h4 class="heading">Useful <span class="color">Tools</span></h4>
            <span class="pull-right">
                <a href="<?php echo site_url('category/tools/'); ?>">View All</a>
            </span>
        </div>

        <section class="block-wrap block-grid cols-gap-sm mb-none" data-id="2">

            <div class="block-content">

                <div class="loop loop-grid loop-grid-sm grid grid-5 md:grid-2 xs:grid-1">

                    <?php
                    $featuredTool = wprefers_core_get_featured_blogs('page', 'wprefers_core_button_is_featured', 'on', 5);
                    ?>

                    <?php
                    if ($featuredTool->have_posts()) {
                        while ($featuredTool->have_posts()) {
                            $featuredTool->the_post();
                            ?>

                            <article class="l-post  grid-sm-post grid-post">
                                <div class="media">
                                    <a href="<?php echo get_permalink(get_the_ID()); ?>"
                                       class="image-link media-ratio ratio-16-9"
                                       title="<?php echo get_the_title(); ?>">
                                <span data-bgsrc="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>"
                                      class="img bg-cover wp-post-image attachment-bunyad-medium size-bunyad-medium no-display appear lazyloaded"
                                      data-bgset="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 450w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 300w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 768w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 150w, <?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?> 1013w"
                                      data-sizes="(max-width: 377px) 100vw, 377px" role="img"
                                      aria-label="<?php echo basename( get_permalink() ); ?>"
                                      style="background-image: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full'); ?>');"></span>
                                    </a>
                                </div>
                                <div class="content">
                                    <div class="post-meta post-meta-a has-below">
                                        <h2 class="is-title post-title">
                                            <a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                        <div class="post-meta-items meta-below">
                                    <span class="meta-item date">
                                        <span class="date-link">
                                            <time class="post-date" datetime="<?php echo get_the_date(); ?>">
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </time>
                                        </span>
                                    </span>
                                        </div>
                                    </div>
                                </div>

                            </article>

                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>

                </div>


            </div>

        </section>

    </section>

</div> <!-- .main -->

<?php get_footer(); ?>

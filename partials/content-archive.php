<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="archive-thumbnail">

        <?php if (has_post_thumbnail()) : ?>
            <a class="thumbnail-link" href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('velove-archive', array('class' => 'entry-thumbnail', 'alt' => esc_attr(get_the_title()))); ?>
            </a>
        <?php endif; ?>

        <?php if ('post' == get_post_type()) : ?>
            <?php
            $category = get_the_category(get_the_ID());
            if ($category) :
            ?>
                <span class="entry-category">
                    <a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>"><?php echo esc_attr($category[0]->name); ?></a>
                </span>
            <?php endif; // End if category
            ?>
        <?php endif; ?>

    </div>

    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

    <div class="entry-meta"><span class="author vcard"><?php printf(esc_html__('by %s', 'velove'), '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'); ?></span></div>

</article><!-- #post-## -->

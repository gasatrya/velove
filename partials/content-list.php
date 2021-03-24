<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class(); ?>>

    <div class="content">

        <?php if (has_post_thumbnail()) : ?>
            <a class="thumbnail-link" href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('velove-most', array('class' => 'entry-thumbnail', 'alt' => esc_attr(get_the_title()))); ?>
            </a>
        <?php endif; ?>

        <div class="content-text">

            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

            <div class="entry-meta"><?php velove_entry_meta(); ?></div>

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>

            <span class="more-link-wrapper">
                <a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e('Read More', 'velove'); ?></a>
            </span>

        </div>

    </div>

</article><!-- #post-## -->

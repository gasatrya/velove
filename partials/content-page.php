<?php
// Get the customizer value.
$enable_page_thumbnail = get_theme_mod('velove_page_thumbnail', 0);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ($enable_page_thumbnail && has_post_thumbnail()) : ?>
        <a class="thumbnail-link" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('velove-post', array('class' => 'entry-thumbnail', 'alt' => esc_attr(get_the_title()))); ?>
        </a>
    <?php endif; ?>

    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'velove'),
            'after'  => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php edit_post_link(esc_html__('Edit', 'velove'), '<span class="edit-link">', '</span>'); ?>

</article><!-- #post-## -->

<?php
// Get the customizer data.
$enable_post_thumbnail = get_theme_mod('velove_post_thumbnail', 1);
$enable_post_meta      = get_theme_mod('velove_post_meta', 1);
$enable_post_tags      = get_theme_mod('velove_post_tags', 1);

// Get the layout.
if (current_theme_supports('theme-layouts')) {
    $layout = get_theme_mod('theme_layout', 'default');
} else {
    $layout = 'default';
}
?>
<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class(); ?>>

    <time class="entry-date published vertical-text-wrapper" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><a class="vertical-text" href="<?php the_permalink(); ?>"><span class="vertical-text-inner"><?php echo esc_html(get_the_date()); ?></span></a></time>

    <div class="content">

        <?php if ($enable_post_thumbnail && has_post_thumbnail()) : ?>
            <?php
            if ($layout == 'full-width') {
                the_post_thumbnail('velove-post-full', array('class' => 'entry-thumbnail', 'alt' => esc_attr(get_the_title())));
            } else {
                the_post_thumbnail('velove-post', array('class' => 'entry-thumbnail', 'alt' => esc_attr(get_the_title())));
            }
            ?>
        <?php endif; ?>

        <div class="content-text">

            <?php if ($enable_post_meta) : ?>

                <div class="entry-meta">
                    <span class="author vcard"><?php printf(esc_html__('by %s', 'velove'), '<a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'); ?></span>
                    <span class="seperator"></span>
                    <span class="reading-time"></span> <span class="reading-text"><?php esc_html_e('Read', 'velove'); ?></span>

                    <?php if ('post' == get_post_type()) : ?>
                        <?php
                        /* translators: used between list items, there is a space after the comma */
                        $categories_list = get_the_category_list(esc_html__(', ', 'velove'));
                        if ($categories_list && velove_categorized_blog()) :
                        ?>
                            <span class="cat-links">
                                <?php printf(esc_html__('Posted on %s', 'velove'), $categories_list); ?>
                            </span>
                        <?php endif; // End if categories
                        ?>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

            <div class="entry-content">

                <?php the_content(); ?>
                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'velove'),
                    'after'  => '</div>',
                ));
                ?>

            </div>

        </div>

    </div>

    <footer class="entry-footer">

        <?php
        $tags = get_the_tags();
        if ($enable_post_tags && $tags) :
        ?>
            <span class="tag-links">
                <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">#<?php echo esc_attr($tag->name); ?></a>
                <?php endforeach; ?>
            </span>
        <?php endif; ?>

    </footer>

</article><!-- #post-## -->

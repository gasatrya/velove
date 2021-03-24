<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="attachment-img thumbnail-link">
        <?php
        /**
         * Filter the default image attachment size.
         */
        $image_size = apply_filters('velove_attachment_size', 'full');

        echo wp_get_attachment_image(get_the_ID(), $image_size);
        ?>
    </div><!-- .entry-attachment -->

</article><!-- #post-## -->

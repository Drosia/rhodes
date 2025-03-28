<?php
/**
 * The template for displaying the footer.
 */
?>
<?php if ( have_rows('footer_column_1', 'options') || have_rows('footer_column_2', 'options') || have_rows('footer_column_3', 'options') ) : ?>
    <footer class="site-footer">
        <div class="container">
            <div class="footer--content">
                <?php 
                $footer_columns = [
                    'footer_column_1' => 'footer--col-1',
                    'footer_column_2' => 'footer--col-2',
                    'footer_column_3' => 'footer--col-3'
                ];

                $column_index = 0;
                foreach ( $footer_columns as $column_key => $column_class ) : 
                    if ( have_rows($column_key, 'options') ) : ?>
                        <div class="<?= esc_attr($column_class); ?>" data-aos="fade-up" data-aos-delay="<?= $column_index * 200 ?>" data-aos-duration="1000">
                            <?php while ( have_rows($column_key, 'options') ) : the_row(); 
                                $title = get_sub_field('title');
                                $links = get_sub_field('links');
                                $address = get_sub_field('address');
                                $address_icon = get_sub_field('address_icon'); // Added for address icon
                            ?>
                                <?php if ( !empty($title) ) : ?>
                                    <h3><?= esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ( !empty($links) || !empty($address) ) : ?>
                                    <?php if ($column_key === 'footer_column_1'): ?>
                                        <ul class="footer-icon-list">
                                    <?php else: ?>
                                        <ul>
                                    <?php endif; ?>
                                        <?php if ( !empty($links) ) : ?>
                                            <?php foreach ( $links as $link_item ) : 
                                                $link = isset($link_item['link']) ? $link_item['link'] : null;
                                                $icon = isset($link_item['icon']) ? $link_item['icon'] : null; // Assuming you added an icon field
                                                if ( $link && !empty($link['url']) && !empty($link['title']) ) : ?>
                                                    <li>
                                                        <?php if ($icon): ?>
                                                            <?php 
                                                            $filename = get_the_title($icon['ID']);
                                                            echo wp_get_attachment_image($icon['ID'], 'full', false, ['class' => 'footer__icon', 'alt' => $filename]); 
                                                            ?>
                                                        <?php endif; ?>
                                                        <a href="<?= esc_url($link['url']); ?>">
                                                            <?= esc_html($link['title']); ?>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                        <?php if ( !empty($address) ) : ?>
                                            <li>
                                                <?php if ($address_icon): ?>
                                                    <img src="<?= esc_url($address_icon['url']); ?>" alt="Address Icon" class="footer__icon">
                                                <?php endif; ?>
                                                <?= $address; ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; 
                    $column_index++;
                endforeach; ?>
            </div>
            <?php if ( have_rows('outer_footer', 'options') ) : ?>
                <?php while ( have_rows('outer_footer', 'options') ) : the_row(); ?>
                    <?php
                        $copyright = get_sub_field('copyright');
                        $designed_by = get_sub_field('designed_by');
                    ?>
                    <div class="footer--outer">
                        <div class="footer--logo">
                            <?php if ( have_rows('logos') ) : ?>
                                <?php while ( have_rows('logos') ) : the_row(); ?>
                                    <?php 
                                        $logo_id = get_sub_field('logo'); // Assuming 'image' stores the image ID
                                        if ( !empty($logo_id) ) :
                                            echo wp_get_attachment_image($logo_id, 'full', false, ['alt' => 'Footer Logo']);
                                        endif;
                                    ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                        <div class="footer--txt">
                            <?php if ( !empty($copyright) ) : ?>
                                <div class="footer__copyright"><?= esc_html($copyright); ?></div>
                            <?php endif; ?>
                            <?php if ( !empty($designed_by) ) : ?>
                                <div class="footer__designed_by"><?= esc_html($designed_by); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>    
        </div>
    </footer>
<?php endif; ?>

<?php wp_footer(); ?>
<button-widget widget-id="c1eb5c90-33a8-40fd-b99f-f3e5e74d7a49"></button-widget>
</body>
</html>
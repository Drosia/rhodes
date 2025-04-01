<?php
/**
 * Post content
 */

?>
<section class="section section--cruise">
    <div class="container">
        <div class="cruise--wrapper">
            <div class="cruise__left" data-aos="fade-right" data-aos-duration="1000">
                <div class="cruise--the-content">
                    <?php echo the_content(); ?>
                </div>
                <?php
                /*
                <!-- START comment out this  -->
                <?php if( have_rows('services') ): ?>
                    <ul class="cruise--services">
                        <?php while( have_rows('services') ): the_row(); 
                            $service_title = get_sub_field('service_title');
                            $service_value = get_sub_field('service_value');
                            ?>
                            <li>
                                <span class="service_title"><?= $service_title ?>:</span>
                                <span class="service_value"><?= $service_value ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                <div class="cruise--image-gallery">
                    <?php 
                        $cruice_gallery = get_field('cruice_gallery');
                        $size = 'full'; // (thumbnail, medium, large, full or custom size)
                        $post_title = get_the_title(); // Get the current post title

                        if( $cruice_gallery ): ?>
                            <div class="grid">
                                <?php foreach( $cruice_gallery as $image_id ): ?>
                                    <div class="grid-item">
                                        <?php 
                                            $image_src = wp_get_attachment_image_src($image_id, $size);

                                            if ($image_src) :
                                            ?>
                                                <a href="<?php echo esc_url($image_src[0]); ?>" 
                                                    data-lightbox="gallery" 
                                                    data-title="<?php echo esc_attr($post_title); ?>"
                                                    data-lightbox="roadtrip"
                                                    data-alwaysShowNavOnTouchDevices="true"
                                                >
                                                    <?php echo wp_get_attachment_image($image_id, $size); ?>
                                                </a>
                                            <?php endif; ?>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                    <?php endif; ?>                    
                </div>
                */ ?>
                <!-- END comment out this  -->
            </div>
            <!-- START comment out this  -->
            <?php
                /*
            <div class="cruise__right">
                <div class="form-wrapper form-wrapper--simple">
                    <form>
                        <input type="date" class="js-date" id="date" name="date" required>
                        <select id="guests" name="guests">
                            <?php
                            $max_guests = get_field('guests_up_to'); // Retrieve the custom field value

                            if ($max_guests): // Check if value exists
                            ?>
                                <?php for ($i = 1; $i <= $max_guests; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Guest<?php echo ($i > 1) ? 's' : ''; ?></option>
                                <?php endfor; ?>
                            <?php
                            else:
                                echo '<option value="0">Not Availiable</option>'; // Handle case where the field is empty
                            endif;
                            ?>
                        </select>	
                        <div class="submit--row">
                            <div class="submit--col">
                                <span>By sumbiting this form you consent to the websites cookies policy & terms.</span>
                            </div>
                            <div class="submit--col">
                                    <button class="btn" type="submit">Book Now</button>
                            </div>
                        </div>
					</form>
                </div>
            </div>
            */ ?>
            <!-- END comment out this  -->
        </div>
    </div>
</section>

<?php
/**
 * Cruise Section
 */
?>

<?php if( have_rows('cruises') ): ?>
    <?php while( have_rows('cruises') ): the_row(); 

            $background_image = get_sub_field('background_image');
            $title = get_sub_field('title');
            $subtitle = get_sub_field('subtitle');
            $quoter = get_sub_field('quoter');
            $title_bottom = get_sub_field('title_bottom');
            $text_bottom = get_sub_field('text_bottom');
            $cruises = get_sub_field('cruises');
            $show_guests = get_sub_field('show_guests');

            $background_url = !empty($background_image) ? $background_image['url'] : '';
            $section_class = !empty($background_url) ? 'section--cruises background-image' : 'section--cruises-dark';
            $style_attr = !empty($background_url) ? "style=\"background-image: url('" . esc_url($background_url) . "');\"" : '';
          
            
            // Check if the content is empty before rendering
            if (empty($title) && empty($subtitle) && empty($quoter) && empty($title_bottom) && empty($text_bottom) && empty($cruises) && empty($show_guests) && empty($background_url)) {
                // Skip rendering if all necessary fields are empty
                continue;
            }

        ?>
        
        <section class="section <?= esc_attr($section_class); ?>" <?= $style_attr; ?>>
            <div class="container">
                <?php if ( ! empty($title) && ! empty($subtitle) && ! empty($quoter) ) : ?>
                    <div class="cruises__top">
                        <?php if( $title) : ?>
                            <h2> <?= $title ?></h2>
                        <?php endif; ?>
                        <?php if( $subtitle) : ?>
                            <p> <?= $subtitle ?></p>
                        <?php endif; ?>
                        <?php if( $quoter) : ?>
                            <span> <?= $quoter ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="cruises__bottom">
                    <?php if( $title_bottom) : ?>
                        <h2> <?= $title_bottom ?></h2>
                    <?php endif; ?>
                    <?php if( $text_bottom) : ?>
                        <p> <?= $text_bottom ?></p>
                    <?php endif; ?>
                    <?php if ($cruises) : ?>
                        <div class="cruises--container">
                            <?php foreach ($cruises as $cruise_id) : 
                                $cruise_title   = get_the_title($cruise_id);
                                $cruise_permalink = get_permalink($cruise_id);
                                $cruise_thumb   = get_the_post_thumbnail_url($cruise_id, 'full');
                                $cruise_excerpt = get_the_excerpt($cruise_id);
                                $starting_trip  = get_field('starting_trip', $cruise_id);
                                $end_trip       = get_field('end_trip', $cruise_id);
                                $upon_request   = get_field('upon_request', $cruise_id);
                                $guests_up_to   = get_field('guests_up_to', $cruise_id);
                                $free_text_on_bellow_button   = get_field('free_text_on_bellow_button', $cruise_id);

                                $show_guests_text = !empty($show_guests) ? ' up to ' . $guests_up_to .  ' guests' : '';
                                // Calculate trip duration
                                $trip_duration_text = '';
                                if ( empty( $free_text_on_bellow_button ) ){
                                    if ($starting_trip && $end_trip) {
                                        $start_time = DateTime::createFromFormat('H:i:s', $starting_trip);
                                        $end_time   = DateTime::createFromFormat('H:i:s', $end_trip);
                                
                                        if ($start_time && $end_time) {
                                            $duration = $end_time->diff($start_time)->h; // Get duration in hours
                                
                                            // Format start time as 24-hour format with AM/PM appended manually
                                            $start_time_formatted = $start_time->format('H:i'); // 24-hour format (e.g., 10:00)
                                            
                                            // Format end time as 24-hour format with AM/PM appended manually
                                            $end_time_formatted = $end_time->format('H:i'); // 24-hour format (e.g., 15:00)
                                
                                            // Check if the hour is greater than or equal to 12, add "pm" suffix
                                            if ((int) $end_time->format('H') >= 12) {
                                                $end_time_formatted .= ' pm'; // Add 'pm' if the hour is 12 or later
                                            } else {
                                                $end_time_formatted .= ' am'; // Add 'am' if the hour is before 12
                                            }
                                
                                            // Similarly for start time
                                            if ((int) $start_time->format('H') >= 12) {
                                                $start_time_formatted .= ' pm'; // Add 'pm' if the hour is 12 or later
                                            } else {
                                                $start_time_formatted .= ' am'; // Add 'am' if the hour is before 12
                                            }
                                
                                            $trip_duration_text = "{$duration} hour semi-private cruise from {$start_time_formatted} - {$end_time_formatted}";
                                
                                            // Add any extra text for guests, if applicable
                                            $trip_duration_text .= $show_guests_text;
                                        }
                                    }
                                } else {
                                    $trip_duration_text = $free_text_on_bellow_button;
                                }
                                

                            ?>
                                <div class="cruise--item">
                                    <a href="<?= esc_url($cruise_permalink); ?>" class="cruise-link">
                                        <?php if ($cruise_thumb) : ?>
                                            <div class="cruise-image">
                                                <img src="<?= esc_url($cruise_thumb); ?>" alt="<?= esc_attr($cruise_title); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <h3 class="cruise-title"><?= esc_html($cruise_title); ?></h3>

                                        <?php if ($cruise_excerpt) : ?>
                                            <span class="cruise-excerpt"><?= esc_html($cruise_excerpt); ?></span>
                                        <?php endif; ?>

                                        <?php if (!$upon_request) : ?>
                                            <div class="btn">Book your seats</div>
                                        <?php else : ?>
                                            <div class="btn">Upon Request</div>
                                        <?php endif; ?>

                                        <?php if ($trip_duration_text) : ?>
                                            <span class="cruise-duration"><?= esc_html($trip_duration_text); ?></span>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
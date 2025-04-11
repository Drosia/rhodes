<?php
/**
 * Free Text Section
 */
?>

<?php if( get_field('free_text') ): 

    $free_text = get_field('free_text');
    if ( empty( $free_text ) ) {
        return; // Stop execution instead of continue;
    }
?>
    <section class="section section--free-text">
        <div class="container">
			<div class="simple-text">
				<?php if( $free_text ) : ?>
					<p><?=  $free_text; ?></p>
				<?php endif; ?>
			</div>
        </div>
    </section>
<?php endif; ?>

<?php
if ( 'case-study' === get_post_type() ) {
$title = get_the_title();
$subtitle = get_field('subtitle', get_the_ID());
$thumbnail_id = get_post_thumbnail_id();
$featured_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
$alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
$client = get_the_terms(get_the_ID(), 'client');
$industries = get_the_terms(get_the_ID(), 'industries');
$services = get_the_terms(get_the_ID(), 'services');
?>

<section class="single-case-study container">
    <div class="row single-case-study__row position-relative py-4">
        <div class="col-12">
            <?php if ( $title ) : ?>
                <h1 class="mb-2 text-black">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>
            <?php if ( $subtitle ) : ?>
                <div class="text-steel mb-0 h3">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
            <?php if ( $featured_image_url ) : ?>
                <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>" class="w-100 mt-6 mt-md-8 mt-lg-10 position-relative"/>
            <?php endif; ?>
        </div>
    </div>
    <div class="row single-case-study__row--bottom">
        <div class="col background-lightest-silver p-6 p-md-8 p-lg-10">
            <div class="row single-case-study__row--bottom__wrap">
                <?php if ( ! empty( $client ) && ! is_wp_error( $client ) ) : ?>
                    <div class="col">
                        <span class="text-blue-ada text-sm-medium mb-0">
                            Client
                        </span>
                        <?php $lastClient = end($client); ?>
                        <p class="text-lg-medium text-black font-tertiary">
                            <?php foreach( $client as $clients): ?>
                                <?php echo esc_html( $clients->name );
                                    if ($clients !== $lastClient) {
                                        echo ', ';
                                    }
                                ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                    <div class="col">
                        <span class="text-blue-ada text-sm-medium mb-0">
                            Industry
                        </span>
                        <?php $lastInd = end($industries); ?>
                        <p class="text-lg-medium text-black font-tertiary">
                            <?php foreach( $industries as $industry): ?>
                                <?php echo esc_html( $industry->name );
                                    if ($industry !== $lastInd) {
                                        echo ', ';
                                    }
                                ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $services ) && ! is_wp_error( $services ) ) : ?>
                    <div class="col">
                        <span class="text-blue-ada text-sm-medium mb-0">
                            Services
                        </span>
                        <?php $lastServ = end($services); ?>
                        <p class="text-lg-medium text-black font-tertiary">
                            <?php foreach( $services as $service): ?>
                                <?php echo esc_html( $service->name );
                                    if ($service !== $lastServ) {
                                        echo ', ';
                                    }
                                ?>
                            <?php endforeach; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row pt-4">
                <?php
                    $current_url   = esc_url( get_permalink() );
                    $encoded_url   = urlencode( get_permalink() );
                    $current_title = urlencode( get_the_title() );
                    ?>

                    <div class="share-buttons" role="group" aria-label="Share this page">
                    <!-- Copy Link -->
                    <button type="button" class="button button--share-btn copy-link text-tertiary" data-url="<?php echo $current_url; ?>" aria-label="Copy page link to clipboard">
                        Copy link
                    </button>
                    <!-- X / Twitter -->
                    <a class="share-btn twitter" href="https://twitter.com/intent/tweet?url=<?php echo $encoded_url; ?>&text=<?php echo $current_title; ?>" target="_blank" rel="noopener noreferrer" aria-label="Share this page on X (opens in a new window)">
                        <span aria-hidden="true">X</span>
                    </a>
                    <!-- Facebook -->
                    <a class="share-btn facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>" target="_blank" rel="noopener noreferrer" aria-label="Share this page on Facebook (opens in a new window)">
                        <span aria-hidden="true">Facebook</span>
                    </a>
                    <!-- LinkedIn -->
                    <a class="share-btn linkedin" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encoded_url; ?>" target="_blank" rel="noopener noreferrer" aria-label="Share this page on LinkedIn (opens in a new window)">
                        <span aria-hidden="true">LinkedIn</span>
                    </a>
                </div>
                <!-- Screen reader live region -->
                <div id="copy-status" class="visually-hidden" aria-live="polite"></div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
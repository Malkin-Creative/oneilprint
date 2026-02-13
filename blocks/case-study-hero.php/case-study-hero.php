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
                        <p class="text-lg-medium text-black text-tertiary">
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
                        <p class="text-lg-medium text-black text-tertiary">
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
                        <p class="text-lg-medium text-black text-tertiary">
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
            <div class="row">
                <div class="share-buttons" role="group" aria-label="Share this page">
                    <button class="share-btn" id="copyLinkBtn" aria-label="Copy page link to clipboard">
                        Copy Link
                    </button>

                    <a class="share-btn"
                    id="shareFacebook"
                    href="#"
                    target="_blank"
                    rel="noopener"
                    aria-label="Share this page on Facebook">
                        Facebook
                    </a>

                    <a class="share-btn"
                    id="shareX"
                    href="#"
                    target="_blank"
                    rel="noopener"
                    aria-label="Share this page on X">
                        X
                    </a>

                    <a class="share-btn"
                    id="shareLinkedIn"
                    href="#"
                    target="_blank"
                    rel="noopener"
                    aria-label="Share this page on LinkedIn">
                        LinkedIn
                    </a>

                    <span id="copyStatus" class="visually-hidden" aria-live="polite"></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
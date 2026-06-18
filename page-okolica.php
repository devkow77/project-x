<?php get_header(); ?>

<main>
<?php Container(function(){ ?>

    <!-- Nagłówek strony -->
    <div class="mt-30 space-y-4 md:mt-40">
        <h1 class="text-[#232323] text-3xl sm:text-4xl lg:text-5xl font-bold text-center">
            Okolica
        </h1>

        <!-- Breadcrumb -->
        <div class="flex items-center justify-center gap-x-2 text-xs tracking-widest">
            <a href="/" class="text-[#6E6E6E]">Home</a>
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none">
                <path d="M15 18L20.6464 12.3536C20.8417 12.1583 20.8417 11.8417 20.6464 11.6464L15 6" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M21 12L3 12" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <a href="/okolica">Okolica</a>
        </div>
    </div>

    <!-- Hero -->
    <div class="relative p-4 bg-black/40 aspect-video max-h-100 w-full text-white flex justify-between items-end sm:p-8 md:rounded-xl">
        <?php echo wp_get_attachment_image(65, 'large', false, [
        'class' => 'absolute inset-0 size-full object-cover object-center -z-1 md:rounded-xl',
        'loading' => 'eager']); 
        ?>

        <h2 class="font-bold text-xl sm:text-3xl lg:text-5xl lg:leading-16">
            Odkryj <br> Zieloną Górę
        </h2>

        <div class="h-full flex flex-col justify-between items-center text-center">
            <h3>
                <span class="font-bold sm:text-2xl lg:text-3xl">Top 10</span><br>
                atrakcji
            </h3>
            <a href="#atrakcje" class="w-6 sm:w-8 lg:w-10" aria-label="Przejdź do atrakcji">
                <svg fill="#ffffff" viewBox="-0.92 -0.92 32.57 32.57" stroke="#ffffff">
                    <path d="M29.994,10.183L15.363,24.812L0.733,10.184c-0.977-0.978-0.977-2.561,0-3.536c0.977-0.977,2.559-0.976,3.536,0 l11.095,11.093L26.461,6.647c0.977-0.976,2.559-0.976,3.535,0C30.971,7.624,30.971,9.206,29.994,10.183z"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Sekcja atrakcji -->
    <section id="atrakcje" class="bg-[#FAFAFA] space-y-8 text-sm p-6 md:rounded-xl lg:p-10 lg:space-y-14">
        
        <!-- Ukryty nagłówek SEO -->
        <h2 class="sr-only">
            Najciekawsze atrakcje w Zielonej Górze w pobliżu hotelu
        </h2>

        <?php
        $args = array(
            'post_type'              => 'atrakcja',
            'posts_per_page'         => 15,
            'orderby'                => 'menu_order',
            'order'                  => 'ASC',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        );

        $query = new WP_Query($args);
        $index = 0;
        $schema_items = array();

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();

                $title  = get_the_title();
                $desc   = get_field('description');
                $img_id = get_field('image');
                $link   = get_field('url');

                // Schema dane
                $schema_items[] = array(
                    "@type"    => "ListItem",
                    "position" => $index + 1,
                    "name"     => $title,
                    "url"      => $link,
                );

                $rowClass = ($index % 2 !== 0) ? 'sm:flex-row-reverse' : 'sm:flex-row';
        ?>

            <article class="space-y-4 sm:flex <?php echo esc_attr($rowClass); ?> sm:gap-x-6 lg:gap-x-10">
                <div class="bg-white p-4 space-y-4 flex-1 rounded-xl flex flex-col justify-center xl:space-y-6 lg:px-6">
                    <h3 class="font-bold text-lg lg:text-xl xl:text-2xl">
                        <?php echo esc_html($title); ?>
                    </h3>

                    <div class="leading-6 lg:leading-7">
                        <?php echo esc_html($desc); ?>
                    </div>

                    <a href="<?php echo esc_url($link); ?>" class="text-[#2C9E5C] font-medium flex items-center gap-x-1">
                        Zobacz
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" transform="rotate(-45)" stroke="#2C9E5C">
                            <path d="M15 18L20.6464 12.3536C20.8417 12.1583 20.8417 11.8417 20.6464 11.6464L15 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 12L3 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>

                <div class="relative aspect-video flex-[1.25] rounded-xl">
                    <?php
                    if ($img_id) {
                        echo wp_get_attachment_image(
                            $img_id,
                            'medium',
                            false,
                            array(
                                'class' => 'absolute inset-0 size-full object-cover object-center rounded-xl',
                                'loading' => 'lazy'
                            )
                        );
                    }
                    ?>
                </div>
            </article>

        <?php
            $index++;
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="text-center py-10">Nie znaleziono żadnych atrakcji.</p>';
        endif;
        ?>
    </section>

<?php }, "!px-0 space-y-6 md:!px-6 md:space-y-12"); ?>
</main>

<?php if (!empty($schema_items)) : ?>
<script type="application/ld+json">
<?php
$attractions_schema = [
    "@context" => "https://schema.org",
    "@type" => "ItemList",
    "name" => "Top atrakcje w Zielonej Górze",
    "description" => "Lista najciekawszych atrakcji turystycznych w Zielonej Górze w pobliżu Apartamentów Drzewna",
    "itemListElement" => $schema_items,
    "url" => esc_url(home_url('/okolica/'))
];

echo json_encode($attractions_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
?>
</script>
<?php endif; ?>

<?php get_footer(); ?>
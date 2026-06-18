<?php 
    $title = $args['title'] ?? "Wyślij nam pytanie.";

    $cards = [
        [
            'icon' => 'duza-lokalizacja',
            'title' => 'Nasze główne lokalizacje',
            'content' => 'Kupiecka, Drzewna | Zielona Góra'
        ],
        [
            'icon'    => 'duzy-telefon',
            'title'   => 'Numer telefonu',
            'content' => '+48 790 635 582',
        ],
        [
            'icon'    => 'duzy-email',
            'title'   => 'Adres e-mail',
            'content' => 'kontakt@drzewnapartamenty.pl',
        ],
    ];
?>

<article id="kontakt" itemscope itemtype="https://schema.org/LocalBusiness" class="bg-[#002B17] text-white p-6 space-y-6 md:space-y-10 md:rounded-xl md:p-10 md:text-base">
    <meta itemprop="name" content="Apartamenty Drzewna">
    <meta itemprop="url" content="<?php echo home_url('/kontakt/'); ?>">
            
    <div class="flex flex-col gap-6 md:flex-row md:gap-10">
        <div class="flex-1 md:flex flex-col justify-between">
            <div class="space-y-2 md:space-y-4 lg:space-y-6">
                <h1 class="font-semibold text-xl sm:text-2xl md:text-3xl/10 lg:text-4xl/12 xl:text-5xl/14">
                    <?php echo esc_html($title); ?>
                </h1>
                <p class="text-[#a4a4a4]">Napisz lub zadzwoń do nas jeśli masz jakieś pytania. Z przyjemnością rozwiejemy wszelkie wątpliwości</p>
            </div>
            <button type="button" id="focus-name-input" aria-label="Przejdź do formularza" class="hidden bg-white w-20 h-20 rounded-full md:grid place-items-center lg:w-26 lg:h-26 cursor-pointer">
                <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/strzalka-gorne-prawo.svg')?>" alt="" role="presentation" class="w-10 lg:w-14" />
            </button>
        </div>

        <div class="bg-[#FAFAFA] p-4 rounded-lg text-black flex-[1.5]">
            <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" class="flex flex-col gap-y-2 md:gap-y-4">
                <input type="hidden" name="action" value="wyslij_kontakt">
                <?php wp_nonce_field('kontakt_form_action', 'kontakt_form_nonce'); ?>
                <input type="text" name="website" style="display:none">

                <label for="imie" class="font-medium">Imię</label>
                <input id="imie" name="user_name" required type="text" class="bg-white p-2 md:p-3 focus:outline-black/20" placeholder="Twoje imię...">
                    
                <label for="email" class="font-medium">Email</label>
                <input id="email" name="user_email" required type="email" class="bg-white p-2 md:p-3 focus:outline-black/20" placeholder="Twój email...">
                    
                <label for="telefon" class="font-medium">Numer telefonu</label>
                <input id="telefon" name="user_phone" required type="text" pattern="^\+[0-9]{1,3}\s[0-9\s]{6,12}$" 
                title="Wymagany format: +48 123 456 789 (+prefix_kraju numer_telefonu)"  inputmode="tel" class="bg-white p-2 md:p-3 focus:outline-black/20" placeholder="np. +48 123 456 789">
                    
                <label for="wiadomosc" class="font-medium">Wiadomość</label>
                <textarea id="wiadomosc" name="user_message" required class="bg-white p-2 md:p-3 resize-none h-40 focus:outline-black/20" placeholder="Twoja wiadomość..."></textarea>

                <button id="submit-btn" type="submit" class="w-full py-3 px-6 bg-black text-white rounded-xl font-medium flex items-center justify-center gap-x-1 md:py-4 cursor-pointer transition-all duration-300">
                    Prześlij
                    <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/strzalka-prawo.webp'); ?>" alt="" loading="lazy" decoding="async" class="w-6"/>
                </button>
            </form>
        </div>
    </div>

    <div class="relative flex flex-col gap-4 sm:flex-row md:gap-6">
        <meta itemprop="telephone" content="<?php echo esc_attr($cards[1]['content']); ?>">
        <meta itemprop="email" content="<?php echo esc_attr($cards[2]['content']); ?>">
        
        <img src="<?php echo get_theme_file_uri('/assets/images/loga/logo-drzewna-bez-napisu.webp'); ?>" alt="" loading="lazy" decoding="async" class="absolute bottom-0 left-1/5 w-50 opacity-20 hidden z-20 lg:block xl:w-60"/>

        <img src="<?php echo get_theme_file_uri('/assets/images/loga/logo-drzewna-bez-napisu.webp'); ?>" alt="" loading="lazy" decoding="async" class="absolute bottom-0 left-3/5 w-30 opacity-20 hidden z-20 lg:block"/>

        <?php foreach ($cards as $card): ?>
            <div class="flex flex-col gap-2 lg:bg-white/5 flex-1 rounded-xl lg:p-6 lg:aspect-video lg:justify-between z-10">
                <div class="w-6 lg:w-8 xl:w-10">
                      <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/'.$card['icon'].'.webp'); ?>" alt="" loading="lazy" decoding="async"/>
                </div>
                <div class="space-y-1">
                    <h2 class="text-[#525252]"><?php echo esc_html($card['title']); ?></h2>
                    <p><?php echo esc_html($card['content']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="map" aria-label="Mapa lokalizacji hoteli" class="bg-white/20 rounded-xl h-75 w-full lg:h-100"></div>
</article>
<?php get_header(); ?>

<main>
    <?php Container(function(){ ?>
    <!-- NAVIGACJA -->
    <div class="mt-30 space-y-4 md:mt-40">
        <h1 class="text-[#232323] text-3xl sm:text-4xl lg:text-5xl font-bold text-center">Parking</h1>
        <div class="flex items-center justify-center gap-x-2 text-xs tracking-widest">
            <a href="/" class="text-[#6E6E6E]">Home</a>
            <svg width="12px" height="12px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 18L20.6464 12.3536C20.8417 12.1583 20.8417 11.8417 20.6464 11.6464L15 6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 12L3 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            <a href="/parking">Parking</a>
        </div>
    </div>
    <article class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- CONTENT -->
            <section class="space-y-6 h-full">
                <div class="space-y-2">
                    <h2 class="text-lg font-bold sm:text-2xl">Gdzie zaparkować?</h2>
                    <p class="leading-6">Poniżej znajdziesz lokalizację najwiekszych parkingów w Zielonej Górze. Dzięki nim szybko i wygodnie zaparkujesz blisko atrakcji, restauracji i naszego obiektu przy ul. Drzewnej.</p>
                </div>
                <?php
                    $parkings = [
                        [
                            "name" => "Parking przy Palmiarni",
                            "address" => "ul. Wrocławska 12A, 65-427 Zielona Góra",
                            "position" => [51.9389, 15.5117],
                        ],
                        [
                            "name" => 'Focus Mall Zielona Góra',
                            "address" => 'ul. Wrocławska 17, 65-427 Zielona Góra',
                            "position" => [51.9382, 15.5128],
                        ],
                        [
                            "name" => 'Estrada Park',
                            "address" => 'ul. Wrocławska 18A, 65-427 Zielona Góra',
                            "position" => [51.9376, 15.5134],
                        ],
                        [
                            "name" => 'Plac Pocztowy',
                            "address" => 'Plac Pocztowy, 65-305 Zielona Góra',
                            "position" => [51.9399, 15.5058],
                        ],
                        [
                            "name" => 'Parking Podgórna (Urząd Miasta)',
                            "address" => 'ul. Podgórna 22, 65-213 Zielona Góra',
                            "position" => [51.9374, 15.5061],
                        ],
                    ];

                    $map_locations = [];
                    foreach ($parkings as $key => $parking) {
                        $map_locations[] = [
                            'pos' => ['lat' => $parking['position'][0], 'lng' => $parking['position'][1]],
                            'title' => $parking['name'],
                            'info' => $parking['name'] . ' — ' . $parking['address'],
                            'label' => (string) ($key + 1),
                        ];
                    }
                ?>
                <ul class="space-y-4 text-xs">
                    <?php foreach ($parkings as $key => $parking) :?>
                        <li class="flex items-center gap-x-4">
                            <div class="size-10 rounded-full grid place-items-center bg-green-900 text-white font-medium"><?php echo esc_html($key + 1); ?></div>
                            <div class="space-y-1 md:text-sm">
                                <h3 class="font-semibold"><?php echo esc_html($parking['name']); ?></h3>
                                <p class="flex items-center gap-x-1"><img src="<?php echo get_theme_file_uri('/assets/images/ikonki/lokalizacja.png'); ?>" alt="" class="w-4" loading="lazy" decoding="async" /> <?php echo esc_html($parking['address']); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!-- WSKAZÓWKA -->
                <div class="sm:flex sm:items-center space-y-2 sm:gap-x-4 p-3 bg-green-100 rounded-xl">
                    <div class="min-w-10 min-h-10 w-fit grid place-items-center rounded-md font-semibold text-green-600 border-2 border-green-600">P</div>
                    <div class="space-y-1 text-green-950">
                        <h4 class="font-semibold">Wskazówka</h4>
                        <p class="leading-5 text-xs md:text-sm md:leading-6 font-medium">Większość parkingów oferuje pierwszą godzinę parkowania za darmo lub atrakcyjne stawki za postój.</p>
                    </div>
                </div>
            </section>
            <!-- MAPA -->
            <div
                id="map"
                aria-label="Mapa parkingów w Zielonej Górze"
                data-locations="<?php echo esc_attr(wp_json_encode($map_locations)); ?>"
                class="grid place-items-center bg-green-900 rounded-xl aspect-video md:aspect-auto md:h-full"
            ></div>
        </div>
        <!-- ZAREZERWUJ APARTAMENT -->
        <secion class="flex items-center flex-wrap justify-between gap-4 p-4 bg-green-900 text-white rounded-xl md:py-8 md:px-10">
            <div class="flex items-center flex-wrap gap-4">
                <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/auto.png'); ?>" alt="" class="w-10 text-white" loading="lazy" decoding="async" />
                <div class="space-y-2">
                    <h2 class="font-semibold">Zarezerwuj apartament i ciesz się pobytem w Zielonej Górze</h2>
                    <p class="leading-6">Wszystkie nasze apartamenty znajdują się w świetnej lokalizacji - blisko centrum i najważniejszych atrakcji.</p>
                </div>
            </div>
            <a href="/apartamenty" class="py-3 px-6 rounded-xl bg-green-700 font-medium">ZOBACZ APARTAMENTY</a>
        </secion>
    </article>
    <?php }, "space-y-6 text-sm md:space-y-12"); ?>
</main>

<?php get_footer(); ?>

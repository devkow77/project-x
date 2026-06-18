<?php get_header(); ?>

<main class="bg-[#FFFAF5]">
    <?php 
    Container(function() {
    ?>
    <!-- W SERCU MIASTA -->
    <div class="relative mx-auto pt-6 text-center bg-[#FFFAF5] z-2 w-fit rounded-xl md:pt-12 md:-mt-6">
        <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/herb.webp'); ?>" alt="Herb Zielona Góra" class="mx-auto mb-4 w-10 md:w-12 md:mb-6 xl:w-14" loading="lazy" decoding="async" />
        <p class="tracking-widest uppercase xl:mb-2">W sercu miasta</p>
        <h2 class="text-base font-semibold sm:text-xl md:text-2xl xl:text-3xl">Nowoczesne Apartamenty</h2>
    </div>
    <!-- LISTA APARTAMENTÓW -->
    <section id="apartamenty" aria-label="Lista dostępnych apartamentów w Zielonej Górze" class="space-y-6">
        <?php 
        $args = array(
            'post_type'              => 'apartament',
            'posts_per_page'         => -1,
            'orderby'                => 'menu_order',
            'order'                  => 'ASC',
            'no_found_rows'          => true,
            'update_post_meta_cache' => true,
            'update_post_term_cache' => false,
            'suppress_filters'       => false,
            'fields'                 => 'ids'
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();

            $title  = get_the_title();
            $rating = get_field('rating');
            $bio    = get_field('bio');
            $price  = get_field('price');
            $room   = get_field('room');
            $bathroom = get_field('bathroom');
            $parking  = get_field('parking');
            $extra_info = get_field('extra_info');
            $img_id = get_field('image');
            $udogodnienie = get_field('udogodnienie');
            $udogodnienie2 = get_field('udogodnienie2');
            $link   = get_field('url');
        ?>
        <article class="grid grid-cols-1 gap-0 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3 py-4 md:px-4 bg-[#FAFAFA] xl:p-8 shadow-sm md:rounded-xl border border-slate-200">
            <div class="relative aspect-video w-full md:rounded-xl sm:h-full sm:max-h-none">
                <?php echo wp_get_attachment_image($img_id, 'large', false, array(
                    'class' => 'absolute size-full object-cover object-center md:rounded-xl',
                    'loading' => 'lazy',
                    'sizes' => '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 33vw'
                )); ?>
                <div class="flex gap-x-2 absolute right-4 top-4 bg-white px-3 py-2 rounded-xl text-xs shadow-md">
                    <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/gwiazdka-czarna.webp'); ?>" alt="" class="w-4" loading="lazy" decoding="async" />
                    <p><?php echo esc_html($rating); ?></p>
                </div>
            </div>

            <div class="bg-white px-6 py-4 sm:rounded-xl xl:py-6">
                <div class="border-b border-[#f3f3f3] pb-4">
                    <h3 class="text-lg font-semibold xl:text-2xl"><?php echo esc_html($title); ?></h3>
                    <p><?php echo esc_html($bio); ?></p>
                    <p class="text-base font-medium mt-4 xl:text-lg">
                        <?php echo esc_html($price); ?> zł / doba
                    </p>
                </div>

                <div class="pt-4 space-y-4">
                    <p class="font-semibold">Podstawowe informacje</p>
                    <ul class="space-y-1 xl:space-y-3 font-medium">
                        <li class="flex justify-between">Ilość pokoi <span><?php echo esc_html($room); ?></span></li>
                        <li class="flex justify-between">Łazienki <span><?php echo esc_html($bathroom); ?></span></li>
                        <li class="flex justify-between">Parking <span><?php echo esc_html($parking); ?></span></li>
                        <li class="flex justify-between">Dodatkowe informacje <span class="text-right"><?php echo esc_html(trim($extra_info)); ?></span></li>
                    </ul>
                </div>
            </div>
            <div class="bg-white px-6 py-4 space-y-4 sm:col-span-2 sm:rounded-xl lg:col-span-1 xl:py-6">
                <div class="flex gap-x-4">
                    <div class="size-8 shrink-0">
                        <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/udogodnienia.webp'); ?>" alt="" loading="lazy" decoding="async" />
                    </div>
                    <div>
                        <p class="font-medium xl:text-base xl:mb-2">Świetne Wyposażenie</p>
                        <p class="text-xs text-[#232323]"><?php echo esc_html($udogodnienie); ?></p>
                    </div>
                </div>
                <div class="flex gap-x-4">
                    <div class="size-8 shrink-0">
                    <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/sofa.webp'); ?>" alt="" loading="lazy" decoding="async" />
                    </div>
                    <div>
                        <p class="font-medium xl:text-base xl:mb-2">Udogodnienia</p>
                        <p class="text-xs text-[#232323]"><?php echo esc_html($udogodnienie2); ?></p>
                    </div>
                </div>
                <a href="<?php echo esc_url($link); ?>" 
                class="block w-full rounded-xl px-4 py-3 bg-gradient-green text-white text-center font-medium">
                    Rezerwuj Online!
                </a>
            </div>
        </article>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </section>
    <!-- ATRAKCJE -->
    <section id="atrakcje" class="mt-12 p-4 py-6 bg-[#121212] text-white space-y-8 text-sm md:rounded-xl md:p-8 md:mt-24 xl:p-10" aria-labelledby="atrakcje-title">
        <div class="-mt-16 md:-mt-22 space-y-6">
            <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/trasa.webp'); ?>" alt="" loading="lazy" decoding="async" class="bg-white rounded-full w-16 mx-auto p-2 md:w-20" />
            <div class="text-center space-y-2">
                <p class="tracking-widest xl:text-base">2 KROKI OD</p>
                <h2 id="atrakcje-title" class="text-2xl font-bold xl:text-4xl">Okolicznych Atrakcji</h2>
            </div>
        </div>
        
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-24">
            <div class="space-y-4">
                <div class="flex items-center gap-x-2" aria-hidden="true" role="decoration">
                    <div class="w-10 h-0.5 bg-white"></div>
                    <div class="w-4 h-0.5 bg-white"></div>
                </div>
                <p class="font-medium"><data value="9.5">9.5/10</data></p>
                <h3 class="font-bold text-xl xl:text-2xl">Idealna lokalizacja: <br><span class="font-medium text-base xl:text-lg">odkrywaj uroki miasta bez zbędnych dystansów.</span></h3>
                <p class="font-light leading-6">Położenie naszych apartamentów w ścisłym centrum Zielonej Góry oferuje bezpośredni dostęp do najlepszych knajp i lokali w mieście. Piesze zwiedzanie miasta, przystanek na pyszną kawę czy rodzinny obiad. To wszystko zaledwie kilka kroków od apartamentu.</p>
            </div>
            
            <div class="relative aspect-video rounded-xl h-full sm:aspect-auto">
                <?php echo drzewna_attachment_image('miasto-zielona-gora', 'medium', [
                    'class' => 'absolute size-full object-center object-cover rounded-xl',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => 'Panorama Zielonej Góry - lokalizacja hotelu w centrum'
                ]); 
                ?>
            </div>
            
            <div class="space-y-4 sm:col-span-2 lg:col-span-1">
                <?php 
                    $cards = [
                        [
                            'icon' => "panda-biala",
                            'title' => 'Zoo w Zielonej Górze',
                            'description' => 'Zabawa dla całej rodziny'
                        ],
                        [
                            'icon' => "palmiarnia",
                            'title' => 'Palmiarnia',
                            'description' => 'Egzotyka w Zielonej Górze'
                        ],
                        [
                            'icon' => "park-winny",
                            'title' => 'Park Winny',
                            'description' => 'Dla koneserów i nie tylko'
                        ],
                        [
                            'icon' => "park-ksiazecy",
                            'title' => 'Park Książęcy Zatonie',
                            'description' => 'Odkryj Zatońskie skarby'
                        ],
                    ];
                ?>
                <?php foreach ($cards as $card): ?>
                    <div class="flex items-center gap-x-4 p-4 rounded-xl bg-[rgba(25,25,25,1)]">
                        <img src="<?php echo get_theme_file_uri("/assets/images/ikonki/".$card['icon'].".webp"); ?>" alt="" class="w-8" loading="lazy" decoding="async" />
                        <div class="space-y-1">
                            <p class="font-medium text-white"><?php echo esc_html($card['title']); ?></p>
                            <p class="font-light text-xs text-gray-400"><?php echo esc_html($card['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <a href="/atrakcje" class="block text-center w-full py-3 bg-gradient-green rounded-2xl font-medium md:py-4">Zobacz Wszystkie</a>
            </div>
            
            <div class="hidden sm:flex items-center justify-center sm:row-span-2 lg:justify-start">
                <?php echo drzewna_attachment_image('drzewo', 'medium', [
                    'class' => 'scale-75 sm:scale-100',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => ''
                ]); 
                ?>
            </div>
            
            <div class="space-y-4">
                <p class="text-6xl font-bold bg-gradient-green drop-shadow-[0_4px_2px_rgba(255,255,255,0.25)] bg-clip-text text-transparent"><data value="25">25+</data></p>
                <p class="leading-6 font-light">Do państwa użytku oddajemy ponad 25 apartamentów urządzonych z myślą o różnych typach gości. Od rodzin z dziećmi, przez osoby wyjeżdżające służbowo aż po zorganizowane grupy</p>
                <a href="/atrakcje-premium" class="font-bold border-b border-transparent hover:border-white transition-all">Zobacz Wszystkie</a>
            </div>
            
            <div class="relative aspect-video rounded-xl h-full">
                <?php echo drzewna_attachment_image('apartament-nieznany', 'medium', [
                    'class' => 'absolute size-full object-cover object-center rounded-xl',
                    'loading' => 'lazy',
                    'alt' => ''
                ]); 
                ?>
            </div>
        </div>
        
        <div class="space-y-12 lg:space-y-24">
            <div class="xl:ml-6 flex flex-col gap-6 md:flex-row md:items-center md:gap-x-18 xl:gap-x-74">
                <h2 class="font-bold text-xl md:text-2xl tracking-wide">Oceny gości</h2>
                <div class="flex items-center gap-4 flex-wrap flex-1 max-w-2xl xl:gap-8">
                    <div class="flex items-center gap-x-4 flex-1">
                        <data value="8.8" class="text-2xl font-bold md:text-4xl">8.8</data>
                        <a href="/booking-opinie" class="w-full py-3 px-6 bg-gradient-green rounded-xl font-medium text-center md:py-4">Booking.com</a>
                    </div>
                    <div class="flex items-center gap-x-4 flex-1">
                        <data value="4.5" class="text-2xl font-bold md:text-4xl">4.5</data>
                        <a href="/google-opinie" class="w-full py-3 px-6 bg-gradient-green rounded-xl font-medium text-center md:py-4">Google</a>
                    </div>
                </div> 
            </div>
            
            <div class="space-y-6">
                <div class="relative xl:px-6">
                    <div class="overflow-hidden">
                        <div id="reviews-slider" role="region" aria-roledescription="carousel" aria-label="Opinie naszych gości" class="w-full flex gap-6 transition-transform duration-300 ease-out">
                            
                            <article itemscope itemtype="https://schema.org/Review" class="shrink-0 w-full sm:w-70 md:w-102 bg-[rgba(25,25,25,1)] p-6 rounded-xl space-y-6 text-white">
                                <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Apartment">
                                    <meta itemprop="name" content="Apartamenty Drzewna" />
                                    <meta itemprop="address" content="ul. Drzewna 20, Zielona Góra, Polska" />
                                </div>
                                <div class="flex items-center justify-between font-bold text-lg">
                                    <p itemprop="name" class="text-base">Czysto i Schludnie</p>
                                    <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                        <meta itemprop="ratingValue" content="5" />
                                        <data value="5.0">5.0</data>
                                    </div>
                                </div>
                                <blockquote itemprop="reviewBody" cite="https://drzewna.shareyou.com.pl/opinie" class="text-sm leading-6">
                                    Spędzaliśmy z córką przepiękny okres przed świętami w apartamencie z dwoma sypialnimi I dużym salonem z kuchnią. Lokal bardzo dobrze wyposażony, czyściutki, obsługa bardzo miła. Napewno tu wrócimy. Serdecznie polecam.
                                </blockquote>
                                <p itemprop="author" itemscope itemtype="https://schema.org/Person" class="font-medium bg-linear-to-r from-[rgba(2,184,100,1)] to-[rgba(9,158,86,1)] bg-clip-text text-transparent">
                                    <span itemprop="name">Beata M.</span>
                                </p>
                            </article>

                            <?php 
                                $reviews = [
                                    [
                                        'title' => 'Świetna lokalizacja',
                                        'rating' => '5.0',
                                        'content' => 'Bardzo czyste, komfortowo wyposażone i wykończone apartamenty. Położenie w samym centrum Zielonej Góry jest idealne. Szczerze polecam!',
                                        'author' => 'Marcin Barański'
                                    ],
                                    [
                                        'title' => 'Miła obsługa',
                                        'rating' => '5.0',
                                        'content' => 'Absolutny sztos. Wszystko czego trzeba, świetna lokalizacja, bezpłatny parking pod drzwiami, świetny apartament. Gospodarz mega uprzejmy i pomocny. Jeżeli jeszcze będziemy w Zielonej to na pewno skorzystamy z tej miejscówki. Polecamy.',
                                        'author' => 'Tomasz Kłos'
                                    ],
                                    [
                                        'title' => 'Dobrze urządzone',
                                        'rating' => '5.0',
                                        'content' => 'Apartament składał się z trzech pokoi z aneksem kuchennym oraz łazienką. W pełni wyposażony. Przyjemnie i funkcjonalnie urządzony, czysty a do tego położony w samym centrum Zielonej Góry. Dla przyjeżdżających na Winobranie idealny. ',
                                        'author' => 'Aleksandra Mi'
                                    ],
                                    [
                                        'title' => 'Dobra cena',
                                        'rating' => '5.0',
                                        'content' => 'Apartamenty na Kupieckiej 66a całkiem przyzwoite w relacji ceny do standardu. Przestrzenne, w pełni wyposażone z pakietem startowym dla gości. Czysto',
                                        'author' => 'Henryk Widzisz'
                                    ],
                                    [ 
                                        'title' => 'Super wyposażenie',
                                        'rating' => '5.0',
                                        'content' => 'Świetne miejsce. Lokalizacja w centrum. Czyste pomieszczenia. Samowystarczalne. Wszystko jest pralka lodówka zmywarka suszarka do włosów nawet żelazko bu musiałam skorzystać. Miły wystrój wnętrza. Dobry kontakt z wynajmującym. Na pewno jeszcze skorzystamy.',
                                        'author' => 'Tomasz Kłos'
                                    ],
                                    [
                                        'title' => 'Pyszna kawa',
                                        'rating' => '5.0',
                                        'content' => 'Dobra lokalizacja. Czysto, schludnie, lokal super wyposażony. Ekspres do kawy rewelacja! Pyszne espresso!',
                                        'author' => 'Karol Lorek'
                                    ]
                                ];
                            ?>
                            <?php foreach ($reviews as $review): ?>
                                <article itemscope itemtype="https://schema.org/Review" class="shrink-0 w-full sm:w-70 md:w-102 bg-[rgba(25,25,25,1)] p-6 rounded-xl space-y-6 text-white">
                                    <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Apartment">
                                        <meta itemprop="name" content="Apartamenty Drzewna" />
                                        <meta itemprop="address" content="ul. Drzewna 20, Zielona Góra, Polska" />
                                    </div>
                                    <div class="flex items-center justify-between font-bold text-lg">
                                        <p itemprop="name" class="text-base"><?php echo esc_html($review['title']); ?></p>
                                        <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                            <meta itemprop="ratingValue" content="<?php echo $review['rating']; ?>" />
                                            <data value="<?php echo $review['rating']; ?>"><?php echo esc_html($review['rating']); ?></data>
                                        </div>
                                    </div>
                                    <blockquote itemprop="reviewBody" cite="https://drzewna.shareyou.com.pl/opinie" class="text-sm leading-6">
                                        <?php echo esc_html($review['content']); ?>
                                    </blockquote>
                                    <p itemprop="author" itemscope itemtype="https://schema.org/Person" class="font-medium bg-linear-to-r from-[rgba(2,184,100,1)] to-[rgba(9,158,86,1)] bg-clip-text text-transparent">
                                        <span itemprop="name"><?php echo esc_html($review['author']); ?></span>
                                    </p>
                                </article>
                            <?php endforeach; ?>

                            <article itemscope itemtype="https://schema.org/Review" class="shrink-0 w-full sm:w-70 md:w-102 bg-[rgba(25,25,25,1)] p-6 rounded-xl space-y-6 text-white">
                                <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/Apartment">
                                    <meta itemprop="name" content="Apartamenty Drzewna" />
                                    <meta itemprop="address" content="ul. Drzewna 20, Zielona Góra, Polska" />
                                </div>
                                <div class="flex items-center justify-between font-bold text-lg">
                                    <p itemprop="name" class="text-base">Dużą grupą</p>
                                    <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                        <meta itemprop="ratingValue" content="5" />
                                        <data value="5.0">5.0</data>
                                    </div>
                                </div>
                                <blockquote itemprop="reviewBody" cite="https://drzewna.shareyou.com.pl/opinie" class="text-sm leading-6">
                                    Byliśmy dużą grupą, dlatego zajęliśmy dwa apartamenty. Oba super wyposażone, czysto, cieplutko. Apartamenty usytuowane w spokojnej okolicy, blisko centrum i zielonogórskich atrakcji. Cena bardzo przystępna. Wszystko zgodnie z opisem. Polecamy 😀
                                </blockquote>
                                <p itemprop="author" itemscope itemtype="https://schema.org/Person" class="font-medium bg-linear-to-r from-[rgba(2,184,100,1)] to-[rgba(9,158,86,1)] bg-clip-text text-transparent">
                                    <span itemprop="name">Małgosia</span>
                                </p>
                            </article>
                        </div>
                    </div>
                    
                    <button id="reviews-slider-prev" type="button" class="cursor-pointer absolute -left-4 top-1/2 -translate-y-1/2 w-8 h-8 xl:w-12 xl:h-12 xl:-left-8 flex items-center justify-center transition-all disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Poprzednia opinia">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="reviews-slider-next" type="button" class="cursor-pointer absolute -right-4 xl:-right-8 top-1/2 -translate-y-1/2 w-8 h-8 xl:w-12 xl:h-12 flex items-center justify-center transition-all disabled:opacity-50 disabled:cursor-not-allowed" aria-label="Następna opinia">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- STATYSTYKI -->
    <section id="statystyki" class="lg:py-6" aria-label="Statystyki i liczby naszej firmy">
        <dl class="flex flex-col gap-8 sm:flex-row sm:justify-around sm:gap-12 sm:flex-wrap">
            <?php 
                $statisctics = [
                    [
                        'value' => '12000+',
                        'title' => 'Gości Rocznie',
                    ],
                    [
                        'value' => '250+',
                        'title' => 'Opinii Gości',
                    ],
                    [
                        'value' => '32',
                        'title' => 'Apartamenty',
                    ],
                    [
                        'value' => '4',
                        'title' => 'Lokacje',
                    ],
                    [
                        'value' => '5',
                        'title' => 'Od centrum',
                    ],
                ]
            ?>
            <?php foreach ($statisctics as $statistic): ?>
                <div class="text-center space-y-1 lg:space-y-4">
                    <dd class="font-bold text-3xl sm:text-4xl lg:text-5xl"><data value="<?php echo $statistic['value']; ?>"><?php echo $statistic['value']; ?></data></dd>
                    <dt class="text-[#6E6E6E] font-medium text-sm text-balance"><?php echo $statistic['title']; ?></dt>
                </div>
            <?php endforeach; ?>
        </dl>
    </section>
    <!-- NOCLEGI NA KAŻDĄ OKAZJE -->
    <section id="noclegi" class="bg-[#EFEDE8] p-6 text-sm lg:p-10 rounded-xl">
        <div class="text-[#232323] text-center mb-6 space-y-2 xl:space-y-4 lg:mb-10">
            <h2 class="tracking-[4px] font-medium md:text-base">NOCLEGI</h2>
            <p class="font-bold text-2xl md:text-3xl lg:text-4xl xl:text-5xl">Na Każdą Okazję</p>
         </div>
        <?php
        $turnusy_slides = [
            [
                'title' => 'Weekendy we dwoje',
                'description' => 'Planujesz weekendowy wypad, chcesz odwiedzić słynną Palmiarnię lub skosztować lokalnego wina? Drzewna Apartments to idealna baza wypadkowa w samym sercu miasta. Przemyślany design, klimatyczne wnętrza i bliskość najważniejszych atrakcji pozwolą Ci w pełni poczuć klimat stolicy polskiego winiarstwa.',
                'image' => wp_get_attachment_image(91, 'large', false, [
                    'class' => 'size-full object-cover object-center transition-opacity duration-300 ease-in-out',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => 'Oferta noclegowa - Weekendy we dwoje',
                ]),
            ],
            [
                'title' => 'Podróże Służbowe',
                'description' => 'Cenisz spokój i niezależność podczas wyjazdów biznesowych? Nasze apartamenty oferują szybkie, bezpłatne Wi-Fi, ergonomiczną przestrzeń do pracy oraz pełną prywatność. Rano napijesz się u nas świeżej kawy z ekspresu, a wieczorem odpoczniesz w komfortowych warunkach po całym dniu spotkań.',
                'image' => wp_get_attachment_image(89, 'large', false, [
                    'class' => 'size-full object-cover object-center transition-opacity duration-300 ease-in-out',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => 'Oferta noclegowa - Podróże Służbowe',
                ]),
            ],
            [
                'title' => 'Rodzinne wyprawy',
                'description' => 'Podróżujesz z bliskimi i potrzebujesz przestrzeni? Każdy nasz apartament wyposażony jest w pełni funkcjonalną kuchnię lub aneks, co daje pełną swobodę w przygotowywaniu posiłków. Komfortowe sypialnie i bezpieczna przestrzeń sprawią, że cała rodzina poczuje się tutaj jak w domu.',
                'image' => wp_get_attachment_image(90, 'large', false, [
                    'class' => 'size-full object-cover object-center transition-opacity duration-300 ease-in-out',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => 'Oferta noclegowa - Rodzinne wyprawy',
                ]),
            ],
        ];
        ?>
        <!-- SLIDER -->
        <div class="relative">
            <div
                id="turnusy-container"
                role="region"
                aria-roledescription="carousel"
                aria-label="Turnusy na różne okazje"
                data-slides="<?php echo esc_attr(wp_json_encode($turnusy_slides)); ?>"
                class="relative rounded-xl sm:p-12 flex justify-end h-100 sm:h-120">
                <div id="turnusy-image" class="absolute inset-0 size-full object-cover object-center rounded-xl overflow-hidden">
                    <?php echo $turnusy_slides[0]['image']; ?>
                </div>
                <div id="turnusy-card" class="space-y-6 rounded-xl bg-white p-6 max-w-200 md:max-w-md z-1 xl:p-8" aria-live="polite">
                    <span role="presentation" class="block w-20 h-0.5 bg-[#05AB5D] mb-4"></span>
                    <h3 id="turnusy-title" class="font-bold text-lg">Weekendy we dwoje</h3>
                    <p id="turnusy-description" class="text-sm leading-6 text-[#232323] line-clamp-8">
                        Planujesz weekendowy wypad, chcesz odwiedzić słynną Palmiarnię lub skosztować lokalnego wina? Drzewna Apartments to idealna baza wypadkowa w samym sercu miasta. Przemyślany design, klimatyczne wnętrza i bliskość najważniejszych atrakcji pozwolą Ci w pełni poczuć klimat stolicy polskiego winiarstwa.
                    </p>
                    <a href="/" class="inline-block text-white py-3 px-6 bg-gradient-green rounded-xl font-medium text-center md:py-4">Skontaktuj Się</a>
                </div>
            </div>
            <button 
                id="turnusy-prev" 
                type="button"
                class="cursor-pointer absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-14 sm:h-14 lg:w-18 lg:h-18 lg:-left-8 bg-black rounded-full z-2 grid place-items-center"
                aria-label="Poprzedni turnus - przycisk nawigacji">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button 
                id="turnusy-next"
                type="button"
                class="cursor-pointer absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-14 sm:h-14 lg:w-18 lg:h-18 lg:-right-8 bg-black rounded-full z-2 grid place-items-center"
                aria-label="Następny turnus - przycisk nawigacji">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </section>
    <?php 
        $faq_items = [
            ['question' => 'Jak zarezerwować i zapłacić?', 'answer' => 'Rezerwacji dokonasz online lub telefonicznie. Akceptujemy kartę, przelew, BLIK oraz gotówkę. W zależności od terminu wymagamy przedpłaty lub natychmiastowej płatności online.'],
            ['question' => 'Co z fakturą i kaucją?', 'answer' => 'Fakturę VAT wystawiamy do 48h po pobycie (podaj dane przy rezerwacji). W wybranych apartamentach lub przy długich pobytach pobieramy zwrotną kaucję, którą rozliczamy w ciągu 1–3 dni roboczych.'],
            ['question' => 'O jakich godzinach jest zameldowanie i wymeldowanie?', 'answer' => 'Zameldowanie od 16:00, wymeldowanie do 11:00. Wcześniejszy przyjazd lub późniejszy wyjazd jest możliwy za dopłatą 70 zł (zależnie od dostępności).'],
            ['question' => 'W jaki sposób odebrać klucze?', 'answer' => 'Stawiamy na samodzielność! Kod do domofonu oraz instrukcję do skrytki na klucze otrzymasz mailem w dniu przyjazdu po godzinie 12:00. Nie musisz nas wcześniej powiadamiać o godzinie przybycia.'],
            ['question' => 'Co znajdę w środku?', 'answer' => 'Każdy apartament ma Wi-Fi, pościel, ręczniki oraz kuchnię/aneks. Zapewniamy zestaw startowy: kawę w kapsułkach (Tchibo), herbatę, podstawowe przyprawy oraz kosmetyki i środki czystości.'],
            ['question' => 'Czy apartament posiada pralkę i klimatyzację?', 'answer' => 'Wyposażenie zależy od konkretnego lokalu – szczegóły znajdziesz zawsze w opisie wybranej oferty.'],
            ['question' => 'Lokalizacja i Parking', 'answer' => 'Dokładne odległości i lokalizację znajdziesz w opisie oferty. Oferujemy parkingi prywatne lub wskazujemy publiczne – nie gwarantujemy i nie rezerwujemy miejsc postojowych'],
            ['question' => 'Zasady domowe', 'answer' => 'Zakazy: Obowiązuje całkowity zakaz palenia (również w oknie – grozi karą finansową) oraz zakaz organizacji imprez.
            • Cisza nocna: Prosimy o spokój w godzinach 22:00 – 07:00.
            • Zwierzęta: Są mile widziane tylko w wybranych apartamentach po uzgodnieniu (opłata 30 zł/doba).
            • Liczba osób: W apartamencie może przebywać tylko tylu gości, ilu wskazano w rezerwacji.'
            ],
            ['question' => 'Jak zostawić apartament?', 'answer' => ' Nie musisz sprzątać, ale prosimy o: wyniesienie śmieci (segregacja!), włączenie zmywarki oraz pozostawienie kluczy zgodnie z instrukcją.'],
            ['question' => 'Plamy na pościeli?', 'answer' => 'eśli coś się pobrudzi, nie pierz tego samodzielnie. Nasza profesjonalna pralnia lepiej poradzi sobie z odplamianiem.']
        ];
    ?>
    <script type="application/ld+json">
        <?php
            $faq_schema = [
                "@context" => "https://schema.org",
                "@type" => "FAQPage",
                "@id" => home_url('/#faq'),
                "inLanguage" => "pl-PL",
                "mainEntity" => []
            ];
            foreach ($faq_items as $item) {
                $faq_schema["mainEntity"][] = [
                    "@type" => "Question",
                    "@id" => home_url('/#faq-' . sanitize_title($item['question'])),
                    "name" => $item['question'],
                    "acceptedAnswer" => [
                        "@type" => "Answer",
                        "text" => $item['answer']
                    ]
                ];
            }
            echo json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        ?>
    </script>
    
    <section id="faq" aria-label="Najczęściej zadawane pytania" class="text-sm grid grid-cols-1 px-6 gap-6 sm:grid-cols-2 md:px-0 lg:grid-cols-3 xl:text-base xl:gap-8 items-start">
        
        <div class="space-y-2">
            <p class="text-[#232323] tracking-widest font-medium">NAJCZĘŚCIEJ ZADAWANE</p>
            <h2 class="font-bold text-2xl xl:text-3xl">Pytania Gości</h2>
            <div class="relative bg-black aspect-video rounded-xl my-4 xl:my-6">
                <?php echo drzewna_attachment_image('zdjecie_faq', 'medium', [
                    'class' => 'absolute size-full object-cover object-center rounded-xl',
                    'loading' => 'lazy',
                    'decoding' => 'async',
                    'alt' => 'FAQ - Najczęściej zadawane pytania'
                ]); ?>
            </div>
            <p class="font-medium"><span class="font-bold">Masz problem podczas pobytu?</span> Dzwoń do nas śmiało – pomożemy tak szybko, jak to możliwe!</p>
        </div>
        
        <div id="faq-container" class="space-y-2 xl:space-y-3">
            <?php foreach ($faq_items as $i => $item):?>
                <div class="faq-item">
                    <button aria-expanded="false" class="faq-question w-full p-4 rounded-xl cursor-pointer bg-[#FAFAFA] hover:bg-[#F0F0F0] transition-colors text-left" aria-controls="answer-<?php echo $i; ?>">
                        <span class="font-medium"><?php echo esc_html($item['question']); ?></span>
                    </button>
                    <div id="answer-<?php echo $i; ?>" class="faq-answer overflow-hidden max-h-0 transition-all duration-300">
                        <div class="p-4">
                            <p><?php echo nl2br(esc_html($item['answer'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="space-y-6 bg-[#FAFAFA] rounded-xl p-4 sm:col-span-2 lg:col-span-1 xl:space-y-8">
            <img src="<?php echo get_theme_file_uri("/assets/images/loga/logo-drzewna-z-napisem.webp"); ?>" alt="" class="w-30 md:w-40 object-contain" loading="lazy" decoding="async" />
            <p>Masz inne pytanie lub coś jest dla Ciebie niejasne?</p>
            
            <div class="flex items-center gap-x-4">
                <div class="bg-[#FFF] rounded-full p-4 shrink-0">
                    <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/telefon.webp'); ?>" alt="" loading="lazy" decoding="async" class="w-6 h-6 object-contain"/>
                </div>
                <p>+48 123 456 789</p>
            </div>
            
            <div class="flex items-center gap-x-4">
                <div class="bg-[#FFF] rounded-full p-4 shrink-0">
                    <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/poczta.webp'); ?>" alt="" loading="lazy" decoding="async" class="w-6 h-6 object-contain"/>
                </div>
                <p>kontakt@drzewna.pl</p>
            </div>
            
            <a href="#kontakt" class="bg-black text-white px-4 py-3 text-center rounded-3xl block md:py-4">Lub prześlij formularz</a>
         </div>
    </section>
    <!-- GALERIA -->
    <section id="gallery" aria-label="Galeria zdjęć Zielonej Góry" class="flex flex-col gap-6 px-6 sm:flex-row h-auto sm:h-100 md:px-0 lg:gap-8 max-w-7xl mx-auto">
        <div class="relative rounded-xl aspect-video sm:aspect-auto sm:flex-2 overflow-hidden bg-neutral-900">
            <?php echo drzewna_attachment_image('gallery_image1', 'large', [ 
                'class' => 'absolute inset-0 size-full object-cover object-center rounded-xl',
                'loading' => 'lazy',
                'decoding' => 'async',
                'alt' => 'Galeria - Wnętrze apartamentu w hotelu Drzewna'
            ]); 
            ?>
        </div>
        
        <div class="relative rounded-xl aspect-video sm:aspect-auto sm:flex-1 overflow-hidden bg-neutral-900">
            <?php echo drzewna_attachment_image('gallery_image2', 'medium', [
                'class' => 'absolute inset-0 size-full object-cover object-center rounded-xl',
                'loading' => 'lazy',
                'decoding' => 'async',
                'alt' => 'Galeria - Salon apartamentu w hotelu Drzewna'
            ]); 
            ?>
        </div>
    </section>
    <!-- KONTAKT -->
    <?php get_template_part('template-parts/contact/section', null, [
        'title' => 'Zapisz się na -10% zniżki'
    ])?>
    <?php 
    }, "text-sm !px-0 space-y-6 md:!px-6 md:space-y-12"); 
    ?>
</main>

<?php get_footer(); ?>

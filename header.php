<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Komfortowe Apartamenty Drzewna w centrum Zielonej Góry. Doskonała lokalizacja przy starówce, wysoki standard i najlepsza ocena gości. Zarezerwuj online!">
    <meta property="og:title" content="Apartamenty Drzewna - Zielona Góra | Komfort w Centrum">
    <meta property="og:description" content="Odkryj najlepsze apartamenty w Zielonej Górze. Wysoki standard, serce miasta. Sprawdź naszą ofertę!">
    <meta name="keywords" content="hotel zielona góra, nocleg zielona góra, drzewna, zielona góra noclegi, zielona gora hotel, hotel zielona góra, zielona góra hotel, apartamenty zielona góra, tanie noclegi zielona góra, hotele w zielonej górze, drzewnaapartaments, hotel zielona góra tanio" />
    <meta property="og:type" content="website">
    <?php wp_head(); ?>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "Organization",
                    "@id": "https://drzewna.shareyou.com.pl/#organization",
                    "name": "Apartamenty Drzewna",
                    "url": "https://drzewna.shareyou.com.pl/",
                    "logo": "https://drzewna.shareyou.com.pl/logo.png",
                    "telephone": "+48 790 635 582",
                    "email": "kontakt@drzewnapartamenty.pl",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "ul. Drzewna 20",
                        "addressLocality": "Zielona Góra",
                        "postalCode": "65-060",
                        "addressRegion": "Lubuskie",
                        "addressCountry": "PL"
                    }
                },
                {
                    "@type": "LodgingBusiness",
                    "@id": "https://drzewna.shareyou.com.pl/#drzewna",
                    "name": "Apartament Drzewna",
                    "image": "http://drzewna.local/wp-content/uploads/2026/03/apartament-wielka-brytania.webp",
                    "priceRange": "350-550 PLN",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "ul. Drzewna 20",
                        "addressLocality": "Zielona Góra",
                        "postalCode": "65-060",
                        "addressRegion": "Lubuskie",
                        "addressCountry": "PL"
                    },
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": 51.9356,
                        "longitude": 15.5062
                    },
                    "amenityFeature": [
                        { "@type": "LocationFeatureSpecification", "name": "Parking", "value": true },
                        { "@type": "LocationFeatureSpecification", "name": "WiFi", "value": true }
                    ],
                    "parentOrganization": {
                        "@id": "https://drzewna.shareyou.com.pl/#organization"
                    },
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "8.8",
                        "bestRating": "10",
                        "reviewCount": "150"
                    }
                },
                {
                    "@type": "LodgingBusiness",
                    "@id": "https://drzewna.shareyou.com.pl/#kupiecka",
                    "name": "Apartament Kupiecka",
                    "image": "http://drzewna.local/wp-content/uploads/2026/03/apartament-kupiecka-studio.webp",
                    "priceRange": "300-500 PLN",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "ul. Kupiecka 5/2",
                        "addressLocality": "Zielona Góra",
                        "postalCode": "65-426",
                        "addressRegion": "Lubuskie",
                        "addressCountry": "PL"
                    },
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": 51.9360,
                        "longitude": 15.5075
                    },
                    "amenityFeature": [
                        { "@type": "LocationFeatureSpecification", "name": "Parking", "value": true },
                        { "@type": "LocationFeatureSpecification", "name": "WiFi", "value": true }
                    ],
                    "parentOrganization": {
                        "@id": "https://drzewna.shareyou.com.pl/#organization"
                    },
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "8.8",
                        "bestRating": "10",
                        "reviewCount": "120"
                    }
                },
                {
                    "@type": "LodgingBusiness",
                    "@id": "https://drzewna.shareyou.com.pl/#nowy-apartament",
                    "name": "Apartament Nowy",
                    "image": "https://drzewna.shareyou.com.pl/wp-content/uploads/2026/03/apartament-nowy.webp",
                    "priceRange": "320-520 PLN",
                    "address": {
                        "@type": "PostalAddress",
                        "streetAddress": "ul. NOWA 10",
                        "addressLocality": "Zielona Góra",
                        "postalCode": "65-001",
                        "addressRegion": "Lubuskie",
                        "addressCountry": "PL"
                    },
                    "geo": {
                        "@type": "GeoCoordinates",
                        "latitude": 51.9350,
                        "longitude": 15.5050
                    },
                    "amenityFeature": [
                        { "@type": "LocationFeatureSpecification", "name": "Parking", "value": true },
                        { "@type": "LocationFeatureSpecification", "name": "WiFi", "value": true }
                    ],
                    "parentOrganization": {
                        "@id": "https://drzewna.shareyou.com.pl/#organization"
                    },
                    "aggregateRating": {
                        "@type": "AggregateRating",
                        "ratingValue": "8.8",
                        "bestRating": "10",
                        "reviewCount": "90"
                    }
                }
            ]
        }
</script>
</head>
<body <?php body_class(); ?>>

<?php
$current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

function nav_item($href, $label, $current_path) {
    $href_path = trim(parse_url($href, PHP_URL_PATH), '/');
    $is_active = false;
    if ($href === '/') {
        $is_active = ($current_path === '') || is_front_page();
    } else {
        $is_active = ($href_path === $current_path);
    }
    $classes = '';
    if ($is_active) {
        $classes = 'pb-2 font-semibold border-b-3 border-green-600';
    }
    return '<li><a class="' . $classes . '" href="' . esc_attr($href) . '">' . esc_html($label) . '</a></li>';
}
?>

<!-- NAVBAR -->
<nav id="navbar" class="fixed w-full top-0 z-40 border-b border-white/10 duration-200 backdrop-blur-[3px] py-2 <?php echo is_front_page() ? "text-white" : "text-black"; ?>" aria-label="Menu główne">
    <?php Container(function() use ($current_path) { ?>
        <!-- LOGO -->
        <?php $logo_white = get_theme_file_uri('/assets/images/loga/logo-drzewna-white.png') ;?>
        <?php $logo_black = get_theme_file_uri('/assets/images/loga/logo-drzewna-black.png'); ?>

        <a href="/" class="block">
            <img id="nav-logo" src="<?php echo is_front_page() ? $logo_white : $logo_black; ?>" data-logo-white="<?php echo $logo_white; ?>" data-logo-black="<?php echo $logo_black; ?>" class="w-20"
                alt="Logo Apartamenty Drzewna Zielona Góra"
                width="80"
                height="80"
                decoding="async"
            />
        </a>

        <!-- DESKTOP MENU -->
        <ul id="nav-links" class="hidden text-sm gap-x-6 duration-200 md:flex md:items-center lg:text-base lg:gap-x-8" aria-label="Główna nawigacja">
            <?php 
                $links = [
                    '/' => 'Home',  
                    '/apartamenty' => 'Apartamenty',
                    '/okolica' => 'Okolica',
                    '/parking' => 'Parking',
                    '/kontakt' => 'Kontakt',
                ];
                foreach ($links as $href => $label) {
                    echo nav_item($href, $label, $current_path);
                }
            ?>
        </ul>

        <div class="flex items-center gap-x-4">
            <!-- BTN REZERWUJ -->
            <a href="/rezerwacja" class="open-booking-engine text-white text-xs shadow-md shadow-black/40 block px-4 py-3 lg:px-6 bg-gradient-green rounded-2xl lg:text-sm" aria-label="Zarezerwuj apartament - otwórz formularz rezerwacji">
                Rezerwuj Online
            </a>

            <!-- HAMBURGER -->
            <?php $line_color = is_front_page() ? 'bg-white' : 'bg-black'; ?>
            <button id="hamburger-btn" class="size-10 space-y-1.5 cursor-pointer md:hidden" aria-label="Otwórz menu mobilne" aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Otwórz menu</span>
                <span id="hamburger-line-1" class="block w-6 h-0.5 <?php echo $line_color; ?>"></span>
                <span id="hamburger-line-2" class="block w-6 h-0.5 <?php echo $line_color; ?>"></span>
                <span id="hamburger-line-3" class="block w-6 h-0.5 <?php echo $line_color; ?>"></span>
            </button>
        </div>
    <?php }, "flex items-center gap-x-6 justify-between"); ?>
</nav>

<!-- MOBILNE MENU -->
<div id="mobile-menu" class="fixed top-0 left-0 size-full z-50 bg-white grid place-items-center opacity-0 pointer-events-none" role="navigation" aria-label="Menu mobilne">
    <ul class="text-lg space-y-6 text-center font-medium">
        <?php 
        $links = [
            '/' => 'Home',
            '/apartamenty' => 'Apartamenty',
            '/okolica' => 'Okolica',
            '/parking' => 'Parking',
            '/kontakt' => 'Kontakt',
        ];
        foreach ($links as $href => $label) {
            echo nav_item($href, $label, $current_path);
        }
        ?>
    </ul>
</div>

<?php if (is_front_page()) : ?>
<header id="header" class="relative h-screen bg-slate-700 flex text-white">
    <div class="absolute inset-0 z-1 backdrop-blur-lg mask-[linear-gradient(to_right,black_10%,transparent_80%)]"></div>
    <div class="absolute inset-0 z-1 bg-linear-to-r from-black/75 to-transparent"></div>
    <?php echo wp_get_attachment_image(77, 'full', false, [
    'class' => 'absolute size-full object-cover object-center',
    'loading' => 'eager',
    'fetchpriority' => 'high',
    'sizes' => '100vw'
]); 
    ?>
    <div class="flex-1 z-1 flex items-center">
        <?php Container(function() { ?>
            <div class="space-y-3 md:space-y-6">
                <div class="w-fit flex items-center gap-x-2 backdrop-blur-md border border-white/20 bg-white/3 py-2 px-3 rounded-xl shadow-lg md:gap-x-4" role="complementary" aria-label="Ocena naszych gości na platformach rezerwacyjnych">
                    <img src="<?php echo get_theme_file_uri('/assets/images/ikonki/gwiazdka-biala.webp'); ?>" alt="" class="w-5 md:w-7" loading="lazy" />
                    <div class="md:text-sm">
                        <p class="font-medium text-xs" aria-label="Ocena: 8.8 na 10">8.8 Ocena</p>
                        <p class="text-xs opacity-60">gości na booking.com</p>
                    </div>
                </div>

                <section aria-label="Hero section - intro do apartamentów Drzewna">
                    <h1 class="text-lg font-medium mb-2 leading-10 md:mb-4 md:leading-14 md:text-3xl ">DRZEWNA APARTAMENTY <br /> <span class="text-5xl font-bold md:text-6xl">ZIELONA GÓRA</span></h1>
                    <p class="text-sm leading-6 max-w-lg md:text-base">Odkryj komfortowe apartamenty w centrum Zielonej Góry. Ciesz się klimatem miasta, restauracjami i atrakcjami w zasięgu krótkiego spaceru.</p>
                </section>
                <div id="gs-booking-bar" class="gs-booking-widget mt-6 w-full max-w-180"></div>
            </div>
        <?php }); ?>
    </div>
</header>
<?php endif; ?>
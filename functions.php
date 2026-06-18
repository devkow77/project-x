<?php

define('GOOGLE_MAPS_API_KEY', 'AIzaSyB6rsGuI0l7xAgJSxDZDthR4qk8R5XQ_Io');

function drzewna_setup() {
    load_theme_textdomain('drzewna', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
}
add_action('after_setup_theme', 'drzewna_setup');

function drzewna_document_title($title) {
    if (is_front_page()) {
        return 'Noclegi Zielona Góra Centrum | Apartamenty Drzewna';
    }

    return $title;
}
add_filter('pre_get_document_title', 'drzewna_document_title');

define('DRZEWNA_ATTACHMENT_IDS', [
    'miasto-zielona-gora' => 69,
    'apartament-nieznany' => 67,
    'drzewo' => 66,
    'gallery_image1' => 65,
    'gallery_image2' => 64,
    'zdjecie_faq' => 63,
]);

function drzewna_needs_map() {
    return is_front_page()
        || is_page('kontakt')
        || is_page('parking')
        || basename(get_page_template()) === 'page-kontakt.php';
}

function drzewna_print_inline_styles() {
    $fonts_uri = get_theme_file_uri('/assets/fonts/');
    $fonts_path = get_template_directory() . '/assets/css/fonts.css';
    $critical_path = get_template_directory() . '/assets/css/critical.css';

    if (file_exists($fonts_path)) {
        $fonts_css = str_replace('__FONTS_URI__', $fonts_uri, file_get_contents($fonts_path));
        echo '<style id="drzewna-fonts">' . $fonts_css . '</style>' . "\n";
    }

    if (file_exists($critical_path)) {
        echo '<style id="drzewna-critical">' . file_get_contents($critical_path) . '</style>' . "\n";
    }
}
add_action('wp_head', 'drzewna_print_inline_styles', 1);

function drzewna_preload_fonts() {
    $fonts_uri = get_theme_file_uri('/assets/fonts/');
    $preload = [
        'montserrat-latin-ext-400-normal.woff2',
        'montserrat-latin-ext-700-normal.woff2',
    ];

    foreach ($preload as $file) {
        printf(
            '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
            esc_url($fonts_uri . '/' . $file)
        );
    }
}
add_action('wp_head', 'drzewna_preload_fonts', 0);

function drzewna_async_stylesheet($html, $handle, $href, $media) {
    if ($handle !== 'drzewna-style') {
        return $html;
    }

    return sprintf(
        '<link rel="preload" href="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n"
        . '<noscript><link rel="stylesheet" href="%s"></noscript>' . "\n",
        esc_url($href),
        esc_url($href)
    );
}
add_filter('style_loader_tag', 'drzewna_async_stylesheet', 10, 4);

function drzewna_enqueue_assets() {
    $theme_version = wp_get_theme()->get('Version');
    $style_path = get_stylesheet_directory() . '/style.css';
    $js_uri = get_template_directory_uri() . '/assets/js/';

    wp_enqueue_style(
        'drzewna-style',
        get_stylesheet_directory_uri() . '/style.css',
        [],
        file_exists($style_path) ? filemtime($style_path) : $theme_version
    );

    wp_enqueue_script('drzewna-theme', $js_uri . 'theme.js', [], $theme_version, true);
    wp_script_add_data('drzewna-theme', 'async', true);

    if (is_front_page()) {
        wp_enqueue_script('drzewna-front-page', $js_uri . 'front-page.js', [], $theme_version, true);
        wp_script_add_data('drzewna-front-page', 'async', true);
    }

    if (drzewna_needs_map()) {
        wp_enqueue_script('drzewna-map', $js_uri . 'map.js', [], $theme_version, true);
        wp_script_add_data('drzewna-map', 'async', true);
        wp_localize_script('drzewna-map', 'drzewnaMap', [
            'apiKey' => $_ENV['GOOGLE_MAPS_API_KEY'] ?? '',
        ]);
    }
}
add_action('wp_enqueue_scripts', 'drzewna_enqueue_assets');

$components_dir = get_template_directory() . '/components';

if (is_dir($components_dir)) {
    foreach (glob($components_dir . '/*.php') as $component) {
        require_once $component;
    }
}

function drzewna_attachment_image($key, $size = 'medium', $attr = []) {
    if (!isset(DRZEWNA_ATTACHMENT_IDS[$key])) {
        return '';
    }

    return wp_get_attachment_image(DRZEWNA_ATTACHMENT_IDS[$key], $size, false, $attr);
}

add_action('admin_post_nopriv_wyslij_kontakt', 'handle_contact_form');
add_action('admin_post_wyslij_kontakt', 'handle_contact_form');

function handle_contact_form() {
    if (!isset($_POST['kontakt_form_nonce']) ||
        !wp_verify_nonce($_POST['kontakt_form_nonce'], 'kontakt_form_action')
    ) {
        wp_die(__('Unauthorized action.', 'drzewna'));
    }

    $user_ip = sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'] ?? ''));
    $rate_limit_key = 'drzewna_contact_' . md5($user_ip);

    if (get_transient($rate_limit_key)) {
        wp_die(__('Please wait before sending another message.', 'drzewna'));
    }

    if (!empty($_POST['website'] ?? '')) {
        wp_die(__('Spam detected.', 'drzewna'));
    }

    $message_text = sanitize_textarea_field(wp_unslash($_POST['user_message'] ?? ''));
    if (strlen($message_text) > 2000) {
        wp_die(__('Message is too long.', 'drzewna'));
    }

    $spam_patterns = [
        '/viagra|cialis|casino|lottery/i',
        '/https?:\/\/.*\.(ru|ua|cn|pk)\b/i',
    ];

    foreach ($spam_patterns as $pattern) {
        if (preg_match($pattern, $message_text)) {
            wp_die(__('Message contains prohibited content.', 'drzewna'));
        }
    }

    $name = sanitize_text_field(wp_unslash($_POST['user_name'] ?? ''));
    $email = sanitize_email(wp_unslash($_POST['user_email'] ?? ''));
    $phone = sanitize_text_field(wp_unslash($_POST['user_phone'] ?? ''));
    $message = $message_text;

    $errors = [];

    if (empty(trim($name)) || strlen($name) < 2 || strlen($name) > 100) {
        $errors[] = 'invalid_name';
    }

    if (empty(trim($phone)) || strlen($phone) < 7 || !preg_match('/^\+?[0-9\s\-\(\)]{7,20}$/', $phone)) {
        $errors[] = 'invalid_phone';
    }

    if (empty(trim($message)) || strlen($message) < 10) {
        $errors[] = 'invalid_message';
    }

    if (!is_email($email) || preg_match('/[\r\n]/', $email)) {
        $errors[] = 'invalid_email';
    }

    if (!empty($errors)) {
        wp_safe_redirect(add_query_arg('sent', $errors[0], wp_get_referer() ?: home_url()));
        exit;
    }

    $to = get_option('admin_email');
    $subject = 'Nowa wiadomość z drzewnapartamenty.pl';
    $html_message = wpautop(esc_html($message));

    $body = "
    <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; border: 1px solid #eee; padding: 20px;'>
        <h2 style='color:#2c3e50;border-bottom:2px solid #f0f0f0;padding-bottom:10px;'>
            Drzewna - Hotel w Zielonej Górze
        </h2>
        <p><strong>Imię:</strong> " . esc_html($name) . "</p>
        <p><strong>Email:</strong> " . esc_html($email) . "</p>
        <p><strong>Telefon:</strong> " . esc_html($phone) . "</p>
        <div style='background:#f9f9f9;padding:15px;border-left:4px solid #d4af37;margin-top:20px;'>
            <strong>Wiadomość:</strong><br>" . $html_message . "
        </div>
    </div>";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $to . '>',
        'Reply-To: ' . sanitize_email($email),
    ];

    $success = wp_mail($to, $subject, $body, $headers);

    if ($success) {
        set_transient($rate_limit_key, true, 60);
    }

    wp_safe_redirect(add_query_arg('sent', $success ? '1' : '0', wp_get_referer() ?: home_url()) . '#kontakt');
    exit;
}

function drzewna_add_loading_lazy($attr, $attachment, $size) {
    if (!isset($attr['loading']) || $attr['loading'] !== 'eager') {
        $attr['loading'] = 'lazy';
    }

    if (!isset($attr['decoding'])) {
        $attr['decoding'] = 'async';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'drzewna_add_loading_lazy', 10, 3);

function drzewna_sanitize_uploaded_filename($filename) {
    $sanitized = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename);
    $parts = explode('.', $sanitized);

    if (count($parts) > 2) {
        $ext = array_pop($parts);
        $sanitized = implode('', $parts) . '.' . $ext;
    }

    return $sanitized;
}
add_filter('sanitize_file_name', 'drzewna_sanitize_uploaded_filename');

function drzewna_restrict_upload_mimes($mimes) {
    return [
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'webp' => 'image/webp',
        'pdf' => 'application/pdf',
    ];
}
add_filter('upload_mimes', 'drzewna_restrict_upload_mimes');

function drzewna_cleanup_wp_head() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
}
add_action('init', 'drzewna_cleanup_wp_head');

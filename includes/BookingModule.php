<?php

declare(strict_types=1);

namespace Drzewna;

use function add_action;
use function apply_filters;
use function filemtime;
use function get_template_directory;
use function get_template_directory_uri;
use function is_front_page;
use function is_page;
use function is_readable;
use function wp_add_inline_script;
use function wp_enqueue_script;
use function wp_enqueue_style;
use function wp_json_encode;

defined('ABSPATH') || exit;


final class BookingModule
{
    private const HANDLE_POPUP_STYLE = 'drzewna-booking-popup';
    private const HANDLE_POPUP_SCRIPT = 'drzewna-booking-popup';

    private const HANDLE_WIDGET_VENDOR_STYLE = 'kwhotel-booking-bar-widget';
    private const HANDLE_WIDGET_VENDOR_SCRIPT = 'kwhotel-booking-bar-widget';
    private const HANDLE_WIDGET_THEME_STYLE = 'drzewna-booking-bar-hero';

    private const URL_WIDGET_CSS = 'https://implementacja.kwhotel.com/dist/booking-bar-widget.css';
    private const URL_WIDGET_JS = 'https://implementacja.kwhotel.com/dist/booking-bar-widget.iife.js';

    private const REL_POPUP_CSS = '/assets/css/booking-popup.css';
    private const REL_POPUP_JS = '/assets/js/booking-popup.js';
    private const REL_HERO_CSS = '/assets/css/booking-bar-hero.css';
    private const REL_APARTAMENTY_IFRAME_JS = '/assets/js/apartamenty-booking-iframe.js';

    private const URL_IFRAME_RESIZER = 'https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/4.3.2/iframeResizer.min.js';

    private const GUESTSAGE_BOOKING_IFRAME_UUID = 'ebc0d25d-07bc-487c-87d5-ae18b86fd11a';

    public static function register(): void
    {
        add_action('wp_enqueue_scripts', [self::class, 'enqueuePopupAssets'], 15);
        add_action('wp_enqueue_scripts', [self::class, 'enqueueHeroWidgetAssets'], 15);
        add_action('wp_enqueue_scripts', [self::class, 'enqueueApartamentyIframeAssets'], 15);
    }

    public static function enqueuePopupAssets(): void
    {
        $uri = get_template_directory_uri();
        $dir = get_template_directory();

        wp_enqueue_style(
            self::HANDLE_POPUP_STYLE,
            $uri . self::REL_POPUP_CSS,
            [],
            self::fileVersion($dir . self::REL_POPUP_CSS)
        );

        wp_enqueue_script(
            self::HANDLE_POPUP_SCRIPT,
            $uri . self::REL_POPUP_JS,
            [],
            self::fileVersion($dir . self::REL_POPUP_JS),
            true
        );
    }

    public static function enqueueHeroWidgetAssets(): void
    {
        if (!is_front_page()) {
            return;
        }

        wp_enqueue_style(
            self::HANDLE_WIDGET_VENDOR_STYLE,
            self::URL_WIDGET_CSS,
            [],
            null
        );

        $dir = get_template_directory();
        $uri = get_template_directory_uri();

        wp_enqueue_style(
            self::HANDLE_WIDGET_THEME_STYLE,
            $uri . self::REL_HERO_CSS,
            [self::HANDLE_WIDGET_VENDOR_STYLE],
            self::fileVersion($dir . self::REL_HERO_CSS)
        );

        wp_enqueue_script(
            self::HANDLE_WIDGET_VENDOR_SCRIPT,
            self::URL_WIDGET_JS,
            [],
            null,
            true
        );

        $config = apply_filters(
            'drzewna_booking_bar_config',
            [
                'container' => '#gs-booking-bar',
                'hotelGuid' => 'ebc0d25d-07bc-487c-87d5-ae18b86fd11a',
                'rounded' => true,
                'sidebar' => false,
                'roomCategories' => false,
                'discountCode' => false,
                'theme' => 1,
                'view' => 'apartments',
            ]
        );

        $json = wp_json_encode($config, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);

        $inline = <<<JS
(function (cfg) {
  function boot() {
    if (window.BookingBarWidget && typeof window.BookingBarWidget.init === 'function') {
      window.BookingBarWidget.init(cfg);
    } else {
      console.error('BookingBarWidget not available');
    }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})({$json});
JS;

        wp_add_inline_script(self::HANDLE_WIDGET_VENDOR_SCRIPT, $inline, 'after');
    }

    public static function enqueueApartamentyIframeAssets(): void
    {
        if (!is_page('apartamenty')) {
            return;
        }

        wp_enqueue_script(
            'iframe-resizer',
            self::URL_IFRAME_RESIZER,
            [],
            '4.3.2',
            true
        );

        $dir = get_template_directory();
        $uri = get_template_directory_uri();

        wp_enqueue_script(
            'drzewna-apartamenty-booking-iframe',
            $uri . self::REL_APARTAMENTY_IFRAME_JS,
            ['iframe-resizer'],
            self::fileVersion($dir . self::REL_APARTAMENTY_IFRAME_JS),
            true
        );
    }

    public static function guestsageBookingIframeUrl(): string
    {
        $default = 'https://be.guestsage.com/pl/' . self::GUESTSAGE_BOOKING_IFRAME_UUID . '/apartments';

        return (string) apply_filters('drzewna_guestsage_booking_iframe_url', $default);
    }

    private static function fileVersion(string $absolutePath): string
    {
        if (!is_readable($absolutePath)) {
            return '1.0';
        }
        $mtime = filemtime($absolutePath);

        return $mtime !== false ? (string) $mtime : '1.0';
    }
}

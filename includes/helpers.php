<?php

declare(strict_types=1);

defined('ABSPATH') || exit;

function drzewna_get_field(string $selector, $post_id = false, bool $format_value = true)
{
    if (!function_exists('get_field')) {
        return null;
    }

    return get_field($selector, $post_id, $format_value);
}


function drzewna_acf_apartment_group_key(): string
{
    return (string) apply_filters('drzewna_acf_apartment_group_key', 'apartamenty');
}


function drzewna_apartment_field(string $name, $post_id = false, bool $format_value = true)
{
    $group_key = drzewna_acf_apartment_group_key();
    $group = drzewna_get_field($group_key, $post_id, $format_value);

    if (is_array($group) && array_key_exists($name, $group)) {
        return $group[$name];
    }

    return drzewna_get_field($name, $post_id, $format_value);
}

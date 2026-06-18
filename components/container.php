<?php
/**
 * Komponent Kontenera
 * Centralizuje maksymalną szerokość i padding strony
 * 
 * @param callable $children - Funkcja anonimowa zwracająca HTML
 * @param string $className - Dodatkowe klasy Tailwind
 * @param array $attrs - Dodatkowe atrybuty HTML (role, id, etc)
 */

if (!function_exists('Container')) {
    function Container($children, $className = '', $attrs = []) {
        $baseClasses = "mx-auto w-full max-w-7xl px-6";
        $finalClasses = trim("$baseClasses $className");
        
        // Build HTML attributes
        $attr_string = '';
        foreach ($attrs as $key => $value) {
            $attr_string .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }

        echo '<div class="' . esc_attr($finalClasses) . '"' . $attr_string . '>';
        if (is_callable($children)) {
            $children();
        }
        echo '</div>';
    }
}
<?php

if(!function_exists('format_price')) {
    function format_price($price, $suffix = "đ") {
        if ($price === null || $price === '') {
            return '0' . $suffix;
        }

        return number_format((float) $price, 0, ',', '.') . $suffix;
    }
}
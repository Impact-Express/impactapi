<?php

if (!function_exists('preprint')) {
    function preprint() {
        foreach (func_get_args() as $arg) {
            echo '<pre>';
            print_r($arg);
            echo '</pre>';
        }
    }
}

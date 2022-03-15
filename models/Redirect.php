<?php
class Redirect {
    static function link($link) {
        header('Location:'.BASE_URL.$link);
        exit;
    }

    static function home() {
        header('Location:'.BASE_URL);
        exit;
    }
}
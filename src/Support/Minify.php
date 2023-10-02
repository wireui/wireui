<?php

namespace WireUi\Support;

final class Minify
{
    public static function minify(string $subject): string
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }
}

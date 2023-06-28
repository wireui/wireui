<?php

namespace WireUi\Actions;

class Minify
{
    /**
     * Minify the given subject.
     */
    public static function execute($subject)
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }
}

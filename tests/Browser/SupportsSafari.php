<?php

namespace Tests\Browser;

use Symfony\Component\Process\Process;

// Thanks to https://github.com/appstract/laravel-dusk-safari for most of this source.
/** @see https://github.com/livewire/livewire/blob/master/tests/Browser/SupportsSafari.php */
trait SupportsSafari
{
    protected static $safariProcess;

    /** @beforeClass */
    public static function prepare()
    {
        if (static::$useSafari) {
            static::startSafariDriver();
        } else {
            static::startChromeDriver(['port' => 9515]);
        }
    }

    public function onlyRunOnChrome()
    {
        static::$useSafari && $this->markTestSkipped();
    }

    public static function startSafariDriver()
    {
        static::$safariProcess = new Process([
            '/usr/bin/safaridriver', '-p 9515',
        ]);

        static::$safariProcess->start();

        static::afterClass(function () {
            if (static::$safariProcess) {
                static::$safariProcess->stop();
            }
        });
    }
}

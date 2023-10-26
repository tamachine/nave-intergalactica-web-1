<?php

/**
 * Gathering place for any little helper functions focused on the app frontend.
 * This file is autoloaded by composer.json
 */

use App\Interfaces\CurrencyRatesRepositoryInterface;

 if (!function_exists('selectedCurrency')) {
    /**
     * Returns the selected currency
     *
     * @return     string
     */
    function selectedCurrency()
    {
        return session('currency') !== null ? session('currency') : config('settings.default_currency');
    }
 }

if (!function_exists('getBreadcrumb')) {

    function getBreadcrumb($routes = []) {
        $breadcrumbs = new App\Services\Breadcrumbs\Breadcrumbs();
        $breadcrumb = [];

        foreach($routes as $route) {            
            $currentBreadcrumb = $breadcrumbs->getBreadcrumbByRoute($route);
            
            if (!$currentBreadcrumb) {
                $currentBreadcrumb = new App\Services\Breadcrumbs\Breadcrumb();
                $currentBreadcrumb->setText($route);
                $currentBreadcrumb->setLink('#');
            }

            $breadcrumb[] = $currentBreadcrumb;
        }

        return $breadcrumb;
    }
}


if (!function_exists('formatPrice')) {
    /**
     * Format the price according to the currency in session
     *
     * @param      int      $price
     * @param      string   $defaultCurrency
     * @return     string
     */
    function formatPrice($price, $defaultCurrency = null)
    {
        if ($defaultCurrency) {
            $currency = $defaultCurrency;
        } else {
            $currency = session('currency') !== null ? session('currency') : config('settings.default_currency');
        }

        $locale = session('locale') !== null ? session('locale') : 'en';

        // El precio puede ser un string
        if (is_string($price)) {
            $price = intval(preg_replace("/[^0-9]/", "", $price));
        }

        $rates = app(CurrencyRatesRepositoryInterface::class)->all();
        
        $fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        switch ($currency) {
            case 'EUR':
                $rate = $rates["EUR"] / $rates["ISK"];
                $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
                break;

            case 'GBP':
                $rate = $rates["GBP"] / $rates["ISK"];
                $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
                break;

            case 'USD':
                $rate = 1 / $rates["ISK"];
                $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
                break;

            default:
                $rate = 1;
                $fmt->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);
                break;
        }

        $price = round(intval($price) * $rate, 2);

        return $fmt->formatCurrency($price, $currency);
    }
 }

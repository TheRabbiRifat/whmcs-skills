<?php

use WHMCS\View\Formatter\Price;

add_hook('CartItemsTax', '1', function ($vars) {
    $cartItems = $vars['cartData'];
    $client = $vars['clientData'];

    // Calculate your tax rate to apply
    $taxRate = 1.5; // 50%

    /** @var \WHMCS\Cart\Item\ItemInterface $item */
    foreach ($cartItems as $item) {
        if (!$item->isTaxed()) {
            continue;
        }

        /** @var Price $amountToday */
        $amountToday = $item->getAmount();

        // Set the price due today for the item
        $item->setAmount(new Price(
            ($amountToday->toNumeric() * $taxRate),
            $amountToday->getCurrency()
        ));

        if ($item->isRecurring()) {
            /** @var Price $recurringAmount */
            $recurringAmount = $item->getRecurringAmount();
            // Set the recurring price of the item
            $item->setRecurringAmount(
                new Price(
                    ($recurringAmount->toNumeric() * $taxRate),
                    $recurringAmount->getCurrency()
                )
            );
        }
    }

    return [
        'cartData' => $cartItems
    ];
});
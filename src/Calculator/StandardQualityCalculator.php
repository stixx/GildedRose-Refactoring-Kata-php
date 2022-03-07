<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

class StandardQualityCalculator implements QualityCalculatorInterface
{
    public function calculate(DecoratedItem $item): void
    {
        $item->decreaseSellIn();

        if ($item->getSellIn() > 0) {
            $item->decreaseQuality();
        } else {
            $item->decreaseQuality(2);
        }
    }

    public function supports(DecoratedItem $item): bool
    {
        return $item->isSpecialItem() === false;
    }
}

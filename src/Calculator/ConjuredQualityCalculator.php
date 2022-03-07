<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

class ConjuredQualityCalculator implements QualityCalculatorInterface
{
    public function calculate(DecoratedItem $item): void
    {
        $item->decreaseSellIn();
        $item->decreaseQuality(2);
    }

    public function supports(DecoratedItem $item): bool
    {
        return $item->getName() === DecoratedItem::ITEM_CONJURED;
    }
}

<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

class AgedBrieQualityCalculator implements QualityCalculatorInterface
{
    public function calculate(DecoratedItem $item): void
    {
        $item->decreaseSellIn();
        $item->increaseQuality();
    }

    public function supports(DecoratedItem $item): bool
    {
        return $item->getName() === DecoratedItem::ITEM_BRIE;
    }
}

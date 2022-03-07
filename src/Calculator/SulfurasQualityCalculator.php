<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

class SulfurasQualityCalculator implements QualityCalculatorInterface
{
    public function calculate(DecoratedItem $item): void
    {
        $item->decreaseSellIn(0);
        $item->increaseQuality(0);
    }

    public function supports(DecoratedItem $item): bool
    {
        return $item->getName() === DecoratedItem::ITEM_SULFURAS;
    }
}

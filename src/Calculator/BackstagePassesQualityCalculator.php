<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

class BackstagePassesQualityCalculator implements QualityCalculatorInterface
{
    public function calculate(DecoratedItem $item): void
    {
        $item->decreaseSellIn();

        switch (true) {
            case $this->itemSellInIsOver($item, 10):
                $item->increaseQuality();
                break;
            case $this->itemSellInIsOver($item, 5):
                $item->increaseQuality(2);
                break;
            case $this->itemSellInIsOver($item, 3):
                $item->increaseQuality(3);
                break;
            default:
                $item->setQualityToZero();
        }
    }

    public function supports(DecoratedItem $item): bool
    {
        return $item->getName() === DecoratedItem::ITEM_BACKSTAGE_PASSES;
    }

    private function itemSellInIsOver(DecoratedItem $item, int $day): bool
    {
        return $item->getSellIn() > $day;
    }
}

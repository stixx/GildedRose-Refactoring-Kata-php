<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Calculator\QualityCalculator;
use GildedRose\Item\DecoratedItem;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    private QualityCalculator $qualityCalculator;

    public function __construct(array $items)
    {
        $this->items = $items;
        $this->qualityCalculator = new QualityCalculator();
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            // Probably could use a factory to create more specific item types.
            $decoratedItem = new DecoratedItem($item);
            $this->qualityCalculator->calculate($decoratedItem);
        }
    }
}

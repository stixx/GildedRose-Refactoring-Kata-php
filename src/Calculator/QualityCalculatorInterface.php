<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

interface QualityCalculatorInterface
{
    public function calculate(DecoratedItem $item): void;

    public function supports(DecoratedItem $item): bool;
}

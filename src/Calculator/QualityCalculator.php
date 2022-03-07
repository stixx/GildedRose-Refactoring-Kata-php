<?php

declare(strict_types=1);

namespace GildedRose\Calculator;

use GildedRose\Item\DecoratedItem;

class QualityCalculator
{
    /**
     * @var QualityCalculatorInterface[]
     */
    private array $collection = [];

    public function __construct()
    {
        $this->addCalculator(new StandardQualityCalculator());
        $this->addCalculator(new AgedBrieQualityCalculator());
        $this->addCalculator(new BackstagePassesQualityCalculator());
        $this->addCalculator(new SulfurasQualityCalculator());
        $this->addCalculator(new ConjuredQualityCalculator());
    }

    public function calculate(DecoratedItem $item): void
    {
        foreach ($this->collection as $calculator) {
            if ($calculator->supports($item) === false) {
                continue;
            }

            $calculator->calculate($item);
        }
    }

    private function addCalculator(QualityCalculatorInterface $calculator): void
    {
        if (in_array($calculator::class, $this->collection)) {
            return; // normally we would throw an exception.
        }

        $this->collection[$calculator::class] = $calculator;
    }
}

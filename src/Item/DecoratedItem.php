<?php

declare(strict_types=1);

namespace GildedRose\Item;

use GildedRose\Item;

class DecoratedItem
{
    public const ITEM_BRIE = 'Aged Brie';

    public const ITEM_SULFURAS = 'Sulfuras, Hand of Ragnaros';

    public const ITEM_BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';

    public const ITEM_CONJURED = 'Conjured';

    private const SPECIAL_ITEMS = [
        self::ITEM_BRIE,
        self::ITEM_SULFURAS,
        self::ITEM_BACKSTAGE_PASSES,
        self::ITEM_CONJURED,
    ];

    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    public function getName(): string
    {
        return $this->item->name;
    }

    public function getQuality(): int
    {
        return $this->item->quality;
    }

    public function getSellIn(): int
    {
        return $this->item->sell_in;
    }

    public function increaseQuality(int $value = 1): void
    {
        $this->item->quality += abs($value);

        if ($this->item->quality > 50 && $this->item->name !== static::ITEM_SULFURAS) {
            $this->item->quality = 50;
        }
    }

    public function decreaseQuality(int $value = 1): void
    {
        $this->item->quality -= abs($value);

        if ($this->item->quality < 0) {
            $this->setQualityToZero();
        }
    }

    public function setQualityToZero(): void
    {
        $this->item->quality = 0;
    }

    public function decreaseSellIn(int $value = 1): void
    {
        $this->item->sell_in -= $value;
    }

    public function isSpecialItem(): bool
    {
        return in_array($this->item->name, static::SPECIAL_ITEMS, true);
    }
}

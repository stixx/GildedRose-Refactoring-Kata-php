<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use GildedRose\Item\DecoratedItem;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new Item(DecoratedItem::ITEM_SULFURAS, 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(DecoratedItem::ITEM_SULFURAS, $items[0]->name);
    }

    public function testQualityDegradesTwiceAfterSellByDateHasPassed(): void
    {
        $items = [new Item('foo', -1, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testItemQualityIsNeverNegative(): void
    {
        $items = [new Item('foo', -4, 1)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testQualityIncreasesIfItGetsOlderForAgedBrie(): void
    {
        $items = [new Item(DecoratedItem::ITEM_BRIE, -4, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->quality);
    }

    public function testSulfurasNeverHasToBeSoldOrDecreasesInQuality(): void
    {
        $items = [new Item(DecoratedItem::ITEM_SULFURAS, -20, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(80, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseInQualityAsSellInApproaches(): void
    {
        $items = [new Item(DecoratedItem::ITEM_BACKSTAGE_PASSES, 12, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(11, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseBy2When10DaysOrLess(): void
    {
        $items = [new Item(DecoratedItem::ITEM_BACKSTAGE_PASSES, 11, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(12, $items[0]->quality);
    }

    public function testBackstagePassesIncreaseBy3When5DaysOrLess(): void
    {
        $items = [new Item(DecoratedItem::ITEM_BACKSTAGE_PASSES, 6, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(13, $items[0]->quality);
    }

    public function testBackstagePassesHaveZeroQualityAfterConcert(): void
    {
        $items = [new Item(DecoratedItem::ITEM_BACKSTAGE_PASSES, -1, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(0, $items[0]->quality);
    }

    public function testConjuredItemDegradesTwiceAsFast(): void
    {
        $items = [new Item(DecoratedItem::ITEM_CONJURED, 5, 10)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(8, $items[0]->quality);
    }
}

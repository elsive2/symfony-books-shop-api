<?php

namespace App\Model;

class CategoryListResponse
{
    private array $items;
        
    /**
     * __construct
     *
     * @param CategoryListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Get the value of items
     *
     * @return CategoryListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
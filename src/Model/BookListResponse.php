<?php

namespace App\Model;

class BookListResponse
{
    private array $items;
        
    /**
     * __construct
     *
     * @param BookListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Get the value of items
     *
     * @return BookListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
<?php
namespace Ryantxr\Quake\Menu;

use Ryantxr\Quake\Helpers\MenuItemHelper;

class Builder
{
    public $menu = [];

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Add new items at the end of the menu.
     *
     * @param  mixed  $newItems  Items to be added
     */
    public function add(...$newItems)
    {
        $items = $this->transformItems($newItems);

        if (! empty($items)) {
            array_push($this->menu, ...$items);
        }
    }

    /**
     * Transform the items by applying the filters.
     *
     * @param  array  $items  An array with items to be transformed
     * @return array Array with the new transformed items
     */
    protected function transformItems($items)
    {
        return array_filter(
            array_map([$this, 'applyFilters'], $items),
            [MenuItemHelper::class, 'isAllowed']
        );
    }
}

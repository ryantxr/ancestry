<?php

namespace Ryantxr\Quake;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Container\Container;
use Ryantxr\Quake\Events\BuildingMenu;
use Ryantxr\Quake\Menu\Builder;

class Quake
{
    protected $events;

    protected $container;

    public function __construct(Dispatcher $events, Container $container)
    {
        $this->events = $events;
        $this->container = $container;
    }


    /**
     * Get all the menu items, or a specific set of these.
     *
     * @param  string  $filterToken  Token representing a subset of the menu items
     * @return array A set of menu items
     */
    public function menu($filterToken = null)
    {
        if (empty($this->menu)) {
            $this->menu = $this->buildMenu();
        }

        // Check for filter token.

        if (isset($this->menuFilterMap[$filterToken])) {
            return array_filter(
                $this->menu,
                $this->menuFilterMap[$filterToken]
            );
        }

        // No filter token provided, return the complete menu.

        return $this->menu;
    }

    /**
     * Build the menu.
     *
     * @return array The set of menu items
     */
    protected function buildMenu()
    {
        // Create the menu builder instance.

        $builder = new Builder($this->buildFilters());

        // Dispatch the BuildingMenu event. Listeners of this event will fill
        // the menu.

        $this->events->dispatch(new BuildingMenu($builder));

        // Return the set of menu items.

        return $builder->menu;
    }

    /**
     * Build the menu filters.
     *
     * @return array The set of filters that will apply on each menu item
     */
    protected function buildFilters()
    {
        return array_map([$this->container, 'make'], $this->filters);
    }





    public function method()
    {
        return __METHOD__;
    }
}
<?php
namespace WebLogin\LaravelLookup;

use Illuminate\Support\Collection as BaseCollection;


class LookupCollection extends BaseCollection
{

    /**
     * Find a lookup object in the collection by primary key.
     *
     * @param string|array $key
     * @return \WebLogin\LaravelLookup\Lookup|null
     */
    public function find($key)
    {
        if (is_array($key)) {
            if ($this->isEmpty()) {
                return new static;
            }

            return $this->filter(function ($lookup) use ($key) {
                return in_array($lookup->getPrimaryKey(), $key, true);
            })->values();
        }

        return $this->first(function ($lookup) use ($key) {
            return $lookup->getPrimaryKey() === $key;
        });
    }

}

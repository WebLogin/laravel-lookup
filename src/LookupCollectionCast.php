<?php
namespace WebLogin\LaravelLookup;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;


class LookupCollectionCast implements CastsAttributes
{

    /**
     * @var string
     */
    protected $lookup;


    /**
     * @return void
     */
    public function __construct($lookup)
    {
        $this->lookup = $lookup;
    }


    /**
     * @return \WebLogin\LaravelLookup\LookupCollection|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        $primaryKeys = json_decode($value);
        $items = $this->lookup::collection()->find($primaryKeys);

        return count($items) ? $items : null;
    }


    /**
     * @return string|null
     */
    public function set($model, string $key, $value, array $attributes)
    {
        $primaryKeys = Collection::wrap($value)
            ->map(function ($item) {
                if (is_string($item)) {
                    $item = trim($item);
                }

                if ($item instanceof Lookup) {
                    return $item->getPrimaryKey();
                }

                if ($this->lookup::getPrimaryKeyType() === 'integer') {
                    return (int) $item;
                }

                return (string) $item;
            })
            ->filter(function ($item) {
                return (!is_null($item) AND $item !== '');
            })
            ->values();

        if ($primaryKeys->isEmpty()) {
            return null;
        }

        return json_encode($primaryKeys);
    }

}

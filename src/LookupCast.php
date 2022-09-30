<?php
namespace WebLogin\LaravelLookup;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;


class LookupCast implements CastsAttributes
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
     * @return \WebLogin\LaravelLookup\Lookup|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        return $this->lookup::collection()->find($value);
    }


    /**
     * @return string|int|null
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_string($value)) {
            $value = trim($value);
        }

        if (is_null($value) OR $value === '') {
            return null;
        }

        if ($value instanceof Lookup) {
            return $value->getPrimaryKey();
        }

        if ($this->lookup::getPrimaryKeyType() === 'integer') {
            return (int) $value;
        }

        return (string) $value;
    }


    /**
     * @return string|int|null
     */
    public function serialize($model, string $key, $value, array $attributes)
    {
        return !is_null($value) ? $value->getPrimaryKey() : null;
    }

}

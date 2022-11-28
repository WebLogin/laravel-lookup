<?php
namespace WebLogin\LaravelLookup;

use Exception;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;


abstract class Lookup implements Arrayable, Jsonable, JsonSerializable
{

    /**
     * @var string
     */
    protected static $primaryKeyName = 'key';


    /**
     * @return void
     */
    private function __construct(array $attributes = [])
    {
        if (!array_key_exists(static::$primaryKeyName, $attributes)) {
            throw new Exception("Each item returned in '" . static::class . "' getItems() methods needs to have a key named '" . static::$primaryKeyName . "'. Or change the \$primaryKeyName attribute of the Lookup.");
        }

        if (!property_exists($this, static::$primaryKeyName)) {
            throw new Exception("The class '" . static::class . "' is missing the attribute declaration for the primary key named '" . static::$primaryKeyName . "'.");
        }

        if (!in_array(gettype($attributes[static::$primaryKeyName]), ['string', 'integer'])) {
            throw new Exception("The class '" . static::class . "' contains primary key attribute that is not of type string or int.");
        }

        foreach ($attributes as $key => $attribute) {
            if (property_exists($this, $key)) {
                $this->$key = $attribute;
            }
        }
    }


    /**
     * @return array
     */
    abstract protected static function getItems();


    /**
     * @return string|int
     */
    public function getPrimaryKey()
    {
        return $this->{static::$primaryKeyName};
    }


    /**
     * Get the primary key type based on the first item in the collection
     *
     * @return string
     */
    public static function getPrimaryKeyType()
    {
        return gettype(static::first()->getPrimaryKey());
    }


    /**
     * @return \WebLogin\LaravelLookup\LookupCollection
     */
    public static function collection()
    {
        $collection = LookupCollection::make();
        foreach (static::getItems() as $item) {
            $collection->push(new static($item));
        }

        return $collection;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }


    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }


    public function jsonSerialize(): array
    {
        return $this->toArray();
    }


    /**
     * @return \WebLogin\LaravelLookup\LookupCollection
     */
    public static function __callStatic($method, $parameters)
    {
        return static::collection()->$method(...$parameters);
    }

}

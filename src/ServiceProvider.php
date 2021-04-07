<?php
namespace WebLogin\LaravelLookup;

use Illuminate\Support\Enumerable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{

    public function register()
    {
        /**
         * Add whereJsonContains clause to search inside column containing
         * at least one of the listed values.
         *
         * @param string $column
         * @param string|array $values
         */
        Builder::macro('whereInLookupCollection', function (string $column, $values) {
            $values = ($values instanceof Enumerable) ? $values->all() : (array) $values;

            $this->where(function ($query) use ($column, $values) {
                foreach ($values as $value) {
                    if ($value instanceof Lookup) {
                        $value = $value->getPrimaryKey();
                    }

                    $query->orWhereJsonContains($column, $value);
                }
            });
        });
    }

}

<?php
namespace WebLogin\LaravelLookup;

use Illuminate\Support\Enumerable;
use Illuminate\Container\Container;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lookup.php', 'lookup');
    }


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
            $values = ($values instanceof Enumerable) ? $values->all() : (array)$values;

            $this->where(function ($query) use ($column, $values) {
                foreach ($values as $value) {
                    if ($value instanceof Lookup) {
                        $value = $value->getPrimaryKey();
                    }

                    if (Container::getInstance()->make('config')->get('lookup.db_json_support')) {
                        $query->orWhereJsonContains($column, $value);
                    } else {
                        $query->orWhere($column, 'LIKE', '%' . json_encode($value) . '%');
                    }
                }
            });
        });
    }

}

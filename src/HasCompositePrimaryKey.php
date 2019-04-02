<?php

namespace CoenJacobs\EloquentCompositePrimaryKeys;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait HasCompositePrimaryKey
{
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  Builder $query
     *
     * @return Builder
     * @throws Exception
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        foreach ($this->getKeyName() as $key) {
            if ( ! isset($this->$key)) {
                throw new Exception(__METHOD__ . 'Missing part of the primary key: ' . $key);
            }

            $query->where($key, '=', $this->$key);
        }

        return $query;
    }

    /**
     * Execute a query for a single record by ID.
     *
     * @param  array $ids Array of keys, like [column => value].
     * @param  array $columns
     *
     * @return mixed|static
     */
    public static function find($ids, $columns = ['*'])
    {
        $me    = new self;
        $query = $me->newQuery();
        foreach ($me->getKeyName() as $key) {
            $query->where($key, '=', $ids[$key]);
        }

        return $query->first($columns);
    }

    /**
     * Get the primary keys value for a save query.
     *
     * @return mixed
     */
    protected function getKeyForSaveQuery()
    {
        return $this->getKey();
    }
    
    /**
     * Get the value of the model's primary keys.
     *
     * @return mixed
     */
    public function getKey()
    {
        return array_reduce($this->getKeyName(), function ($result, $item) {
            $result[$item] = $this->getAttribute($item);
            return $result;
        }, array());
    }
}

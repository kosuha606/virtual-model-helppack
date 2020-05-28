<?php

namespace kosuha606\VirtualModelHelppack\Traits;

/**
 * Трейт для поиска по модели
 */
trait SearchVmTrait
{
    abstract public static function filter($key, $value);

    public static function search($filter, $config = [])
    {
        $filterWhere = [];

        foreach ($filter as $key => $value) {
            if ($filterResult = self::filter($key, $value)) {
                $filterWhere[] = $filterResult;
            }
        }

        if (isset($config['where'])) {
            $config['where'] = array_merge($config['where'], $filterWhere);
        } else {
            $config['where'] = $filterWhere;
        }

        return self::many($config);
    }
}
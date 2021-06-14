<?php

/** @noinspection PhpUnused */
/** @noinspection PhpUndefinedMethodInspection */

namespace kosuha606\VirtualModelHelpers\Traits;

trait SearchVmTrait
{
    /**
     * @param $key
     * @param $value
     * @return array
     * @noinspection PhpUnusedParameterInspection
     */
    public static function filter($key, $value): array
    {
        return [];
    }

    /**
     * @param $filter
     * @param array $config
     * @return mixed
     */
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

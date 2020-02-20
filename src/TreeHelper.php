<?php
/**
 * User: Jason Wang
 * @author  jason <jasonwang1211@gmail.com>
 */

namespace Jsyqw\Utils;


class TreeHelper
{
    /**
     * @param $arr 数组
     * @param $pid  父级值
     * @param string $keyName 作为主键的名称
     * @return array
     *  [{
            "id": "1",
            "pid": "0",
            "name": "test1",
            "children": [{
                "id": "4",
                "pid": "1",
                "name": "test1-1",
                "children": []
            }]
        }]
     */
    public static function getTree($arr, $pid, $keyName = 'pid')
    {
        $tree = [];
        foreach ($arr as $row) {
            if($row[$keyName] == $pid) {
                $row['children'] = [];
                //子集
                $children = self::getTree($arr, $row['id']);
                if(!empty($children)) {
                    $row['children'] = $children;
                }
                $tree[] = $row;
            }
        }
        return $tree;
    }
}
<?php

class NewStat_Option_NodeHelper
{
    public static function getAllNodesByType($type = 'Page', $ignoreNestedSetOrdering = false, $listView = false)
    {
        /** @var $nodeModel XenForo_Model_Node */
        $nodeModel = self::getNodeModel();
        $nodes = $nodeModel->getAllNodes($ignoreNestedSetOrdering, $listView);
        foreach ($nodes AS $node) {
            if ($node['node_type_id'] != $type) {
                unset($nodes[$node['node_id']]);
            }
        }
        return $nodes;
    }
    /**
     * @static
     * @return XenForo_Model_Node
     */
    protected static function getNodeModel(){
        return  XenForo_Model::create('XenForo_Model_Node');
    }
}
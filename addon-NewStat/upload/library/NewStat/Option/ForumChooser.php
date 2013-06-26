<?php

abstract class NewStat_Option_ForumChooser
{
    public static function renderOption(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {
        $value = $preparedOption['option_value'];

        $editLink = $view->createTemplateObject('option_list_option_editlink', array(
            'preparedOption' => $preparedOption,
            'canEditOptionDefinition' => $canEdit
        ));

        $nodeModel = XenForo_Model::create('XenForo_Model_Node');
        $f = NewStat_Option_NodeHelper::getAllNodesByType('Forum');

        $forumOptions = $nodeModel->getNodeOptionsArray($f, $preparedOption['option_value'], '(غير محدد)');

        return $view->createTemplateObject('option_list_option_multi_stat', array(
            'fieldPrefix' => $fieldPrefix,
            'listedFieldName' => $fieldPrefix . '_listed[]',
            'preparedOption' => $preparedOption,
            'formatParams' => $forumOptions,
            'editLink' => $editLink
        ));
    }
}
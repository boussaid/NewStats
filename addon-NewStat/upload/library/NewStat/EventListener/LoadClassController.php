<?php

class NewStat_EventListener_LoadClassController
{
    public static function listen($class, array &$extend)
    {
        if ($class == 'XenForo_ControllerPublic_Index')
        {
            $extend[] = 'NewStat_ControllerPublic_Index';
        }
    }
 public static function fileHashes(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $fileHashes = NewStat_Model_Hashes::getHashes();
        $hashes += $fileHashes;
    }     

     public static function renderOption(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {
        return self::_render('option_list_option_checkbox', $view, $fieldPrefix, $preparedOption, $canEdit);
    }
    
    /*
     * Render list of users in addon's option
     */
    protected static function _render($templateName, XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit)
    {
        $preparedOption['formatParams'] = XenForo_Option_UserGroupChooser::getUserGroupOptions(
            $preparedOption['option_value']
        );

        return XenForo_ViewAdmin_Helper_Option::renderOptionTemplateInternal(
            $templateName, $view, $fieldPrefix, $preparedOption, $canEdit
        );
    }
    
    public static function templateCreate($templateName, array &$params, XenForo_Template_Abstract $template)
    {
     
        if ($templateName == 'forum_list') {
            $template->preloadTemplate('new_stats');
        }
    }
    
    public static function templateHook($hookName, &$contnt, array $hookParams,  XenForo_Template_Abstract $template)
 {    
       $options = XenForo_Application::get('options');
        $sposition = $options->last_stat_posi;
      
        if ($hookName == 'forum_list_nodes'){
            $ourTemplate = $template->create('new_stats', $template->getparams());
            $rendered = $ourTemplate->render();
        if ($sposition == 1){ $contnt = $rendered . $contnt; }
            else {$contnt .= $rendered;}
            }
 }
}
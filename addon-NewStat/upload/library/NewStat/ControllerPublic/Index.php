<?php

/****************************************************
[*]  XenForo Addon: NewStats
[*]  Addon by: Boussaid Mustafa
[*]  Copyright 2013 http://www.shababadrar.net/vb
[*]  Support at: bousali@gmail.com
[*]  All rights reserved
 ****************************************************/

class NewStat_ControllerPublic_Index extends XFCP_NewStat_ControllerPublic_Index{
    public function actionIndex(){
        
        $response = parent::actionIndex();
        $visitor = XenForo_Visitor::getInstance();
        $options = XenForo_Application::get('options');
        $grpusr = $options->last_stat_group;
        $activ = $options->last_stat_on;
        if($activ AND in_array($visitor['user_group_id'], $grpusr)){
		$response->params['newStats'] = array();
            $mynewStats = XenForo_Model::create('XenForo_Model_DataRegistry')->get('myNewStats');
            $response->params['newStats']= $mynewStats;
        }       
        return $response;        
    }
}
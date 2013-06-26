<?php

class NewStat_CronEntry_Cache
{
    public static function runCron()  
    {        
        $visitor = XenForo_Visitor::getInstance();
        $options = XenForo_Application::get('options');
        $s_count = $options->last_stat_count;
        $grpusr = $options->last_stat_group;
        $activ = $options->last_stat_on;
        if($activ == 1 AND in_array($visitor['user_group_id'], $grpusr)){
            $statModel = XenForo_Model::create('NewStat_Model_Stat');
                $stats = $statModel->getStats();
                $likedUsers = $statModel->getLikesUser();
                $userModel = XenForo_Model::create('XenForo_Model_User');
          
                $criteria = array(
                //'user_state' => 'valid',
                'is_banned' => 0,
                );
                
            $latestUsers = $userModel->getLatestUsers($criteria, array('limit' => $s_count));
            $activeUsers = $userModel->getMostActiveUsers($criteria, array('limit' => $s_count));
                //$mynewStats = array();
                $mynewStats = array(
                    'stats' => $stats,
                    'activeUsers' => $activeUsers,
                    'latestUsers' => $latestUsers,
                    'likedUsers' => $likedUsers
                );
       }

   XenForo_Model::create('XenForo_Model_DataRegistry')->set('myNewStats', $mynewStats);
   	$statModel = '';
	unset($statModel);
    }   
}
<?php
class NewStat_Model_Stat extends XenForo_Model
{
    public function getStats()
    {              
        
        $options = XenForo_Application::get('options');
        $s_forumout = $options->last_stat_forum;
        $s_count = $options->last_stat_count;

        return $this->_getDb()->fetchAll("
            SELECT thread.last_post_id as post_id,
       thread.user_id,
       thread.username as username ,
       thread.post_date,
       thread.title as threadtitle,
       thread.thread_id as thread_id, thread.reply_count, thread.view_count,
       user.avatar_date, user.display_style_group_id,
       forum.title as node_title, forum.node_id as node_id
       FROM xf_thread as thread
       LEFT JOIN xf_user AS user ON (thread.user_id = user.user_id)
       LEFT JOIN xf_node AS forum ON (thread.node_id = forum.node_id)
       WHERE discussion_open = '1' AND discussion_state ='visible'
       AND thread.node_id IN ('" . implode("','",$s_forumout) . "')
       ORDER BY post_date DESC
       LIMIT ". $s_count .";");     
    }
    
   
    public function getLikesUser()
	{
        $options = XenForo_Application::get('options');
        $s_count = $options->last_stat_count;
		return $this->_getDb()->fetchAll("
            SELECT *
            FROM xf_user
            ORDER BY like_count DESC
            LIMIT ". $s_count .";");
	}
	public function gtPermissions()
    {
        return XenForo_Visitor::getInstance()->hasPermission( 'general', 'statsCansee' ) ? true : false;
    }
}
<?php

class NewStat_Install
{
    public static function installer($installedAddon)
    {
        if (XenForo_Application::$versionId < 1020031)
        {
            // note: this can't be phrased
            throw new XenForo_Exception('هذا المنتج يتطلب إصدار 1.2.0 بيتا 1 و أعلى.', true);
        }	    
    }
	
	public static function uninstall()
    {
		XenForo_Model::create('XenForo_Model_DataRegistry')->delete('myNewStats');
    }
}
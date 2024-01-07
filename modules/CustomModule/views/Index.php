<?php

class CustomModule_Index_View extends Vtiger_Index_View
{
    function __construct(){
        parent::__construct();
	}
    
    function process(Vtiger_Request $request){
		global $current_user,$adb;
        $mode = $request->getMode();
        if(!empty($mode)) {
            echo $this->invokeExposedMethod($mode, $request);
            return;
        }
        $moduleName = $request->getModule();
		$viewer = $this->getViewer($request);
		
		$sqlApp = "SELECT vtiger_app2tab.appname FROM vtiger_app2tab WHERE vtiger_app2tab.appname!=? GROUP BY vtiger_app2tab.appname";
		$dataApp = array('SETTINGS');
		$resApp = $adb->pquery($sqlApp,$dataApp);
		$detApp = array();
		$appList = '<option value="">Select an App</option>';
		while($detApp=$adb->fetchByAssoc($resApp)){
			if(!empty($detApp['appname'])){
				$appList .= '<option value="'.$detApp['appname'].'">'.$detApp['appname'].'</option>';
			}
		}
		
		$viewer->assign('APP_LIST',$appList);
		$viewer->view('Index.tpl',$moduleName);
    }
}
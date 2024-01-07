<?php
 
class CustomModule_createCustomModule_Action extends Vtiger_Action_Controller
{
    public function checkPermission()
    {
        return true;
    }
    
    public function process(Vtiger_Request $request)
    {
		global $adb;
		$moduleName = $request->getModule();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		// $digitalFunnel = $moduleModel->getDigitalFunnel();
		// echo $digitalFunnel;
		$identField = str_replace(" ","",$_REQUEST['identifierField']);
		$identField = strtolower($identField);
		include_once 'vtlib/Vtiger/Module.php';
		require_once 'modules/ModComments/ModComments.php';
		$Vtiger_Utils_Log = true;

		$MODULENAME = str_replace(" ","",$_REQUEST['moduleName']);
		
		$moduleInstance = Vtiger_Module::getInstance($MODULENAME);

		if ($moduleInstance || file_exists('modules/'.$MODULENAME)) {
			echo "Module already present - choose a different name.";
		} else {
			$moduleInstance = new Vtiger_Module();
			$moduleInstance->name = $MODULENAME;
			$moduleInstance->parent= 'Support';
			$moduleInstance->save();

			// Schema Setup
			$moduleInstance->initTables();

			// Field Setup
			$block = new Vtiger_Block();
			$block->label = 'LBL_'. strtoupper($moduleInstance->name) . '_INFORMATION';
			$moduleInstance->addBlock($block);

			$blockcf = new Vtiger_Block();
			$blockcf->label = 'LBL_CUSTOM_INFORMATION';
			$moduleInstance->addBlock($blockcf);

			$field1  = new Vtiger_Field();
			$field1->name = $identField;
			$field1->label= trim($_REQUEST['identifierField']);
			$field1->uitype= 2;
			$field1->column = $field1->name;
			$field1->columntype = 'VARCHAR(255)';
			$field1->typeofdata = 'V~M';
			$block->addField($field1);

			$moduleInstance->setEntityIdentifier($field1);

			// Recommended common fields every Entity module should have (linked to core table) 
			$mfield1 = new Vtiger_Field();
			$mfield1->name = 'assigned_user_id';
			$mfield1->label = 'Assigned To';
			$mfield1->table = 'vtiger_crmentity';
			$mfield1->column = 'smownerid';
			$mfield1->uitype = 53;
			$mfield1->typeofdata = 'V~M';
			$block->addField($mfield1);

			$mfield2 = new Vtiger_Field();
			$mfield2->name = 'CreatedTime';
			$mfield2->label= 'Created Time';
			$mfield2->table = 'vtiger_crmentity';
			$mfield2->column = 'createdtime';
			$mfield2->uitype = 70;
			$mfield2->typeofdata = 'T~O';
			$mfield2->displaytype= 2;
			$block->addField($mfield2);

			$mfield3 = new Vtiger_Field();
			$mfield3->name = 'ModifiedTime';
			$mfield3->label= 'Modified Time';
			$mfield3->table = 'vtiger_crmentity';
			$mfield3->column = 'modifiedtime';
			$mfield3->uitype = 70;
			$mfield3->typeofdata = 'T~O';
			$mfield3->displaytype= 2;
			$block->addField($mfield3);

			// Filter Setup
			$filter1 = new Vtiger_Filter();
			$filter1->name = 'All';
			$filter1->isdefault = true;
			$moduleInstance->addFilter($filter1);
			$filter1->addField($field1)->addField($mfield1, 3);

			// Sharing Access Setup
			$moduleInstance->setDefaultSharing();

			// Webservice Setup
			$moduleInstance->initWebservice();

			mkdir('modules/'.$MODULENAME);
			
			// $vtiger_utils_log = true;
			// $commentsmodule = vtiger_module::getinstance( 'ModComments' );
			// $fieldinstance = vtiger_field::getinstance( 'related_to', $commentsmodule );
			// $fieldinstance->setrelatedmodules( array($MODULENAME) );
			// $detailviewblock = modcomments::addwidgetto( $MODULENAME );
			// echo "comment widget for module $MODULENAME has been created<br />";
			
			echo "|~|OK";
		}
	}
}
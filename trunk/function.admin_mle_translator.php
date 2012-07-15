<?php

if (!isset($gCms))
    exit;

if (!$this->CheckAccess('manage translator_mle'))
{
    echo $this->ShowErrors($this->Lang('accessdenied')); return;
}

$config = cmsms()->getConfig();

Translation::setLanguages($this->getLangs());

$this->smarty->assign('keysArray', Translation::getKeysTable());
$this->smarty->assign('langsArray', Translation::getContentTable());
$this->smarty->assign('ajaxLink', htmlspecialchars_decode($this->CreateLink($id, 'admin_ajax_translator_service', $returnid, '', array(), '', true)));
$this->smarty->assign('deleteIcon', cmsms()->get_variable('admintheme')->DisplayImage('icons/system/delete.gif', $this->Lang('delete'), '', '', 'systemicon'));

echo $this->ProcessTemplate('edittranslations.tpl');

?>
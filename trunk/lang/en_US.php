<?php

$lang['friendlyname'] = 'Mle CMS';
$lang['postinstall'] = 'Mle CMS was successful installed';
$lang['postuninstall'] = 'Mle CMS was successful uninstalled';
$lang['really_uninstall'] = 'Really? Are you sure
you want to unsinstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['moddescription'] = 'This module add multilanguage solutions to you CMS Made Simple';
$lang['info_success'] = 'Succes';
$lang['optionsupdated'] = 'Options updated';

$lang['error'] = 'Error!';
$land['admin_title'] = 'Admin Panel';
$lang['admindescription'] = '';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['postinstall'] = 'Post Install Message, (e.g., Be sure to set "manage mle_cms" permissions to use this module!)';

// Mle config
$lang['mle_config'] = 'Multilang config';
$lang['idtext'] = 'ID';
$lang['alias'] = 'Root alias';
$lang['name'] = 'Name';

$lang['locale'] = 'Locale';
$lang['flag'] = 'Flag';

// Snippets

$lang['manage_snippets'] = 'Snippets';
$lang['unknown'] = 'Error: Unknown';
$lang['delete'] = 'Delete';
$lang['areyousure'] = 'Are you sure ?';
$lang['edit'] = 'Edit';
$lang['add'] = 'Add';
$lang['source'] = 'Source';
$lang['submit'] = 'Submit';
$lang['cancel'] = 'Cancel';
$lang['apply'] = 'Apply';
$lang['tag'] = 'Tag';

// Blocks
$lang['manage_blocks'] = 'Blocks';

// Options
$lang['options'] = 'Options';
$lang['mle_id'] = 'Mle identifier';
$lang['mle_template'] = 'Multilang template';
$lang['mle_hierarchy_switch'] = 'Hierarchy switch';
$lang['mle_auto_redirect'] = 'Language detection';
$lang['none'] = 'None';
$lang['root_redirect'] = 'Redirect in the root directory';
$lang['hierarchy_redirect'] = 'Redirect on each level of hierarchy';


$lang['help_name'] = 'snippet or block name';


$lang['changelog'] = '<ul>
<li>Version 1 - january 2011 Initial Release.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module add multilanguage solution to your CMS Made Simple.</p>
<h3>How Do I Use It</h3>

    <p>1. Create Page structure - each lanuage have own page structure. Root alias is identificatior </p>
    <p>2. Configure your MleCMS module in admin area</p>
    <p>3. Put to your template</p>
    <p>
        Init action
        <br />
        {MleCMS action="init"}
    </p>
    <p>Mle language switch
        <br />
        {MleCMS action="langs"} 
    </p>

    <p>4. Use MLE blocks and snippets in module</p>
    <p>5. Example usage MLE modules</p>
    <p>Add  lang=$lang_locale param to each your module in templates. Examples:</p>
    <p>
        <code>{menu loadprops=0 template=\'cssmenu_ulshadow.tpl\' childrenof=$lang_parent lang=$lang_locale}</code><br >
        <code>{news number=\'3\' category=$lang_parent lang=$lang_locale}</code><br >
        <code>{search search_method="post" lang=$lang_locale}</code><br >
        <code>{breadcrumbs starttext=\'You are here\' root=\'Home\' delimiter=\'&raquo;\'  lang=$lang_locale}</code>
    </p>
';
?>

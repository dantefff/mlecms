<?php

# Module: Multilanguage CMS
# Zdeno Kuzmany (zdeno@kuzmany.biz) kuzmany.biz
#
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2009 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/skeleton/
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------

class mle_smarty {

    /**
     * Initialize the smarty plugins.
     */
    public static function init() {
        $smarty = cmsms()->GetSmarty();

        $smarty->register_function('mle_assign', array('mle_smarty', 'mle_assign'));
        $smarty->register_function('translate', array('mle_smarty', 'translator'));
        $smarty->register_function('mle_search_checker', array('mle_smarty', 'mle_search_checker'));
        $smarty->register_block('translator', array('mle_smarty', 'translator_block'));
    }

    /**
     *  Translator smarty functon
     * @param array $params 
     * @param array $smarty
     * @return type 
     */
    public function translator($params, &$smarty) {
        $module = cms_utils::get_module('MleCMS');
        return $module->DoAction('translator', '', $params);
    }

    public function translator_block($params, $content, &$smarty, &$repeat) {
        if (!$content)
            return;

        $module = cms_utils::get_module('MleCMS');
        // opening tag
        if ($repeat) {
            // get from cache
            // exist, stop work
            $repeat = false;
        } else {
            // set cache
            $params["text"] = $content;
            return $module->DoAction('translator', '', $params);

            return;
        }
    }

    /**
     *  get mle values from object (example $item->title, $item->title_en...)
     * @param array $params
     * @param array $smarty 
     */
    public function mle_assign($params, &$smarty) {

        if (!isSet($params["object"]) || !is_object($params["object"]) || !isSet($params["par"]))
            return;

        $smarty = cmsms()->GetSmarty();
        $lang_parent = $smarty->get_template_vars('lang_parent');
        $object = $params["object"];
        $par = $params["par"];
        $mle_par = $params["par"] . '_' . $lang_parent;


        $value = $object->$par;
        if ($object->$mle_par != "")
            $value = $object->$mle_par;

        $object->$par = $value;

        if (isSet($params["assign"]))
            $smarty->assign($params["assign"], $object);
        else
            echo $value;
    }

    /**
     * Return GetOne from Table for search restriction - require select, table
     * @param array $params 
     * @param object $smarty
     * @return string 
     */
    public function mle_search_checker($params, &$smarty) {

        if (!isSet($params["from"]) || !isSet($params["select"]))
            return;

        $where = '';

        $key = implode(',', $params);
        $value = cms_utils::get_app_data($key);


        if (!$value) {

            $parms = $params;
            unset($parms["assign"]);
            unset($parms["from"]);
            unset($parms["select"]);

            if (count($parms) > 0)
                $where = " WHERE " . cge_array::implode_with_key($parms, "=", " AND ");



            $db = cmsms()->GetDb();
            $query = "SELECT " . $params["select"] . " FROM " . cms_db_prefix() . $params["from"] . $where;
            $value = $db->GetOne($query);
            cms_utils::set_app_data($key, $value);
        }

        if (isSet($params["assign"]))
            $smarty->assign($params["assign"], $value);
        else
            echo $value;
    }

}

// end of class
#
# EOF
#
?>

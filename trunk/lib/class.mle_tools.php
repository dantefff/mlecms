<?php

/**
 * MleCMS tools
 *
 * @author @kuzmany
 */
class mle_tools {

    public static function get_root_alias() {
        $alias = cms_utils::get_app_data('root_alias');
        if ($alias)
            return $alias;

        $gCms = cmsms();
        $contentops = $gCms->GetContentOperations();
        $smarty = $gCms->GetSmarty();

        if ($alias == '') {
            $alias = $smarty->get_template_vars('page_alias');
        }
        $id = $contentops->GetPageIDFromAlias($alias);

        while ($id > 0) {
            $content = $contentops->LoadContentFromId($id);
            if (!is_object($content))
                return '';
            $alias = $content->Alias();
            $id = $content->ParentId();
        }
        cms_utils::set_app_data('root_alias', $alias);
        return $alias;
    }

    public static function getLangsLocale() {
        $mod = cms_utils::get_module('MleCMS');
        $alllangs = array(
            "Afrikaans" => "af_ZA", "Български" => "bg_BG", "Català" => "ca_ES", "Česky" => "cs_CZ", "Dansk" => "da_DK", "Deutsch" => "de_DE", "Ελληνικα" => "el_GR", "English" => "en_US",
            "Español" => "es_ES", "Eesti" => "et_EE", "Euskara" => "eu_ES", "Esperanto" => "eo_UY", "Suomi" => "fi_FI", "Français" => "fr_FR", "Magyar" => "hu_HU", "Bahasa Indonesia" => "id_ID", "Íslenska" => "is_IS", "Italiano" => "it_IT", "Hebrew" => "iw_IL",
            "日本語" => "ja_JP", "Lietuvių" => "lt_LT", "Mongolian" => "mn_MN", "Norsk bokmål" => "nb_NO", "Nederlands" => "nl_NL", "Polski" => "pl_PL", "Português Brasileiro" => "pt_BR",
            "Português" => "pt_PT", "Romansh" => "rm_CH", "Română" => "ro_RO", "Русский" => "ru_RU", "Slovenčina" => "sk_SK", "Slovenia" => "sl_SI", "српски Srpski" => "sr_YU", "Svenska" => "sv_SE", "Türkçe" => "tr_TR", "简体中文" => "zh_CN", "繁體中文" => "zh_TW",
            $mod->Lang("custom") => "custom"
        );
        return $alllangs;
    }

    public static function get_lang($lang_id) {
        $lang = cms_utils::get_app_data(__CLASS__ . __FUNCTION__ . $lang_id);
        if ($lang)
            return $lang;
        $db = cmsms()->GetDb();
        $query = 'SELECT * FROM ' . cms_db_prefix() . 'module_mlecms_config WHERE id = ?';
        $lang = $db->GetRow($query, array($lang_id));
        cms_utils::set_app_data(__CLASS__ . __FUNCTION__ . $lang_id, $lang);
        return $lang;
    }

    public static function get_lang_from_locale($locale) {
        $lang = cms_utils::get_app_data(__CLASS__ . __FUNCTION__ . $locale);
        if ($lang)
            return $lang;
        $db = cmsms()->GetDb();
        $query = 'SELECT * FROM ' . cms_db_prefix() . 'module_mlecms_config WHERE locale = ?';
        $lang = $db->GetRow($query, array($locale));
        cms_utils::set_app_data(__CLASS__ . __FUNCTION__ . $locale, $lang);
        return $lang;
    }
    public static function get_lang_from_alias($alias) {
        $lang = cms_utils::get_app_data(__CLASS__ . __FUNCTION__ . $alias);
        if ($lang)
            return $lang;
        $db = cmsms()->GetDb();
        $query = 'SELECT * FROM ' . cms_db_prefix() . 'module_mlecms_config WHERE alias = ?';
        $lang = $db->GetRow($query, array($alias));
        cms_utils::set_app_data(__CLASS__ . __FUNCTION__ . $alias, $lang);
        return $lang;
    }

    public static function get_langs() {
        $langs = cms_utils::get_app_data(__CLASS__ . __FUNCTION__);
        if ($langs)
            return $langs;
        $db = cmsms()->GetDb();
        $query = 'SELECT * FROM ' . cms_db_prefix() . 'module_mlecms_config';
        $langs = $db->GetAll($query, array());
        cms_utils::set_app_data(__CLASS__ . __FUNCTION__, $langs);
        return $langs;
    }

}

?>

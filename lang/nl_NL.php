<?php
i18n::include_locale_file('modules: metamanager', 'en_US');
global $lang;

if(array_key_exists('nl_NL', $lang) && is_array($lang['nl_NL'])) {
	$lang['nl_NL'] = array_merge($lang['en_US'], $lang['nl_NL']);
} else {
	$lang['nl_NL'] = $lang['en_US'];
}

$lang['nl_NL']['MetaManager']['GENERATEMETADATA'] = 'Genereer Meta-data automatisch uit de inhoud van de pagina';

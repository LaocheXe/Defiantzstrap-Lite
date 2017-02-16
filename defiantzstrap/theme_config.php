<?php

/**
 * Defiantzstrap Theme for e107 v2.x
 * Base on Bootstrap 3 Theme
 *
 * Created by: LaocheXe
 * Email: forbiddenchaos@gmail.com
 * Website: www.defiantz.org
 * Github: https://github.com/LaocheXe
 *
 * File: theme_config.php
**/

if (!defined('e107_INIT')) { exit; }

// Add LAN
include_lan(e_THEME.'defiantzstrap/languages/'.e_LANGUAGE.'.php');

// Dummy Theme Configuration File.
class theme_defiantzstrap implements e_theme_config
{
	function process() // Save posted values from config() fields. 
	{
		$pref = e107::getConfig();
		$tp = e107::getParser();
		
		$theme_pref 					    = array();
		$theme_pref['nav_alignment']	    = $_POST['nav_alignment'];
		$theme_pref['usernav_placement'] 	= $_POST['usernav_placement'];
		$theme_pref['branding'] 	        = $_POST['branding'];
		$theme_pref['portfolio']			= $_POST['portfolio'];
		$theme_pref['editbuttons']			= $_POST['editbuttons'];

		$pref->set('sitetheme_pref', $theme_pref);
		return $pref->dataHasChanged();
	}

	function config()
	{
		$frm = e107::getForm();

		$brandingOpts = array('sitename'=>LAN_THEME_BRANDING_SN, 'logo' => LAN_THEME_BRANDING_LO, 'sitenamelogo'=>LAN_THEME_BRANDING_LOSN);

		$var[0]['caption'] 	= LAN_THEME_BRANDING;
		$var[0]['html'] 	= $frm->select('branding', $brandingOpts, e107::pref('theme', 'branding', 'sitename'));
		$var[0]['help']		= LAN_THEME_BRANDING_HELP;
		
		$navbaralignmentOpts = array('left'=>LAN_THEME_NAVALIGN_L, 'right' => LAN_THEME_NAVALIGN_R);

		$var[1]['caption'] 	= LAN_THEME_NAVALIGN;
		$var[1]['html'] 	= $frm->select('nav_alignment', $navbaralignmentOpts, e107::pref('theme', 'nav_alignment', 'left'),'useValues=1');
		$var[1]['help']		= LAN_THEME_NAVALIGN_HELP;
		
		$signuploginOpts = array('top'=>LAN_THEME_SLP_T, 'bottom' => LAN_THEME_SLP_B);

		$var[2]['caption'] 	= LAN_THEME_SLP;
		$var[2]['html'] 	= $frm->select('usernav_placement', $signuploginOpts, e107::pref('theme', 'usernav_placement', 'top'),'useValues=1');
		$var[2]['help']		= LAN_THEME_SLP_HELP;
		
		$portfolioOpts = array('enable'=>LAN_THEME_PORTO_E, 'disable' => LAN_THEME_PORTO_D);

		$var[3]['caption']		= LAN_THEME_PORTO;
		$var[3]['html']			= $frm->select('portfolio', $portfolioOpts, e107::pref('theme', 'portfolio', 'enable'),'useValues=1');
		$var[3]['help']			= LAN_THEME_PORTO_HELP;
		
		$var[4]['caption']		= "Edit Menu Buttons";
		$var[4]['html']			= $frm->select('editbuttons', array('disable', 'enable'), e107::pref('theme', 'editbuttons', 'disable'),'useValues=1' );
		$var[4]['help']			= "";
		
		$var[5]['caption']		= LAN_THEME_SUPPORT;
		$var[5]['html']			= LAN_THEME_SUPPORT_MESSAGE;
		
	//	$var[1]['caption'] 	= "Sample configuration field 2";
	//	$var[1]['html'] 	= $frm->text('_blank_example2', e107::pref('theme', 'example2', 'default'));
		
		return $var;
	}

	function help()
	{
	 	return '';
	}
}


?>
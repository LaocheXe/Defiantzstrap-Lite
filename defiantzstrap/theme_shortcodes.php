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
 * File: theme_shortcodes.php
**/

class theme_shortcodes extends e_shortcode
{
	function __construct()
	{

	}

	function sc_defiantzstrap_branding()
	{
		$pref = e107::pref('theme', 'branding', 'sitename');

		switch($pref)
		{
			case 'logo':

				return e107::getParser()->parseTemplate('{SITELOGO: h=70}',true);

			break;

			case 'sitenamelogo':

				return "<span class='pull-left'>".e107::getParser()->parseTemplate('{SITELOGO: h=70}',true)."</span>".SITENAME;

			break;

			case 'sitename':
			default:

				return SITENAME;

			break;
		}

	}



	function sc_defiantzstrap_nav_align()
	{
		$pref = e107::pref('theme', 'nav_alignment');

		if($pref == 'right')
		{
			return "navbar-right";
		}
		else
		{
			return "";
		}
	}



	function sc_defiantzstrap_usernav($parm='')
	{
		/*
		$placement = e107::pref('theme', 'usernav_placement', 'top');

		if($parm['placement'] != $placement)
		{
			return '';
		}
		*/
		
		include_lan(e_PLUGIN."login_menu/languages/".e_LANGUAGE.".php");

		$tp = e107::getParser();
		require(e_PLUGIN."login_menu/login_menu_shortcodes.php"); // don't use 'require_once'.

		$direction = vartrue($parm['dir']) == 'up' ? ' dropup' : '';

		$userReg = defset('USER_REGISTRATION');

		if(!USERID) // Logged Out.
		{

			$text = '
			<ul class="nav navbar-nav navbar-right'.$direction.'">';

			if($userReg==1)
			{
				$text .= '
				<li><a href="'.e_SIGNUP.'">'.LOGIN_MENU_L3.'</a></li>
				'; // Signup
			}

			$socialActive = e107::pref('core', 'social_login_active');

			if(!empty($userReg) || !empty($socialActive)) // e107 or social login is active.
			{
				$text .= '
				<li class="divider-vertical"></li>
				<li class="dropdown">

				<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
				<div class="dropdown-menu col-sm-12" style="min-width:250px; padding: 15px; padding-bottom: 0px;">

				{SOCIAL_LOGIN: size=2x}
				';
			}
			else
			{
				return '';
			}


			if(!empty($userReg)) // value of 1 or 2 = login okay.
			{

				//global $sc_style;
				//$sc_style = array(); // remove an wrappers.

				$text .='

				<form method="post" onsubmit="hashLoginPassword(this);return true" action="'.e_REQUEST_HTTP.'" accept-charset="UTF-8">
				<p>{LM_USERNAME_INPUT}</p>
				<p>{LM_PASSWORD_INPUT}</p>


				<div class="form-group"></div>
				{LM_IMAGECODE_NUMBER}
				{LM_IMAGECODE_BOX}

				<div class="checkbox">

				<label class="string optional" for="autologin"><input style="margin-right: 10px;" type="checkbox" name="autologin" id="autologin" value="1">
				'.LOGIN_MENU_L6.'</label>
				</div>
				<input class="btn btn-primary btn-block" type="submit" name="userlogin" id="userlogin" value="'.LOGIN_MENU_L51.'">
				';

				$text .= '

				<a href="{LM_FPW_LINK=href}" class="btn btn-default btn-sm  btn-block">'.LOGIN_MENU_L4.'</a>
				<a href="{LM_RESEND_LINK=href}" class="btn btn-default btn-sm  btn-block">'.LOGIN_MENU_L40.'</a>
				';


				/*
				$text .= '
					<label style="text-align:center;margin-top:5px">or</label>
					<input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
					<input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
				';
				*/

				$text .= "<p></p>
				</form>
				</div>

				</li>
				";
				if(e107::isInstalled('voice'))
				{
					include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'.php');
					$text .='{VOICE_EXE}';
				}
				else
				{
					$text .="</ul>";
				}
			}
			return $tp->parseTemplate($text, true, $login_menu_shortcodes);
		}


		// Logged in.
		//TODO Generic LANS. (not theme LANs)

		$text = '

		<ul class="nav navbar-nav navbar-right'.$direction.'">
		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{SETIMAGE: w=20}{USER_AVATAR} '. USERNAME.' <b class="caret"></b></a>
		<ul class="dropdown-menu">
		<li>
			<a href="{LM_USERSETTINGS_HREF}"><span class="glyphicon glyphicon-cog"></span> Settings</a>
		</li>
		<li>
			<a class="dropdown-toggle no-block" role="button" href="{LM_PROFILE_HREF}"><span class="glyphicon glyphicon-user"></span> Profile</a>
		</li>
		<li class="divider"></li>';

		if(ADMIN)
		{
			$text .= '<li><a href="'.e_ADMIN_ABS.'"><span class="fa fa-cogs"></span> Admin Area</a></li><li class="divider"></li>';
		}

		$text .= '
		<li><a href="'.e_HTTP.'index.php?logout"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
		</ul>
		</li>
		';

		if(e107::isInstalled('voice'))
		{
			include_lan(e_PLUGIN.'voice/languages/'.e_LANGUAGE.'.php');
			$text .='{VOICE_EXE}';
		}
		else
		{
			$text .="</ul>";
		}


		return $tp->parseTemplate($text,true,$login_menu_shortcodes);
	}



}





?>
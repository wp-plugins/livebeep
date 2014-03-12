<?php

/*
Plugin Name: LiveBeep Chat
Plugin URI: http://www.livebeep.com
Description: LiveBeep.com Chat brings chat, offline email, and help desk features to your WordPress website.
Version: 1.0.2
Author: LiveBeep.com
Author URI: http://www.livebeep.com/
*/

define('LIVEBEEP_BASE_URL',     'https://www.livebeep.com/');
define('LIVEBEEP_TEXTDOMAIN', 	'livebeep');
define('LIVEBEEP_ICON', 		LIVEBEEP_BASE_URL.'images/smallicon.png');
define('LIVEBEEP_LOGIN_ACTION',	LIVEBEEP_BASE_URL.'client/login/');
define('LIVEBEEP_SIGNUP_URL', 	LIVEBEEP_BASE_URL.'es/signup/?cms=wordpress');

add_action('init', 'livebeep_init');
add_action('wp_footer', 'livebeep_script');

function livebeep_init() {
	load_plugin_textdomain( LIVEBEEP_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages' );
	if(function_exists('current_user_can') && current_user_can('manage_options')) {
        add_action('admin_menu', 'livebeep_create_menu');
    } 
}

function livebeep_create_menu() {
	add_menu_page('Account Configuration', 'LiveBeep Chat', 'administrator', 'livebeep_setup', 'livebeep_setup', LIVEBEEP_ICON );
}

function livebeep_setup() {
	
	$str =  '<div id="icon-options-general" class="icon32"><br/></div>
    		<h2>'.__('SetupTitle',LIVEBEEP_TEXTDOMAIN).'</h2>
			'.__('SetupDescription',LIVEBEEP_TEXTDOMAIN).'<br>
			<br>
			<div id="existingform">
				<div class="metabox-holder">
					<div class="postbox" style="width:600px;">
						<h3 class="hndle"><span>'.__('LoginTitle',LIVEBEEP_TEXTDOMAIN).'</span></h3>
						<div style="padding:20px;">
							<form method="post" action="'.LIVEBEEP_LOGIN_ACTION.'" target="_blank">
								<table class="form-table">
									<tr valign="top">
										<th scope="row">'.__('Username',LIVEBEEP_TEXTDOMAIN).'</th>
										<td><input type="text" name="username" value="" /></td>
									</tr>
									<tr valign="top">
										<th scope="row">'.__('Password',LIVEBEEP_TEXTDOMAIN).'</th>
										<td><input type="password" name="password" value="" /></td>
									</tr>
	 							</table>
								<div style="padding:10px 0px">
									<input type="submit" class="button-secondary" value="'.__('LoginAction',LIVEBEEP_TEXTDOMAIN).'" />
								</div>
							</form>
							<br>
							<div style="padding-top:15px;">
								'.__('SignupTitle',LIVEBEEP_TEXTDOMAIN).'
								<div style="padding:10px 0px">
									<a href="'.LIVEBEEP_SIGNUP_URL.'" target="_blank" data-popup="true">
										<input type="button" class="button-primary" value="'.__('SignupAction',LIVEBEEP_TEXTDOMAIN).'" />
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';

    echo $str;
}

function livebeep_script() {
    
	$str =  "<!-- LiveBeep - start script -->"."\n".
		    "<script type=\"text/javascript\">"."\n".
			   "try{"."\n".
			   "var _evU = (('https:' == document.location.protocol) ? 'https://' : 'http://') + 'www.livebeep.com/' + document.domain + '/eye.js';"."\n".
			   "if((_evH=document.location.href.split(/#ev!/)[1])) _evU += '?_e=' +_evH;"."\n".
			   "else if((_evR=/.*\_evV=(\w+)\b.*/).test(_evC=document.cookie) ) _evU += '?_v=' + _evC.replace(_evR,'$1');"."\n".
			   "document.write(unescape('%3Cscript src=\"' + _evU + '\" type=\"text/javascript\"%3E%3C/script%3E'));"."\n".
			   "} catch(e){}"."\n".
			"</script>"."\n".
			"<!-- LiveBeep - end script -->";

	echo $str;
}


?>
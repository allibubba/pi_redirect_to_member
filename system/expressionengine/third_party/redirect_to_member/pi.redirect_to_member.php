<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * redirect to member Plugin
 *
 * @package			ExpressionEngine
 * @subpackage	Addons
 * @category		Plugin
 * @author			Jackson Oates
 * @link				https://twitter.com/zeroninelab
 */

$plugin_info = array(
	'pi_name'		=> 'redirect to member',
	'pi_version'	=> '1.0',
	'pi_author'		=> 'Jackson Oates',
	'pi_author_url'	=> '',
	'pi_description'=> 'Redirect to url with memeber data',
	'pi_usage'		=> Redirect_to_member::usage()
);


class Redirect_to_member {

	public $return_data;
    
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();

		$url = array();
		$url['base'] = (ee()->TMPL->fetch_param('base_url')) ? ee()->TMPL->fetch_param('base_url') : '';
		$url['member'] = ($this->EE->session->userdata('username')) ? $this->EE->session->userdata('username') : '';
		$url['extra'] = (ee()->TMPL->fetch_param('extra')) ? ee()->TMPL->fetch_param('extra') : '';

		$login_path = (ee()->TMPL->fetch_param('login_path')) ? ee()->TMPL->fetch_param('login_path') : '/';
		

		if ( ! $this->EE->session->userdata('username'))
		{
			ee()->functions->redirect($login_path);
		} 
		elseif ($this->EE->session->userdata('username'))
		{
			$redirect = implode ( "/" , $url );
			ee()->functions->redirect("$redirect");
		}

	}
	
	// ----------------------------------------------------------------
	
	/**
	 * Plugin Usage
	 */
	public static function usage()
	{
		ob_start();
?>
-------------------
HOW TO USE
-------------------
{exp:redirect_to_member}

param (optional) = uri

base_url (optional) initial url segment
extra (optional) = segment after username
login_path (optional) = redirect if no logged in user detected


-------------------
EXAMPLE
-------------------

{if segment_2 == ""}
    {exp:redirect_to_member base_url="member" extra="success" login_path="/log_me_in"}
{/if}

redirects to "/member/<membername>/success" if logged in
redirects to "/log_me_in" if not logged in





<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}


/* End of file pi.redirect_to_member.php */
/* Location: /system/expressionengine/third_party/redirect_to_member/pi.redirect_to_member.php */
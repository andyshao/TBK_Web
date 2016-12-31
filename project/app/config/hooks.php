<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['cache_override'] = array(
                                'class'    => 'set_config',
                                'function' => 'set_path',
                                'filename' => 'set_config.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

/* End of file hooks.php */
/* Location: ./system/application/config/hooks.php */
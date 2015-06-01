<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
**
** The MIT License (MIT)
**
** Copyright (c) 2015 Lorenzo De Leon Alipio
**
** Permission is hereby granted, free of charge, to any person obtaining a copy
** of this software and associated documentation files (the "Software"), to deal
** in the Software without restriction, including without limitation the rights
** to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
** copies of the Software, and to permit persons to whom the Software is
** furnished to do so, subject to the following conditions:
** 
** The above copyright notice and this permission notice shall be included in all
** copies or substantial portions of the Software.
**
** THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
** IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
** FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
** AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
** LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
** OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
** SOFTWARE.
**
**
*/

require_once(APPPATH.'libraries/Twig/Autoloader.php');

Class CI_twig
{

    public function  __construct()
    {
    	date_default_timezone_set('America/Los_Angeles');
		
        $CI = get_instance();

        $CI->load->config('twig');
        
        if ( method_exists( $this, 'assignByRef') ){
            $ci =& get_instance();
            $this->assignByRef("ci", $ci);
        }

    }


    public function loadView($content=array(),$templateName = null)
	{
		Twig_Autoloader::register();
		
		try {
			    ## define template directory
				$themeDir = new Twig_Loader_Filesystem(config_item('theme_path_t'));
	 
				## initialize a new Twig environment
				$twig = new Twig_Environment($themeDir, array(
										'cache'       => config_item('cache_directory_t'),
									        'auto_reload' => config_item('auto_reload_t')
									     ));
	 
				## load template
				$theme = $twig->loadTemplate($templateName);
	 
				## We can set template variables and  render template as shown by the codes below
				echo $theme->render(array ('content'=>$content));
											
	 
		} catch (Exception $e) {
					die ('ERROR: ' . $e->getMessage());
				       }
		
		}
	
	
}	



/*
* end application/libraries/twig.php
*/

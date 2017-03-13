<?php defined('SYSPATH') or die('No direct script access.');

require Kohana::find_file('vendor', 'simplehtmldom/simple_html_dom'); 


class Controller_Localize extends Controller {


	
	public function action_index()
	{
		$url = $_GET['url'];
		// $url = 'http://visff.com/films/2016-2/';
			
		$html = file_get_html($url);
		
		// $title = $html->find('body', 0)->plaintext;

		echo $html;
	}


} // End Localize

<?php defined('SYSPATH') or die('No direct script access.');

require Kohana::find_file('vendor', 'simplehtmldom/simple_html_dom'); 


class Controller_Welcome extends Controller_Template {

	public $template = 'main';
	
	public function action_index()
	{
	
		$url = 'http://visff.com/films/2016-2/';
			
		$html = file_get_html($url);
		
		// $title = $html->find('body', 0)->plaintext;

		$this->template->page_original = $html;
	}


} // End Welcome

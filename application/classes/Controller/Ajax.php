<?php defined('SYSPATH') or die('No direct script access.');

require Kohana::find_file('vendor', 'simplehtmldom/simple_html_dom'); 


class Controller_Ajax extends Controller {

	public $template = 'blank';
	
	public function action_index()
	{
	
	}

	public function action_wpPreset(){
		$fields = array('post_title', 'post_content');

		echo json_encode($fields);
	}


} // End Localize

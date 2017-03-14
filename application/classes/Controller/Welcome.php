<?php defined('SYSPATH') or die('No direct script access.');

require Kohana::find_file('vendor', 'simplehtmldom/simple_html_dom'); 


class Controller_Welcome extends Controller_Template {

	public $template = 'main';
	
	public function action_index()
	{
		if(isset($_POST['scrape'])){
			foreach($_POST['vars'] as $key => $var){
				$var_array = json_decode($var);
				echo $key."<br>";
				echo "<pre>";
					print_r($var_array);
				echo "</pre>";
			}

			echo "<br>tracer_coordinates<br>";
			echo "<pre>";
				print_r(json_decode($_POST['tracer_coordinates']));
			echo "</pre>";

		
	
			$url = urldecode($_POST['page_url']);
			echo $url;
				
			// $html = file_get_html($url);

			$tracer_coordinates = json_decode($_POST['tracer_coordinates']);
			$first_el = $html->find('body', 0);
			$cur_pos = $first_el;
			foreach($tracer_coordinates as $v){
				

				echo $v->type_of." ".$v->index."<br>";


				// $cur_pos = $cur_pos->find()
			}
		
			

			//echo $html;
		}
		

		// $this->template->page_original = $html;
	}


} // End Welcome

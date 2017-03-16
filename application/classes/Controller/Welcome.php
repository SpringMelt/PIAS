<?php defined('SYSPATH') or die('No direct script access.');

require Kohana::find_file('vendor', 'htmLawed'); 


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
			echo "</pre><br>";

		
	
			$url = urldecode($_POST['page_url']);
			echo $url."<br>";
				
			// $html = new simple_html_dom();

			// // Load HTML from a URL 
			// $html->load_file($url);


			// $document = FluentDOM::load(
			//   $htmlFile, 
			//   'text/html', 
			//   [application\vendor\FluentDOM\Loader\Options::ALLOW_FILE => TRUE]
			// );

		 	$tracer_coordinates = json_decode($_POST['tracer_coordinates']);


		 	$html = file_get_contents($url);
			$tidy = htmLawed($html); 

			$doc = new DOMDocument;
			
			libxml_use_internal_errors(true);
			$doc->loadHTML($tidy);
			libxml_clear_errors();

			$xpath = new DOMXPath($doc);

			$tbody = $doc->getElementsByTagName('body')->item(0);

			

			// our query is relative to the tbody node
			$query = '';

			for($i=count($tracer_coordinates)-1; $i>=0; $i--){
				
				$query .= "/".$tracer_coordinates[$i]->type_of."[".($tracer_coordinates[$i]->index + 1) ."]";
				// $cur_pos->find($tracer_coordinates[$i]->type_of, $tracer_coordinates[$i]->index);
			}


			$entries = $xpath->query($query, $tbody);

			echo "<pre>";
				print_r($entries);
			echo "</pre>";

			// foreach ($entries as $entry) {
			//     echo "Found {$entry->previousSibling->previousSibling->nodeValue}," .
			//          " by {$entry->previousSibling->nodeValue}\n";
			// }




			// $body = new simple_html_dom(); 
			// $body->load($html->find("BODY",0)->plaintext);
			// $html->clear();
			// unset($html);


			

			
			// echo $body->plaintext;
			

		}
		
	}


} // End Welcome

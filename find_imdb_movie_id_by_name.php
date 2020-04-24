<?php 
/**
 * Plugin Name: Find Movie id By Name
 * Plugin URI: http://www.mywebsite.com/my-first-plugin
 * Description: This plugin is used to find imdb movie id by entering name of movie
 * Version: 1.0
 * Author: Mangal
 * Author URI: http://www.mywebsite.com
*/

function find_menu(){

	add_menu_page('Movie ID finder','Find Movie ID','manage_options','find-movie','find_movie_main','dashicons-search',5);
}
add_action('admin_menu','find_menu');

function find_movie_main(){

	echo "<form method=post > ";
	echo "<div class=wrap><h1> Find Movie ID By Name </h1><br>";
	echo "<label for=movie_name>Enter Movie Name : </label>";
	echo "<input type=text placeholder='Enter Movie Name' name=movie_name ></input>";
	echo "<input type=submit class='button-primary' name='find' >";
	echo "</form>";

	echo "</div>";

	if(isset($_POST['find']))
	{
		$name_ms = $_POST['movie_name'];
		$name_arr = explode(" ", $_POST['movie_name']);

		$movie_name = implode('+', $name_arr);

		$json = json_decode(file_get_contents('http://www.omdbapi.com/?t='.$movie_name.'&apikey=d59eb885'),true);

		echo "<h3> IMDB ID of Movie '".$_POST['movie_name']."' is ".substr($json["imdbID"], 2)."</h3>";

	}
	
}


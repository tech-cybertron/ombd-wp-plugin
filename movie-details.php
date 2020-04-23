<?php
/**
 * Plugin Name: Movie Details Fetcher
 * Plugin URI: http://www.mywebsite.com/my-first-plugin
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: Mangal
 * Author URI: http://www.mywebsite.com
*/


function movie_detail($atts){

$default = array(
        'movie' => '#',
    );
    $a = shortcode_atts($default, $atts);


$json = json_decode(file_get_contents('http://www.omdbapi.com/?i=tt'.$a['movie'].'&apikey=d59eb885'), true);
//$str = "<div class='card'> <img src = $json['Poster']> </div> ";

//$post–>post_category = $json["Category"];

$str = "<div >
	
		<center><img src=$json[Poster] height='102' width='202'></center><br>
	
	<div class=row>
		<div class=col-md-6>
			Movie Title : $json[Title]  
		</div>
	</div>
	<div class=row>
		<div class=col-md-6>
			Movie released on - $json[Released]
		</div>
	</div>
	<div class=row>
		<div class=col-md-6>
			Genre - $json[Genre]
		</div>
	</div>
	<div class=row>
		<div class=col-md-6>
			Director - $json[Director]
		</div>
	</div>
	<div class=row>
		<div class=col-md-6>
		Actors - $json[Actors]
		</div>
	</div>
	<div class=row>
		<div class=col-md-6>
			Plot - $json[Plot]
		</div>
	</div>
</div>";

if(count($json) > 2)
    return $str;
else
	return "<center>No detials of that id </center>";


       // $curl=curl_init();
       // curl_setopt($curl, CURLOPT_URL,'http://www.omdbapi.com/?i=tt1540133&apikey=d59eb885');
       // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       // $jso = curl_exec($curl);
       // curl_close($curl);
        
        //$json = json_decode($jso, true); //This will convert it to an array
      //  $movie_title = $json['Title'];
       // return $movie_title;
}
add_shortcode('Movie', 'movie_detail');

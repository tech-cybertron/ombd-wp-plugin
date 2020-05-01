// This code should be written inside activated theme's function.php page

// function to create metabox
function movie_meta_box() {

    add_meta_box(
        'movie-finder',
        'Movie Finder',
        'movie_finder_meta_box_callback',
		'post',
		'side',
		'default'
    );
}

add_action( 'add_meta_boxes', 'movie_meta_box' );

function movie_finder_meta_box_callback() {

  //output to meta box

	echo "<form method=post > ";
	echo "<div class=wrap>";
	echo "<label for=movie_name>Enter Movie Name : </label>";
	echo "<input type=text placeholder='Enter Movie Name' id='mn2' name=movie_name ></input>";
	echo "<input type='button' class='button-primary' name='find' value='find' onclick='ok()' ><br>";
	echo "<div  id='moviedetail'><div class=container><h3 id=movietitle></h3><p id=movieactors></p></div></div><br>";
  echo "<input type=text id='txtval'></input><hr>";
  echo "<input type='button' onclick='myFunction()' value='Copy Short Code' ></input>";
  echo "</form>";
  echo "</div>";
  
  echo "<style>
	.card {
	  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
	  transition: 0.3s;
	  width: 40%;
	}
	
	.card:hover {
	  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}
	
	.container {
	  padding: 2px 16px;
	}
	</style>";
  
	echo "<script>";
  
    echo 'function ok(){
        var va = document.getElementById("mn2").value;
        var res = va.split(" ");
		    var name = res.join("+");
        var arr = httpGet("http://www.omdbapi.com/?t="+name+"&apikey=d59eb885");
		    var arrVal = JSON.parse(arr);
		
        if(arrVal["imdbID"]){

          var id = arrVal["imdbID"].substring(2);
          var imgdet = document.getElementById("moviedetail");
          imgdet.classList.add("card");
          var x = document.createElement("IMG");
          x.setAttribute("src", arrVal["Poster"]);
          x.setAttribute("width", "200");
          x.setAttribute("height", "150");
          x.setAttribute("alt", "No image available");
          imgdet.appendChild(x);
          document.getElementById("movietitle").innerHTML = "Title : "+ arrVal["Title"];
          document.getElementById("movieactors").innerHTML = "Actors/Actress : "+arrVal["Actors"];

          document.getElementById("txtval").value = "[Movie movie="+id+"]";
      }

      if(arrVal["imdbID"] == undefined){
        document.getElementById("txtval").value = "No movie details";
      }
    }';

    echo "function httpGet(theUrl)
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open( 'GET', theUrl, false ); // false for synchronous request
        xmlHttp.send( null );
        return xmlHttp.responseText;
    }";
    echo "function myFunction() 
    {
      var copyText = document.getElementById('txtval');

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand('copy');

      /* Alert the copied text */
      alert('Copied the text: ' + copyText.value);
    }";
    
 echo "</script>";
}

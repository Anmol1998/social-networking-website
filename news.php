<?php
	$news_url='https://newsapi.org/v1/articles?source=techcrunch&sortBy=latest&apiKey=a2c6edc8a62846be9bb57563d26e0ebf';
	$news_json=file_get_contents($news_url);
	$news_array=json_decode($news_json);
?>
<html>
<title>News</title>
<body>
<link rel="stylesheet" href="cssr/materialize.min.css">
<script src="js1/jquery-2.1.1.min.js"></script>
<script src="js1/materialize.min.js"></script>
<nav>
    <div class="nav-wrapper black">
      <div style="margin-left:20px"><a href="#" class="brand-logo">LNO2</a></div>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="home.html">Home</a></li>
        <li><a href="interestpage.html">Other Interests</a></li>
      </ul>
    </div>
  </nav>
  <div id="results" data-url="<?php if (!empty($url)) echo $url ?>">
  <?php
	if(!empty($news_array)){
			$countn=count($news_array->articles);
			
			echo'<div class="row">';
			foreach($news_array->articles as $item){
			$item->title=filter_var($item->title,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
			$item->description=filter_var($item->description,FILTER_SANITIZE_STRING,FILTER_FLAG_ENCODE_LOW);
			echo 
			' 
				<div class="card col s3 m3 l3 offset-s1 offset-m1 offset-l1">
					<div card="medium">
						<div class="card-image waves-effect waves-block waves-light">
							<img class="activator" src='.$item->urlToImage.'>
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4">'.$item->title.'<i class="material-icons right">more_vert</i></span>
							<p>'.$item->description.'<a href="'.$item->url.'">...</a></p>
						</div>
					</div>
				</div>';
		}
		echo '</div>';
	}
		
  ?>
 </div>
<footer class="page-footer black">
          <div class="container">
            <div class="row">
                <p class="grey-text text-lighten-4 center">Developed and Created by</p>
        <p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
            </div>
          </div>
          
        </footer>
            
            
</body>
</html>
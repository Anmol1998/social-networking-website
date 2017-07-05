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
  <div id="results" class="container" data-url="<?php if (!empty($url)) echo $url ?>">
  <?php
	if(!empty($news_array)){
		$i=0;
		foreach($news_array->articles as $item){
			$item->title=filter_var($item->title,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
			$item->description=filter_var($item->description,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
			if($i%2==0){
				echo'<div class="row">';
			}
				echo 
					'<div class="card col s6 m6 l6">
						<div card="medium">
							<div class="card-image waves-effect waves-block waves-light">
								<img class="activator" src='.$item->urlToImage.'>
							</div>
							<div class="card-content" style="height:25%; overflow-y:hidden">
								<span class="card-title activator grey-text text-darken-4"><a href="'.$item->url.'">'.$item->title.'</a></span>
								<p>'.$item->description.'</a></p>
							</div>
						</div>
					</div>';
			$i=$i+1;
			if($i%2==0){
				echo'</div>';
			}
		}
	}
		
  ?>
 </div>
<footer class="page-footer black">
          <div class="container">
            <div class="row" style="margin-bottom:0px">
                <p class="grey-text text-lighten-4 center">Developed and Created by</p>
        <p class="grey-text text-lighten-4 center">Indian Society for Technical Education - VITU Chapter</p>
		    <p class="grey-text text-lighten-4 center">News powered by <a href="newsapi.org">NEWSAPI</a>.</p>
            </div>
          </div>
          
        </footer>
            
            
</body>
</html>

<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->start('top_two_col');
?>
<script>
function hndlr(response) {
  var contentDiv = document.getElementById("booms-container");

  contentDiv.innerHTML = '<h3 class="title-flag">Resultados</h3>';
  contentDiv.className = contentDiv.className + "search";

  var newResultsDiv = document.createElement('div');
  newResultsDiv.id = 'booms-container';

  for (var i = 0; i < response.items.length; i++) {
    var item = response.items[i];

    var resultHTML = '<div class="boom">';
    if (typeof( item.pagemap ) == "object" ) {
      var image = item.pagemap.cse_thumbnail && item.pagemap.cse_thumbnail[0].src || item.pagemap.cse_image[0].src.replace('http://www.7boom.mxhttp', 'http'); //wtf google?

	image = typeof(image) !== 'undefined' ? "<img src='" + image + "'/>" : '';

      resultHTML += '<a href="' + item.link + '">'+ image +'</a><div class="boom-info"><p class="boom-ti cf"><a href="'
        + item.link + '">' + item.title + '</a></p><p class="src-snip">' + item.snippet + '</p></div></div>';
    } else {
      resultHTML += '<div class="boom-info"<p class="boom-ti"><a href="'
        + item.link + '">' + item.title + '</a></p><p class="src-snip">' + item.snippet + '</p></div></div>';
    }

    newResultsDiv.innerHTML += resultHTML;
  }
  contentDiv.appendChild(newResultsDiv);
}

</script>
<script src="<?php echo $url ?>?key=<?php echo $key ?>&cx=<?php echo $cx ?>&q=<?php echo urlencode($query) ?>&callback=hndlr">
</script>

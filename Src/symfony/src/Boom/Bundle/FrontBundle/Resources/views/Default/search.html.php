<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->start('top_two_col');
?>
<script>
function hndlr(response) {
  var contentDiv = document.getElementById("booms-container");

  contentDiv.innerHTML = '';
  console.log(response);

  var newResultsDiv = document.createElement('div');
  var titleFlag = '<h3 class="title-flag">Resultados</h3>';
  newResultsDiv.id = 'booms-container';

  for (var i = 0; i < response.items.length; i++) {
    var item = response.items[i];

    var resultHTML = '<div class="boom">';
    if( typeof(item.pagemap.cse_thumbnail) == "object" ) {
      resultHTML += '<a href="http://' + item.formattedUrl + '"><img src="' + item.pagemap.cse_thumbnail[0].src + '"/></a><div class="boom-info"<p class="boom-ti"><a href="http://'
        + item.formattedUrl + '">' + item.title + '</a></p><p class="src-snip">' + item.snippet + '</p></div></div>';
      console.log(item.pagemap.cse_thumbnail[0].src);
    } else {
      resultHTML += '<div class="boom-info"<p class="boom-ti"><a href="http://'
        + item.formattedUrl + '">' + item.title + '</a></p><p class="src-snip">' + item.snippet + '</p></div></div>';
    }

    newResultsDiv.innerHTML += resultHTML;
  }
  contentDiv.insertBefore(titleFlag, this.firstChild);
  contentDiv.appendChild(newResultsDiv);
}

</script>
<script src="<?php echo $url ?>?key=<?php echo $key ?>&cx=<?php echo $cx ?>&q=<?php echo urlencode($query) ?>&callback=hndlr">
</script>

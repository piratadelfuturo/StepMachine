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
  newResultsDiv.id = 'booms-container';

  for (var i = 0; i < response.items.length; i++) {
    var item = response.items[i];

    var resultHTML = '<div class="boom">';
    resultHTML += '<a href="' + item.formattedUrl + '">' + item.pagemap + '</a><div class="boom-info"<p class="boom-ti"><a href="'
      + item.formattedUrl + '">' + item.title + '</a></p><p class="src-snip">' + item.snippet + '</p></div></div>';

    newResultsDiv.innerHTML += resultHTML;
  }
  contentDiv.appendChild(newResultsDiv);
}

</script>
<script src="<?php echo $url ?>?key=<?php echo $key ?>&cx=<?php echo $cx?>&q=<?php echo urlencode($query) ?>&callback=hndlr">
</script>

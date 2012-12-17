<?php
$view->extend('BoomFrontBundle::two_col_sublayout.html.php');
$view['slots']->start('top_two_col');
?>
<script>
    function hndlr(response) {
        for (var i = 0; i < response.items.length; i++) {
            var item = response.items[i];
            // in production code, item.htmlTitle should have the HTML entities escaped.
            document.getElementById("booms-container").innerHTML += "<br>" + item.htmlTitle;
        }
    }
</script>
<script src="<?php echo $url ?>?key=<?php echo $key ?>&cx=<?php echo $cx?>&q=<?php $query ?>&callback=hndlr">
</script>
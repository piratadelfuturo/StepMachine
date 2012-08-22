<?php
$elements = array();
foreach($entity['elements'] as $el){
    $position = $el['communityposition'] == 0 ? $el['position'] : $el['communityposition'];
    $elements[$position] = $el;
}
?>

<div id="usr-booms">
      <div class="botones">
        <a href="#"><span class="on" id="tendencia">Tendencias</span></a>
        <a href="#"><span id="miboom">Mi Boom</span></a>
      </div>
      <h3>nuestros usuarios dicen</h3>
      <ul id="drag-booms">
          <?php foreach($elements as $elementPosition => $element): ?>
        <li>
          <span class="pos"><p><?php echo $elementPosition ?></p></span>
          <img src="http://placehold.it/72x72">
          <span class="boom-info">
            <h4><?php echo $element['title'] ?></h4>
          </span>
        </li>
        <?php endforeach; ?>
      </ul>
      <a href="#"><span id="editalo">
        <p>¿Estás de acuerdo?</p>
        <p>¡edítalo!</p>
      </span></a>
    </div>
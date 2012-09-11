<?php
$elements = array();
foreach($entity['elements'] as $el){
    $position = $el['communityposition'] == 0 ? $el['position'] : $el['communityposition'];
    $elements[$position] = $el;
}
?>

<div id="usr-booms">
      <div class="botones">
        <a href="#" class="on" id="tendencia">Tendencias</a>
        <span class="divider">divider</span>
        <a href="#" id="miboom">Mi Boom</a>
        <span class="arrow">Recomendados</span>
      </div>
      <h3>nuestros usuarios dicen</h3>
      <ul id="drag-booms">
          <?php foreach($elements as $elementPosition => $element): ?>
        <li>
          <div class="balloon">
            <p>Arrastrar</p>
          </div>
          <p class="pos"><span><?php echo $elementPosition ?></span></p>
          <img src="http://placehold.it/72x72">
          <span class="boom-info">
            <h4><?php echo $element['title'] ?></h4>
          </span>
        </li>
        <?php endforeach; ?>
      </ul>
      <a href="#" id="editalo">¿Estás de acuerdo?<span>¡edítalo!</span></a>
    </div>

<div class="boomer ultimos">
        <h3 class="title-flag"><span>ultimos</span></h3>
        <ul class="list">
          <?php foreach($list as $element): ?>
            <li class="boom">
            <img src="<?php echo $element['image_path'] ?>">
            <div class="boom-info">
              <span class="sm-flag <?php echo $element['category_slug'] ?>"><?php echo $view->escape($element['category_name']) ?></span>
              <p class="boom-ti">
                  <a href="<?php echo $view['router']->generate('BoomFrontBundle_boom_show',array('slug' => $element['boom_slug'])) ?>" class="boom-moar">
                      <?php echo $view->escape($element['boom_title']); ?>
                  </a>
              </p>
              <a href="<?php echo $view['router']->generate('BoomFrontBundle_boom_show',array('slug' => $element['boom_slug'])) ?>" class="boom-moar">
                  <?php echo $view->escape(
                          !empty($element['user_nickname']) || is_null($element['user_nickname']) ? $element['user_username'] : $element['user_nickname']
                          ) ?>
              </a>
              <date><?php echo $view->escape($element['boom_date_created']->format('D, d M y')) ?></date>
            </div>
            </li>
         <?php endforeach; ?>
          <a href="#"><span class="moar">ver más</span></a>
        </ul>
      </div>
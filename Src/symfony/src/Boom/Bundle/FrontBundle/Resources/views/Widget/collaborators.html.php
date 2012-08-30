      <div class="colab-wdgt sb-bloque">
        <h3><span>colaboradores</span></h3>
        <ul>
        <?php
            $collaborators = $view['boom_front']->getLatestCollaborators();
            foreach($collaborators as $index => $collaborator):
        ?>
          <li class="<?php echo ($index+1) % 2 == 0 ? 'grey' : '' ?>">
            <a href="<?php echo $view['router']->generate('BoomFrontBundle_slug_show',array('slug' => $collaborator['category_slug'].'/'.$collaborator['boom_slug']))?>">
                <img src="<?php echo $collaborator['user_record']['imagepath'] ?>" height="60px" width="60px" />
                <h4 class="autor"><?php  echo $collaborator['user_record']['lastname'].' '.$collaborator['user_record']['firstname'] ?></h4>
                <p class="last-boom"><?php echo $collaborator['boom_title']?></p>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
        <a href="<?php echo $view['router']->generate('BoomFrontBundle_user_collaborators'); ?>"><span class="ver-all"><p>Ver todos<p></span></a>
      </div>

<div class="colab-wdgt sb-bloque">
    <h3>colaboradores</h3>
    <ul>
        <?php
        $collaborators = $view['boom_front']->getLatestCollaborators();
        foreach ($collaborators as $index => $collaborator):
            ?>
            <li class="<?php echo ($index + 1) % 2 == 0 ? 'grey' : '' ?>">
                <a href="<?php
        echo $view['router']->generate(
                'BoomFrontBundle_user_profile', array(
            'username' => $collaborator['user_record']['username']))
            ?>">
                    <img src="<?php echo $collaborator['user_record']['imagepath'] ?>" height="60px" width="60px" />
                </a>
                <h4 class="autor">
                  <a href="<?php
                  echo $view['router']->generate(
                          'BoomFrontBundle_user_profile', array(
                      'username' => $collaborator['user_record']['username']))
                      ?>">
                    <?php echo $collaborator['user_record']['firstname'] . ' ' . $collaborator['user_record']['lastname'] ?>
                </a>
                </h4>
                    <p class="last-subtitle">Último Boom:</p>
                    <p class="last-boom">
                        <a href="<?php
               echo $view['router']->generate(
                       'BoomFrontBundle_boom_show', array(
                   'category_slug' => $collaborator['category_slug'],
                   'slug' => $collaborator['boom_slug']))
            ?>">
                           <?php echo $collaborator['boom_title'] ?>
                    </a>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="ver-all"><a href="<?php echo $view['router']->generate('BoomFrontBundle_user_collaborators'); ?>">Ver todos</a></div>
</div>

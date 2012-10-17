<?php
$User = $app->getUser();
?>
<header>
    <div id="logo">
        <a href="">Logo Here</a>
    </div>
    <div id="header">
        <ul id="headernav">
            <li>
                <ul>
                    <li><a href="#"><?php echo $User->getUsername() ?></a>
                        <?php $score = rand(2, 11) ?>
                        <span><?php echo $score ?></span>
                        <ul>
                            <li><a href="#">Score: <?php echo $score ?></a></li>
                        </ul>
                    </li>
                    <?php foreach ($view['session']->getFlashBag()->get('notice') as $message): ?>
                    <li>
                            <div class="alert note">
                                <?php $this->get('session')->setFlash('notice', 'Boom guardado!'); ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
        <!--
        <div id="searchbox">
            <form id="searchform" autocomplete="off">
                <input type="search" name="query" id="search" placeholder="Search">
            </form>
        </div>
        <ul id="searchboxresult">
        </ul>
    </div> -->
</header>
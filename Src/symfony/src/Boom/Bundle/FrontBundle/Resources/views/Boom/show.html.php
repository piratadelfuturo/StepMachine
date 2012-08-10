<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php
$sidebar = $view->render('BoomFrontBundle:Boom:blocks/userOrder.html.php');
$view['slots']->set('sidebar_top',$sidebar);
?>

<div class="musica" id="single-boom">
        <h3 class="title-flag"><span>cine</span></h3>
        <img src="http://placehold.it/680x382">
        <div class="boom-info">
          <h2><?php echo $view->escape($entity['title']) ?></h2>
          <p><?php echo $view['bbcode']->filter($entity['summary'],'default') ?></p>
          <a class="boom-moar" href="#">Publicado el <date>22 de enero 2011</date></a>
        </div>
        <div class="social">
          <span class="comparte">comparte:
            <a href="#"><span class="btn-fb">facebook</span></a>
            <a href="#"><span class="btn-tw">twitter</span></a>
          </span>
          <span class="fav">marcar como favorito:
            <a href="#"><span class="btn-fav">fav</span></a>
          </span>
        </div>
        <div class="autor">
          <img src="http://placehold.it/85x85">
          <span>
            <h3>Publicado por <a rel="author" href="#">Elver Galarga</a></h3>
            <p>Phillip k. Dick es un escritor de California. Su literatura está influenciada por la narrativa policiaca de Raymond Chandler y los textos futuristas de William Gibson. K. Dick es quizá el autor más adaptado al cine...<a class="ver-moar" href="#">Leer más</a></p>
          </span>
        </div>
        <div class="booms">
          <ul>
            <li class="boom on">
              <div class="place-info">
                <span class="place">7</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dolor blabla bla blaLorem ipsum dolor blabla bla bla Lorem ipsum dolor blabla bla bla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
            <li class="boom">
              <div class="place-info">
                <span class="place">6</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dolor blabla bla blaLlor blabla bla bla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
            <li class="boom">
              <div class="place-info">
                <span class="place">5</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dolor blabla bla blaLorem ipsum dolor blabla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
            <li class="boom">
              <div class="place-info">
                <span class="place">4</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dor blabla bla bla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
            <li class="boom">
              <div class="place-info">
                <span class="place">3</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dolor blabla bla blaLorem ipsum dolor blabla bla bla Lorem ipsum dolor blabla bla bla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
            <li class="boom">
              <div class="place-info">
                <span class="place">2</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dolor blabla bla blaLorem ipsum dolor blabla bla bla Lorem ipsum dolor blabla bla bla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
            <li class="boom">
              <div class="place-info">
                <span class="place">1</span>
                <img src="http://placehold.it/151x86">
                <p class="boom-ti">Lorem ipsum dolor blabla bla blaLorem ipsum dolor blabla bla bla Lorem ipsum dolor blabla bla bla</p>
              </div>
              <div class="boom-content">
                <img src="http://placehold.it/285x285">
                <p>Take Care is the second studio album by <a href="#">Canadian</a> recording artist Drake, released November 15, 2011, on Young Money Entertainment and Cash Money Records.[1][2] It is the follow-up to his 2010 debut album Thank Me Later. Production for the album took place during 2010 to 2011 and was handled by Noah "40" Shebib, Boi-1da, T-Minus, Just Blaze, The Weeknd, and Jamie xx, among others. With the album, Drake sought to record a more cohesive recording than his debut album, which he viewed was rushed in its development.</p>
                <p>Expanding on the sonic aesthetic of his debut album, Take Care features an atmospheric sound that is characterized by low-key musical elements and incorporates R B, pop, and electronica styles. Drake's lyrics mostly eschew boastful raps for introspective lyrics that deal with topics such as failed romances, relationship with friends and family, growing wealth and fame, concerns about leading a hollow life, and despondency. The album has been noted by music writers for its minimalist R&amp;B elements, existential subject matter, conflicted lyrics, and Drake's alternately sung and rapped vocals.</p>
                <div class="comments">FB COMMENTS</div>
              </div>
              <span class="tab"><a href=""><span>TAB</span></a></span>
            </li>
          </ul>
          <div class="boom-tags"><p>Tags: <a href="#">Tag</a>, <a href="#">Tag</a>, <a href="#">Tag</a>, <a href="#">Tag</a>, <a href="#">Tag</a></p></div>
          <div class="social">
            <span class="comparte">comparte:
              <a href="#"><span class="btn-fb">facebook</span></a>
              <a href="#"><span class="btn-tw">twitter</span></a>
            </span>
            <span class="fav">marcar como favorito:
              <a href="#"><span class="btn-fav">fav</span></a>
            </span>
          </div>
          <div class="boom-nav">
            <a href="#"><span class="prv-boom">Boom Anterior</span></a>
            <a href="#"><span class="nxt-boom">Siguiente Boom</span></a>
          </div>
        </div>
      </div>
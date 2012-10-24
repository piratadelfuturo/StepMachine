<?php $view->extend('BoomFrontBundle::two_col_sublayout.html.php') ?>
<?php $view['slots']->set('layout_container_css_class','colaboradores'); ?>

<div class="profile">
  <div class="author-profile">
    <h3 class="title-flag">Perfil</h3>
    <div class="author-info cf">
      <img src="http://placekitten.com/147/147">
      <h4>Phillip K. Dick</h4><p class="boom-n">(20 Booms)</p>
      <ul>
        <li><a href="#" class="btn-fb">facebook</a><a href="#">Phillip K. Dick</a></li>
        <li><a href="#" class="btn-tw">twitter</a><a href="#">@PhillipKDick</a></li>
      </ul>
      <a href="#" class="seguir">seguir</a>
    </div>
    <p class="author-bio">Phillip k. Dick es un escritor de California. Su literatura está influenciada por la narrativa policiaca de Raymond Chandler y los textos futuristas de William Gibson. K. Dick es quizá el autor más adaptado al cine (después de julio Verne, o Shakespeare, la verdad no sé, no investigué nada para este texto) con títulos como Blade Runner, Minority Report, On Call y muchas otras películas mierda basadas en libros geniales y bien escritos.</p>
  </div>
</div>

<?php if ($total > $limit):
    $pagination = $view['boom_pagination']->paginationValues($page,$total);
    var_dump($pagination);
endif;
?>


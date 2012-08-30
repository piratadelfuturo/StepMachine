<?php $view->extend('BoomBackBundle::layout.html.php') ?>
<h1>Boom</h1>
<table class="record_properties">
    <tbody>
        <tr>
            <th>Id</th>
            <td><?php echo $entity['id'] ?></td>
        </tr>
        <tr>
            <th>Slug</th>
            <td><?php echo $entity['slug'] ?></td>
        </tr>
        <tr>
            <th>Title</th>
            <td><?php echo $entity['title'] ?></td>
        </tr>
        <tr>
            <th>Summary</th>
            <td><?php echo $view['bbcode']->filter($entity['summary'],'default'); ?></td>
        </tr>
        <tr>
            <th>Date_created</th>
            <td><?php echo $entity['datecreated']  instanceof \DateTime ? $entity['datecreated']->format('Y-m-d H:i:s') : '' ?></td>
        </tr>
        <tr>
            <th>Date_published</th>
            <td><?php echo $entity['datepublished'] instanceof \DateTime ? $entity['datepublished']->format('Y-m-d H:i:s') : '' ?></td>
        </tr>
        <tr>
            <th>Nsfw</th>
            <td><?php echo $entity['nsfw'] ?></td>
        </tr>
    </tbody>
</table>

<ul class="record_actions">
    <li>
        <a href="<?php echo $view['router']->generate('BoomBackBundle_boom_edit',array('id' => $entity['id']))?>">
            Editar
        </a>
    </li>
    <li>
        <form action="<?php echo $view['router']->generate('BoomBackBundle_boom_delete',array('id' => $entity['id'])) ?>" method="post">
            <?php echo $view['form']->widget($delete_form['id']); ?>
            <button type="submit">Delete</button>
        </form>
    </li>
</ul>
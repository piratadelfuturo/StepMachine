<fieldset <?php echo $view['form']->block($form, 'widget_container_attributes') ?>>
    <?php echo $view['form']->label($form,$label,array('label_attr' => $label_attr)) ?>
    <div>
        <?php if (!$form->parent && $errors): ?>
    <tr>
        <td colspan="2">
            <?php echo $view['form']->errors($form) ?>
        </td>
    </tr>
    <?php endif ?>
    <?php echo $view['form']->block($form, 'form_rows') ?>
    <?php echo $view['form']->rest($form) ?>
    </div>
</fieldset>

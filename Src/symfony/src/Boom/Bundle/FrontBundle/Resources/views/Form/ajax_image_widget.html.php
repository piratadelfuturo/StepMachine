<?php
$inputAttr = array('attr' => $parameters['attr']);
if (!isset($inputAttr['attr']['upload-path'])) {
    $inputAttr['attr']['upload-path'] = $view['router']->generate(
            'BoomFrontBundle_image_ajax_create', array(
        'path' => $form['file']->get('full_name'),
        'w' => 158,
        'h' => 90)
    );
}
?>
<img id="<?php echo $parameters['id'] . '_img' ?>"src="<?php echo $data['path'] === null ? '' : $view['boom_image']->getBoomImageUrl($data['path'], 158, 90) ?>" />
<?php echo $view['form']->widget($form['id']) ?>
<?php echo $view['form']->widget($form['file'], $inputAttr) ?>
<?php
$nav = array();
$nav[] = array(
    '_route' => 'BoomBackBundle_homepage',
    'class' => 'i_house',
    'text' => 'Dashboard',
);
$nav[] = array(
    '_route' => 'BoomBackBundle_boom_index',
    'class' => 'i_create_write',
    'text' => 'Booms',
);
?>
<nav>
    <ul id="nav">
        <!--
        <li class="i_book"><a><span>Documentation</span></a>
            <ul>
                <li><a href="doc-alert.html"><span>Alert Boxes</span></a></li>
                <li><a href="doc-breadcrumb.html"><span>Breadcrumb</span></a></li>
                <li><a href="doc-calendar.html"><span>Calendar</span></a></li>
                <li><a href="doc-charts.html"><span>Charts</span></a></li>
                <li><a href="doc-dialog.html"><span>Dialog</span></a></li>
                <li><a href="doc-editor.html"><span>Editor</span></a></li>
                <li><a href="doc-file.html"><span>File</span></a></li>
                <li><a href="doc-fileexplorer.html"><span>Fileexplorer</span></a></li>
                <li><a href="doc-form.html"><span>Form</span></a></li>
                <li><a href="doc-gallery.html"><span>Gallery</span></a></li>
                <li><a href="doc-inputfields.html"><span>Inputfields</span></a></li>
                <li><a href="doc-slider.html"><span>Slider</span></a></li>
                <li><a href="doc-store.html"><span>Store</span></a></li>
                <li><a href="doc-widget.html"><span>Widget</span></a></li>
            </ul>
        </li>
        -->
        <?php foreach ($nav as $n): ?>
            <li class="<?php echo $n['class'] ?>">
                <a href="<?php echo $view['router']->generate($n['_route']) ?>" class="<?php echo $view['request']->getParameter('_route') == $n['_route'] ? 'active' : '' ?>"><span><?php echo $n['text'] ?></span></a>
            </li>
        <?php endforeach; ?>
        <li class="i_image"><a><span>Home</span></a>
            <ul>
                <li><a href="doc-alert.html"><span>Alert Boxes</span></a></li>
                <li><a href="doc-breadcrumb.html"><span>Breadcrumb</span></a></li>
            </ul>
        </li>
        <li class="i_image"><a href="charts.html"><span>Imagenes</span></a></li>
        <li class="i_images"><a href="gallery.html"><span>Galerías</span></a></li>
        <li class="i_folder"><a><span>Categorías</span></a>
            <ul>
                <li><a href="doc-alert.html"><span>Alert Boxes</span></a></li>
                <li><a href="doc-breadcrumb.html"><span>Breadcrumb</span></a></li>
                <li><a href="doc-calendar.html"><span>Calendar</span></a></li>
                <li><a href="doc-charts.html"><span>Charts</span></a></li>
                <li><a href="doc-dialog.html"><span>Dialog</span></a></li>
                <li><a href="doc-editor.html"><span>Editor</span></a></li>
                <li><a href="doc-file.html"><span>File</span></a></li>
                <li><a href="doc-fileexplorer.html"><span>Fileexplorer</span></a></li>
                <li><a href="doc-form.html"><span>Form</span></a></li>
                <li><a href="doc-gallery.html"><span>Gallery</span></a></li>
                <li><a href="doc-inputfields.html"><span>Inputfields</span></a></li>
                <li><a href="doc-slider.html"><span>Slider</span></a></li>
                <li><a href="doc-store.html"><span>Store</span></a></li>
                <li><a href="doc-widget.html"><span>Widget</span></a></li>
            </ul>

        </li>
        <li class="i_tags"><a href="breadcrumb.html"><span>Tags</span></a></li>
        <li class="i_v-card"><a href="breadcrumb.html"><span>Usuarios</span></a></li>
        <li class="i_calendar_day"><a href="calendar.html"><span>Calendar</span></a></li>
    </ul>
</nav>
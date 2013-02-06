<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
<channel>
  <title><?php echo $view->escape($view['slots']->get('title', '')) ?></title>
  <link><?php echo $view->escape($view['slots']->get('link', '')) ?></link>
  <description><?php echo $view->escape($view['slots']->get('description', '')) ?></description>
        <?php $view['slots']->output('_content') ?>
</channel>
</rss>
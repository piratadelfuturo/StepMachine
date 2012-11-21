<?php
echo '<?xml version="1.0" encoding="UTF-8"?>';
/*
echo '<?xml-stylesheet type="text/xsl" href="';
echo $view['assets']->getUrl('/bundles/boomfront/gss/gss.xsl');
echo '"?>';
 */
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($urls as $url): ?>
        <url>
            <loc>http://<?php echo $hostname . $url['loc'] ?></loc>
            <?php if (isset($url['lastmod'])): ?>
                <lastmod><?php echo $url['lastmod'] ?></lastmod>
            <?php endif; ?>
            <?php if (isset($url['changefreq'])): ?>
                <changefreq><?php echo $url['changefreq'] ?></changefreq>
            <?php endif; ?>
            <?php if (isset($url['priority'])): ?>
                <priority><?php echo $url['priority'] ?></priority>
            <?php endif; ?>
        </url>
    <?php endforeach; ?>
</urlset>
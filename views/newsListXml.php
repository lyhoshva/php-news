<?php

/**
 * @var $this \App\View
 * @var $newsList \App\NewsModel[]
 */
?>
<?xml version="1.0" encoding="utf-8"?>

<list>
    <?php foreach ($newsList as $news) : ?>
        <item id="<?= $news->id ?>" date="<?= $news->creation_date ?>">
            <announce><?= $news->short_text ?></announce>
            <description><?= $news->full_text ?></description>
        </item>
    <?php endforeach; ?>
</list>

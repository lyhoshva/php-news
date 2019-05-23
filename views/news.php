<?php
/**
 * @var $this \App\View
 * @var $news \App\NewsModel
 * @var $newsList \App\NewsModel[]
 */
?>

<html>
<head>
</head>
<body>
<article>
    <h1>Section of news #<?= $news->id ?></h1>
    <time datetime="<?= $news->creation_date ?>"><?= $news->creation_date ?></time>
    <p><?= $news->full_text ?></p>
</article>
<div>
    <h2>Block with list of articles</h2>
    <?= $this->render('_newsListPartial', [
        'newsList' => $newsList,
    ]) ?>
</div>
</body>
</html>


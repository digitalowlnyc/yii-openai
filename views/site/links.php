<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <ul>
        <li><a href="index.php?r=api%2Fcall">Call OpenAPI (raw)</a></li>
        <li><a href="index.php?r=api%2Findex">Ask OpenAPI (form)</a></li>
    </ul>
</div>

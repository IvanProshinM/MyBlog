<?php

/**
 * @var $model app\models\Post;
 */
?>


<?php foreach ($model as $value): ?>
        <?= $value->id ?>
        <?= $value->name ?>

<? endforeach; ?>
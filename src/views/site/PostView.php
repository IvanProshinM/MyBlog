<?php

use yii\helpers\Html;
use vova07\imperavi\Widget;

/**
 * @var app\models\Post $model ;
 * @var app\models\CommentsForm $commentsForm ;
 * @var app\models\Comments $commentsModel ;
 * @var $form yii\widgets\ActiveForm
 */

$id = $model->id;

$this->registerCssFile("@web/css/postItem.css");
$this->registerCssFile("@web/css/postView.css");

?>

<div class="post-item">

</div>


<table>
    <tr>
        <td class="post-item_name">
            <?= $model->name ?>
        </td>
    </tr>
    <tr>
        <th>Категории</th>
    </tr>
    <tr>
        <td><?php
            $category = $model->categories;
            $result = [];
            foreach ($category as $key => $value)
                $result[] = $value->name;
            echo implode(', ', $result);
            /*
            $category = \yii\helpers\ArrayHelper::getColumn($category, 'name');
            echo implode(', ', $category);
        \yii\helpers\VarDumper::dump($category,3,true);*/
            ?></td>
    </tr>
    <tr>
        <th>Не коротко о главном</th>
    </tr>
    <tr>
        <td>
            <?= $model->textFull ?>
        </td>
    </tr>
</table>

<br>
<br>
<p>Опубликован:</p>
<?= $model->publicDate = date('d.m.y') ?>


<hr class="dividing-line">
<br>
<br>
<br>
Комментарии:
<?php foreach ($commentsModel as $item): ?>
    <ul class="comments">
        <li class="comments__list"><p class="comments__title">Автор: &nbsp </p> <?= $item->author ?></li>
        <li><?= $item->content ?></li>
        <li class="comments__list"><p class="comments__title">Дата Создания:
                &nbsp </p> <?= gmdate("d-m-Y", $item->created_at) ?></li>
    </ul>

<?php endforeach ?>

<ul id="comment-list">
    <li id="author"></li>
    <br>
    <li id="content"></li>
    <li id=date></li>
    <br>
</ul>

<br>
<br>
<br>
<p>Оставить комментарий:</p>
<?php $form = \yii\widgets\ActiveForm::begin() ?>

<?= $form->field($commentsForm, 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 200,
        'plugins' => [
            'clips',
            'fullscreen',
        ],
        'clips' => [
            ['Lorem ipsum...', 'Lorem...'],
            ['red', '<span class="label-red">red</span>'],
            ['green', '<span class="label-green">green</span>'],
            ['blue', '<span class="label-blue">blue</span>'],
        ],
    ],
]);
?>
<?= Html::submitButton('Добавить комментарий', ['formaction' => '/comments/add?id=' . $model->id, 'class' => 'btn btn-primary']) ?>
<?php $form = \yii\widgets\ActiveForm::end() ?>

<?php
$js = <<<JS
        $('form').on('beforeSubmit', function(){
    var data = $(this).serialize();
     $.ajax({
url: '/comments/add?id=' + $model->id,
type: 'POST',
data: data,
success: function(res){
    const author = "<b>Автор: </b> " + res.author;
    const unixDate = "<b>Дата Создания: </b> " + res.created_at;
    document.getElementById("author").innerHTML = author;
    document.getElementById("content").innerHTML = res.content;
    document.getElementById("date").innerHTML = unixDate;
    document.getElementById("comment-list").setAttribute('class', "comments");
console.log(res);
},
error: function(){ 
alert('Error!');
}
});
return false;
});

JS;
$this->registerJs($js, $this::POS_READY);
?>
<br>
<br>


<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model deka6pb\simpleTodo\models\Todo */

$this->title = 'Create Todo';
$this->params['breadcrumbs'][] = ['label' => 'Todos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

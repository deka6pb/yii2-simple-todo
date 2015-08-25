<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model deka6pb\simpleTodo\models\Todo */

$this->title = 'Update Todo: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Todos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="todo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

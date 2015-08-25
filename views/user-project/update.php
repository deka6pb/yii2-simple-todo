<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model deka6pb\simpleTodo\models\UserProject */

$this->title = 'Update User Project: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-project-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

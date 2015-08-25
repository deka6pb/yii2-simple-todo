<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model deka6pb\simpleTodo\models\UserProject */

$this->title = 'Create User Project';
$this->params['breadcrumbs'][] = ['label' => 'User Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-project-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

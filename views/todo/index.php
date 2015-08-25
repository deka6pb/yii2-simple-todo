<?php

use deka6pb\simpleTodo\models\Project;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\simpletodo\models\Todo */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Todos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="w0-filters">
        <div class="form-group field-todo-project_id required">
            <label class="control-label" for="todo-project_id">Projects</label>
            <?= Html::dropDownList('TodoSearch[project_id]', 'id', Project::getProjectsList(), [
                'id'    => "ajax-select-project_id",
                'class' => 'form-control',
            ]) ?>
        </div>
    </div>

    <p>
        <?= Html::a('Create Todo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id' => 'todoList', 'timeout' => false,
                       'enablePushState' => false]) ?>
    <?= $this->render('_grid', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]); ?>
    <?php Pjax::end() ?>
</div>

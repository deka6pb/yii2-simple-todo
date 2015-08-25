<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\simpletodo\models\UserProject */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'project_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

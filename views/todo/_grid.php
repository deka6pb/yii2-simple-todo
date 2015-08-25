<?php
use deka6pb\simpleTodo\models\Project;
use deka6pb\simpleTodo\models\Todo;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\simpletodo\models\Todo */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'rowOptions'   => function ($model) {
        if($model->status == $model::STATUS_CONTINUES && date($model::FORMAT_DATETIME) > $model->date_start) {
            return ['class' => 'danger'];
        }
    },
    'columns' => [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function($model, $key, $index, $column) {
                return [
                    'data-id' => $model->id,
                    'class' => "disabled todo_status",
                    'checked' => ($model->status == $model::STATUS_FINISHED) ? true : false
                ];
            }
        ],
        [
            'attribute' => 'text:ntext',
            'format' => 'raw',
            'value' => function($model) {
                return ($model->status == $model::STATUS_FINISHED)
                    ? '<span class="completed">' . $model->text . '</span>'
                    : $model->text;
            }
        ],
        [
            'attribute' => 'type',
            'filter'    => Html::activeDropDownList(
                $searchModel,
                'status',
                Todo::getTypeAliases(),
                [
                    'class' => 'form-control',
                    'prompt' => '--'
                ]
            ),
            'value' => function($model) {
                return $model->getType();
            }
        ],
        [
            'attribute' => 'user_id',
            'value' => function($model) {
                return $model->getUserName();
            }
        ],
        [
            'attribute' => 'date_start',
            'format'    => ['date', 'php:Y-m-d H:i'],
            'options'   => ['width' => '200'],
            'filter'    => DatePicker::widget([
                'model'         => $searchModel,
                'attribute'     => 'date_start',
                'clientOptions' => [
                    'autoclose' => true,
                    'format'    => 'yyyy-mm-dd',
                ]
            ])
        ],
        'duration_minute',
        ['class' => 'yii\grid\ActionColumn',
            'template'=>'{check}',
            'buttons'=>[
                "check" => function ($url, $model) {
                    if ($model->status == $model::STATUS_CONTINUES) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-ok"></span>',
                            $url,
                            [
                                'title'              => Yii::t('app', 'Check'),
                                'data-pjax'          => '1',
                                'data-toggle-active' => $model->id
                            ]);
                    }
                },
            ]
        ],
        /*[
            'attribute' => 'status',
            'class' => 'yii\grid\CheckboxColumn'
        ],*/

        // 'status',
        // 'type',
        // 'date_start',
        // 'created',

        /*['class' => 'yii\grid\ActionColumn'],*/
    ],
]);
?>


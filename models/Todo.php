<?php

namespace deka6pb\simpleTodo\models;

use common\models\User;
use DateInterval;
use DateTime;
use deka6pb\simpleTodo\behaviors\DateTimeBehavior;
use deka6pb\simpleTodo\behaviors\DateTimeCheckerBehavior;
use deka6pb\simpleTodo\behaviors\DurationParserBehavior;
use deka6pb\simpleTodo\behaviors\UserBehavior;
use Yii;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "todo".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $user_id
 * @property integer $author_id
 * @property string $text
 * @property integer $status
 * @property integer $type
 * @property string $date_start
 * @property integer $duration_minute
 * @property string $created
 *
 * @property User $author
 * @property Project $project
 * @property User $user
 */
class Todo extends \yii\db\ActiveRecord
{
    const STATUS_CONTINUES          = 1;
    const STATUS_FINISHED           = 2;

    const TYPE_TASK                 = 1;
    const TYPE_BUG                  = 2;

    const FORMAT_DATETIME           = "Y-m-d H:i:s";
    const FORMAT_DATETIME_VALIDATE  = "yyyy-MM-dd";
    const FORMAT_DATE_SHOW          = "yyyy-mm-dd";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['project_id', 'user_id', 'author_id', 'status', 'type', 'date_start', 'created', 'text', 'duration_minute'], 'required'],
            [['project_id', 'user_id', 'type', 'date_start', 'text', 'duration_minute'], 'required'],
            [['project_id', 'user_id', 'author_id', 'status', 'type'], 'integer'],
            [['project_id'], 'exist', 'targetClass' => Project::className(), 'targetAttribute' => 'id'],
            [['user_id'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => 'id'],
            [['date_start'], 'date', 'format' => self::FORMAT_DATETIME_VALIDATE],
            ['type', 'in', 'range' => array_keys(self::getTypeAliases())],
            [['text'], 'string', 'max' => 250, 'min' => 1],
            [['date_start', 'created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project',
            'user_id' => 'User',
            'author_id' => 'Author',
            'text' => 'Text',
            'status' => 'Status',
            'type' => 'Type',
            'date_start' => 'Date Start',
            'duration_minute' => 'Duration',
            'created' => 'Created'
        ];
    }

    public function behaviors() {
        return [
            'UserBehavior' => [
                'class'                 => UserBehavior::className(),
                'user_attribute'        => 'author_id'
            ],
            'DateTimeCheckerBehavior' => [
                'class'                 => DateTimeCheckerBehavior::className(),
                'attribute_name'        => 'date_start',
            ],
            'DateTimeBehavior' => [
                'class'                 => DateTimeBehavior::className(),
                'attributes'            => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => 'created',
                ]
            ],
            'DurationParserBehavior' => [
            'class'                     => DurationParserBehavior::className(),
                'attribute_name'        => 'duration_minute',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return array Todo status aliases
     */
    public static function getStatusAliases() {
        return [
            self::STATUS_CONTINUES => 'Continues',
            self::STATUS_FINISHED => 'Finished',
        ];
    }

    /**
     * @return array Todo type aliases
     */
    public static function getTypeAliases() {
        return [
            self::TYPE_TASK => 'Task',
            self::TYPE_BUG => 'Bug',
        ];
    }

    public function beforeSave($insert) {
        if($insert) {
            $this->status = TODO::STATUS_CONTINUES;
        }

        return parent::beforeSave($insert);
    }

/*    public function getProjectName() {
        return $this->project->name;
    }*/

    /**
     * @return string Читабельный статус.
     */
    public function getStatus() {
        $status = self::getStatusAliases();

        return $status[$this->status];
    }

    /**
     * @return string Читабельный тип.
     */
    public function getType() {
        $types = self::getTypeAliases();

        return $types[$this->type];
    }

    public function getUserName() {
        return $this->user->username;
    }

    public function getDatetimeDuration() {
        $date = new DateTime($this->date_start);
        $format = "PT{$this->duration_minute}M";
        $date->add(new DateInterval($format)); // add N min

        return $date->format(self::FORMAT_DATETIME);
    }
}

<?php
namespace deka6pb\simpleTodo\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

class UserBehavior extends AttributeBehavior {
    public $user_attribute = 'user_id';

    public $attributes = [
        BaseActiveRecord::EVENT_BEFORE_INSERT => ['user_id'],
    ];

    public $value;

    protected function getValue($event) {
        if(empty($this->owner->{$this->user_attribute})) {
            $this->owner->{$this->user_attribute} = Yii::$app->user->identity->id;
        }

        return $this->owner->{$this->user_attribute};
    }

    public function touch($attribute) {
        $this->owner->updateAttributes(array_fill_keys((array)$attribute, $this->getValue(null)));
    }
}
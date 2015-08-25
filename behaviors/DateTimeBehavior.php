<?php
namespace deka6pb\simpleTodo\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

class DateTimeBehavior extends AttributeBehavior {
    public $attributes = [
        BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
        BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
    ];

    public $value;

    protected function getValue($event) {
        if ($this->value instanceof Expression) {
            return $this->value;
        } else {
            return $this->value !== null ? call_user_func($this->value, $event) : new Expression("NOW()");
        }
    }

    public function touch($attribute) {
        $this->owner->updateAttributes(array_fill_keys((array)$attribute, $this->getValue(null)));
    }
}
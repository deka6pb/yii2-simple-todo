<?php
namespace deka6pb\simpleTodo\behaviors;

use DateTime;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class DateTimeCheckerBehavior extends Behavior {
    /**
     * @var string Attribute name
     */
    public $attribute_name  = 'date';
    public $format          = 'Y-m-d';
    public $checkFormats    = [
        "Y-m-d",
        "m-d",
        "d.m.Y"
    ];

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event) {
        $verifiable_date = $this->owner->{$this->attribute_name};
        $date = false;

        if(!empty($verifiable_date) && !empty($this->format)) {
            foreach($this->checkFormats AS $format) {
                if($date)
                    break;

                $date = DateTime::createFromFormat($format, $verifiable_date);
            }

            return ($date) ? $date->format($this->format) : $verifiable_date;
        }
    }
}
<?php
namespace deka6pb\simpleTodo\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class DurationParserBehavior extends Behavior {
    /**
     * @var string Attribute name
     */
    public $attribute_name = 'duration';
    /**
     * @var string DateTime format out value
     */
    public $duration_format = 'm';

    protected $duration;

    const ALIAS_SECOND  = 's';
    const ALIAS_MINUTE  = 'm';
    const ALIAS_HOUR    = 'd';

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate($event) {
        if(!empty($this->owner->{$this->attribute_name})) {

            $seconds = $this->parseTimeOutSeconds($this->owner->{$this->attribute_name});

            if(is_null($seconds))
                return;

            $this->formatTime($seconds);
            $this->saveDuration();
        }
    }

    public function parseTimeOutSeconds($string) {
        $seconds = null;

        if (preg_match('/^(?:(?<d>\d+)d\s*)?(?:(?<h>\d+)h\s*)?(?:(?<m>\d+)m\s*)?(?:(?<s>\d+)s\s*)?$/', $string, $matches)) {
            $seconds += (!empty($matches['s'])) ? $matches['s'] : 0;
            $seconds += (!empty($matches['m'])) ? $matches['m'] * 60 : 0;
            $seconds += (!empty($matches['h'])) ? $matches['h'] * 3600: 0;
            $seconds += (!empty($matches['d'])) ? $matches['d'] * 86400: 0;
        }

        return $seconds;
    }

    public function formatTime($seconds) {
        switch($this->duration_format) {
            case self::ALIAS_SECOND:
                $time = $seconds % 60;
                break;
            case self::ALIAS_MINUTE:
                $time = floor($seconds / 60);
                break;
            case self::ALIAS_HOUR:
                $time = floor($seconds % 3600);
                break;
            default:
                $time = $seconds % 60;
        }

        $this->duration = $time;
    }

    public function saveDuration() {
        if(!empty($this->duration)) {
            $this->owner->{$this->attribute_name} = (string) $this->duration;
        }
    }
}
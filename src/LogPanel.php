<?php

namespace kld\error_log_capture;

use Psr\Log\LogLevel;
use Yii;
use yii\grid\GridViewAsset;

/**
 * LogPanel
 * @package bedezign\yii2\audit\panels
 */
class LogPanel extends \bedezign\yii2\audit\panels\LogPanel
{
    /**
     * keywords to capture
     *
     * @var string[]
     */
    public $keywords = [
        'error',
        'exception',
    ];

    /**
     * if capture all logs
     *
     * @var bool
     */
    public $isCaptureAll = false;

    /**
     * allow capture levels
     *
     * @var array
     */
    public $allowLevels = [
        LogLevel::WARNING,
        LogLevel::ERROR,
    ];

    /**
     * @inheritdoc
     */
    public function save()
    {
        Yii::error();
        $data = parent::save();
	    foreach($data['messages'] as $message) {
	        $traceInfo = $message[4][0];
	        if(!$this->isCaptureAll || in_array($traceInfo['function'], $this->allowLevels)) {
                if(preg_match('/^' . implode('|', $this->keywords) . '/', json_encode($message)) === 1) {
                    $this->module->errorMessage(sprintf("message: %s, category: %s", $message[0], $message[1]), 1, $traceInfo['file'], $traceInfo['line'], $message[4]);
                }
            }
        }

        return (isset($data['messages']) && count($data['messages']) > 0) ? $data : null;
    }

}

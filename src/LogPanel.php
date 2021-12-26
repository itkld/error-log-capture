<?php

namespace kld\error_log_capture;

use bedezign\yii2\audit\Audit;
use bedezign\yii2\audit\components\panels\DataStoragePanelTrait;
use Yii;
use yii\debug\models\search\Log;
use yii\grid\GridViewAsset;

/**
 * LogPanel
 * @package bedezign\yii2\audit\panels
 */
class LogPanel extends \bedezign\yii2\audit\panels\LogPanel
{
    /**
     * @inheritdoc
     */
    public function save()
    {
        $data = parent::save();

        // get entry info
        $errorLogs = [];
	    foreach($data['messages'] as $message) {
            if(strpos(json_encode($message), "Exception") !== false) {
                $errorLogs[] = $message;
                var_dump($message);
            }
        }

	    // if has error log for this entry, save index to error
        //if(!empty($errorLogs)) {
        //    $this->module->errorMessage('', 1, '', 1, implode("<br />", $errorLogs));
        //}
        return (isset($data['messages']) && count($data['messages']) > 0) ? $data : null;
    }

}

#Error log capture

"Error log capture" capture errors from logs, is an extension of Yii2 Audit.

## Usage

###  Download
Download using composer by running the following command:
```
composer require itkld/error-log-capture:"dev-main"
```

### Module Configuration
Add Audit to your configuration array:
```
<?php
$config = [
    'modules' => [
        'audit' => [
                ...
                'panelsMerge' => [
                    'audit/log' => [
                        'class' => 'kld\error_log_capture\LogPanel'
                        'isCaptureAll' => true,
                        /*
                        'allowLevels' => [
                            LogLevel::WARNING,
                            LogLevel::ERROR,
                        ]
                        */
                    ],
                ]
        ],
    ],
];
```

### Viewing the Audit Data
http://localhost/path/to/index.php?r=audit/error
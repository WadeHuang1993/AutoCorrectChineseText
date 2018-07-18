<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/FileChineseTypesettingCorrector.php';

use Naux\AutoCorrect;

$corrector = new AutoCorrect;
$fileCorrector = new FileChineseTypesettingCorrector($corrector, $argv);

$fileCorrector->setBasePath(__DIR__);
$fileCorrector->correct();




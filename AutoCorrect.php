<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/FileChineseTypesettingCorrector.php';

use Naux\AutoCorrect;
use GetOptionKit\OptionCollection;
use GetOptionKit\OptionParser;
use GetOptionKit\OptionPrinter\ConsoleOptionPrinter;

$specs   = new OptionCollection;
$printer = new ConsoleOptionPrinter();
$parser  = new OptionParser($specs);

/*******************************
 * 初始化排程設定
 *******************************/
$specs->add('i:', '要做排版的檔案名稱 EX: -i sample.txt');
$specs->add('o:', '輸出的檔案名稱(可選） EX: -o sampleOutput.txt');
$specs->add('a+', '新增辭典（可選，可多次新增）' . ' EX: -a HTML -a Python');
$specs->add('h',  '查看使用說明');
$option = $parser->parse($argv);

if ($option->has('h')) {
    introduce($printer, $specs);
}

/*******************************
 * 初始化 FileChineseTypesettingCorrector
 *******************************/
$corrector     = new AutoCorrect;
$fileCorrector = new FileChineseTypesettingCorrector($corrector);
$fileCorrector->setBasePath(__DIR__);

if ($option->has('i')) {
    $fileCorrector->setInput($option->get('i'));
} else {
    echo '請使用 -i 參數加入要做排版的文件。或 -h 查看使用說明。';
    exit;
}

if ($option->has('o')) {
    $fileCorrector->setOutput($option->get('o'));
}

/*******************************
 * 開始校正中文文案排版
 *******************************/
try {
    $fileCorrector->correct();
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

function introduce($printer, $specs)
{
    $introduction = '介紹：' . PHP_EOL;
    $introduction .= 'AutoCorrect.php 是一個處理中文文案排版的 PHP-CLI 排程，處理「中文、英文、數字之間的空格、標點符號、全形與半形符號、專有名詞大小寫」，但追根究底只是用訊息替換罷了.' . PHP_EOL;
    $introduction .= '更多的中文文案排版指南請見：https://github.com/sparanoid/chinese-copywriting-guidelines';

    echo $introduction;

    $example = PHP_EOL . PHP_EOL . '使用範例：' . PHP_EOL;
    $example .= 'php AutoCorrect.php -i InputFile -o OutputFile' . PHP_EOL;
    $example .= PHP_EOL . '若 OutputFile 沒定義的話，預設輸出的檔案名稱會與輸入檔案（InputFile）名稱相同。' . PHP_EOL;

    echo $example;

    $param = PHP_EOL . '額外參數：' . PHP_EOL;

    echo $param;
    echo $printer->render($specs);
    exit;
}




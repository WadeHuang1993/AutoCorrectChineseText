<?php

require __DIR__ . '/vendor/autoload.php';

use Naux\AutoCorrect;

$correct = new AutoCorrect;

/**
 * 第一個參數: 輸入的檔案名稱
 */
$fileName = $argv[1];

/**
 * 第二個參數: 輸出的檔案名稱
 *
 * 預設值: 輸入的檔案名稱.
 */
$outputFileName = isset($argv[2]) ? $argv[2] : $argv[1];

/**
 * 輸入檔案的全路徑
 */
$inputFilePath = __DIR__ . '/' . $fileName;

/**
 * 輸出檔案的全路徑
 */
$outputFilePath = __DIR__ . '/outputs/' . $outputFileName;

$outputFile = fopen($outputFilePath,"w");

$fp = fopen($inputFilePath, 'r');
while ($line = stream_get_line($fp, 1024 * 1024)) {
    fwrite($outputFile, $correct->convert($line));
}
fclose($fp);
fclose($outputFile);
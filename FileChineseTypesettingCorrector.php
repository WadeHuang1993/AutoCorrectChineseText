<?php

use Naux\AutoCorrect;


class FileChineseTypesettingCorrector
{
    protected $corrector;

    /**
     * 第一個參數: 輸入的檔案名稱
     */
    protected $fileName;

    /**
     * 第二個參數: 輸出的檔案名稱
     *
     * 預設值: 輸入的檔案名稱.
     */
    protected $outputFileName;

    /**
     * 輸入檔案的全路徑
     */
    protected $inputFilePath;

    /**
     * 輸出檔案的全路徑
     */
    protected $outputFilePath;

    /**
     * 輸出檔案的全路徑
     */
    protected $basePath = __DIR__;

    protected $length = 1024 * 1024;

    public function __construct($corrector, array $argv)
    {
        $this->fileName       = $argv[1];
        $this->outputFileName = isset($argv[2]) ? $argv[2] : $argv[1];
        $this->corrector      = $corrector;
    }

    public function addDictionary(array $dictionary)
    {
        $this->corrector->withDict($dictionary);
    }

    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    public function correct()
    {

        $this->inputFilePath  = $this->basePath . '/' . $this->fileName;
        $this->outputFilePath = $this->basePath . '/outputs/' . $this->outputFileName;

        $outputFile = fopen($this->outputFilePath, "w");

        $fp = fopen($this->inputFilePath, 'r');
        while ($line = stream_get_line($fp, $this->length)) {
            fwrite($outputFile, $this->corrector->convert($line));
        }
        fclose($fp);
        fclose($outputFile);
    }
}
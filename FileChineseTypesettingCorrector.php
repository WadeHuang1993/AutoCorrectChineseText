<?php
/**
 * Class FileChineseTypesettingCorrector
 *
 * 此工具用於統一中文文案、排版，降低團隊成員之間的溝通成本，增強網站氣質。
 * 其統一中文文案與排版格式皆參考中文文案排版指北。
 * 此工具是基於 NauxLiu/auto-correct 做出來的「自動中文排版工具」。
 *
 * PHP version 5.6
 *
 * @category Tools
 * @package  AutoCorrectChineseTypesetting
 * @author   WadeHuang <wadehuangtw1993@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/WadeHuang1993/AutoCorrectChineseTypesetting
 */

class FileChineseTypesettingCorrector
{
    /**
     * 校正器
     *
     * @var Naux\AutoCorrect $corrector
     */
    protected $corrector;

    /**
     * 輸入的檔案名稱
     */
    protected $inputFileName = '';

    /**
     * 輸出的檔案名稱
     *
     * 預設值: 輸入的檔案名稱.
     */
    protected $outputFileName = '';

    /**
     * 輸入檔案的全路徑
     */
    protected $inputFilePath;

    /**
     * 輸出檔案的全路徑
     */
    protected $outputFilePath;

    /**
     * 輸入與輸出檔案的基本路徑
     */
    protected $basePath = __DIR__;

    /**
     * 讀寫檔案大小
     */
    protected $length = 1024 * 1024;

    /**
     * 建構函示.
     *
     * @param Naux\AutoCorrect $corrector 校正器
     */
    public function __construct($corrector)
    {
        $this->corrector = $corrector;
    }

    /**
     * 新增英文專業用詞校正辭典
     *
     * @param array $dictionary 專業用詞校正辭典
     *
     * @return void
     */
    public function addDictionary(array $dictionary)
    {
        $this->corrector->withDict($dictionary);
    }

    /**
     * 設置基本路徑
     *
     * @param string $basePath 基本路徑
     *
     * @return void
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * 設置要校正的檔案名稱
     *
     * @param string $input 要校正的檔案名稱
     *
     * @return void
     */
    public function setInput($input)
    {
        $this->inputFileName = $input;
    }

    /**
     * 設置輸出的檔案名稱
     *
     * @param string $output 輸出的檔案名稱
     *
     * @return void
     */
    public function setOutput($output)
    {
        $this->outputFileName = $output;
    }

    /**
     * 取得輸出檔案名稱
     *
     * 若尚未設定輸出檔案名稱，
     * 則預設輸出名稱為：輸入的檔案名稱。
     *
     * @return string 輸出的檔案名稱
     */
    protected function outputFileName()
    {
        return (trim($this->outputFileName) != '') ? $this->outputFileName : $this->inputFileName;
    }

    /**
     * 校正中文文案排版
     *
     * @throws Exception
     */
    public function correct()
    {
        if ('' === trim($this->inputFileName)) {
            throw new Exception('錯誤，尚未設定 inputFileName ，找不到輸入檔案。');
        }

        $this->inputFilePath  = $this->basePath . '/' . $this->inputFileName;
        $this->outputFilePath = $this->basePath . '/outputs/' . $this->outputFileName();

        $outputFile = fopen($this->outputFilePath, "w");

        $fp = fopen($this->inputFilePath, 'r');
        while ($line = stream_get_line($fp, $this->length)) {
            fwrite($outputFile, $this->corrector->convert($line));
        }
        fclose($fp);
        fclose($outputFile);
    }
}
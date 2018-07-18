# AutoCorrectChineseTypesetting
# 自動中文排版工具

[![](https://img.shields.io/website-up-down-green-red/http/shields.io.svg?label=my-website
)](https://wadehuanglearning.blogspot.com/)
![](https://img.shields.io/badge/PHP-%3E%3D%205.6-blue.svg)

此工具用於統一中文文案、排版，降低團隊成員之間的溝通成本，增強網站氣質。

其統一中文文案與排版格式皆參考[中文文案排版指北](https://github.com/sparanoid/chinese-copywriting-guidelines)。

此工具是基於 [NauxLiu/auto-correct](https://github.com/NauxLiu/auto-correct) 做出來的「自動中文排版工具」。

![demo.png](./demo.png)

## 安裝要求：
  * PHP 5.6+

## 安裝：
將 AutoCorrectChineseTypesetting Clone 下來即可。

## 使用說明：
AutoCorrectChineseTypesetting 必須在 PHP-CLI 模式下進行：

   * 將要進行排版的檔案放到 AutoCorrectChineseTypesetting 目錄下。
   * 使用 PHP-CLI 執行 AutoCorrect.php 校正中文文案排版。
   * AutoCorrect.php 會自動將校正完成的檔案輸出至 Outputs 目錄內。

### 步驟：
在 Command-Line 模式中：
```
cd path/to/AutoCorrectChineseTypesetting
php AutoCorrect.php -i InputFile -o OutputFile
```
若 OutputFile 沒定義的話，預設輸出的檔案名稱會與輸入檔案名稱相同。

### 可用參數：
```
-i  要做排版的檔案名稱。
-o  輸出的檔案名稱（可選）
-h  查看使用說明。
```

## 注意：
此版本目前只有測試過 txt 檔案可正常排版。

## TODO：
  * 加入新增辭典功能。

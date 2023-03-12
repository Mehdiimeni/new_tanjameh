<?php

class FileTools extends StorageTools
{
    private $FileAddress;
    public function __construct($FileFullAddress)
    {
        $this->FileAddress = $FileFullAddress;
    }

    public function KeyValueFileReader()
    {
        $arrAllContent = array();
        $opFile = fopen($this->FileAddress, "r");
        while (($line = fgets($opFile)) !== false) {
            $arrGenerate = explode("::==::",trim($line));
            $arrAllContent[$arrGenerate[0]] = $arrGenerate[1];
        }
        fclose($opFile);
        return $arrAllContent;
    }
}
<?php

namespace App\Library;

class TemplateParser
{
    private $contents;
    private $url;
    private $document;
    private $templateDirectoryPath;

    public function __construct($url){

        libxml_use_internal_errors(true);

        $this->url = $url;
        $this->contents = file_get_contents($url);
        $this->document = new \DOMDocument();
        $this->document->loadHTML($this->contents);
    }

    public function getUrl(){
        return $this->url;
    }

    public function getContents(){
        return $this->contents;
    }

    public function getDocument(){
        return $this->document;
    }

    public function setTemplateDirectoryPath($path){
        $this->templateDirectoryPath = $path;
    }

    public function getTemplateDirectoryPath(){
        return $this->templateDirectoryPath;
    }

    public function createLocalTemplateDirectory(){
        if(!file_exists($this->templateDirectoryPath)){
            mkdir($this->templateDirectoryPath);
        }

        else{
           $this->deleteDirectoryContents($this->templateDirectoryPath);
        }
    }

    public function deleteDirectoryContents($path){
        foreach(glob($path . '/*') as $file){
            if(is_file($file)){
                unlink($file);
            }

            elseif(is_dir($file)){
                $this->deleteDirectoryContents($path . '/' . $file);
                unlink($file);
            }
        }
    }

    public function getImages(){
        return $this->document->getElementsByTagName('img');
    }

    public function getStylesheetsLinks(){
        return $this->document->getElementsByTagName('link');
    }

    public function getScripts(){
        return $this->document->getElementsByTagName('script');
    }

    public function getBody(){
        $result = '';
        $body = $this->document->getElementsByTagName('body');
        foreach($body->item(0)->childNodes as $node){
            $result .= $this->document->saveHTML($node);
        }

        return $result;
    }
}

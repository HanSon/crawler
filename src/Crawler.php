<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-18
 * Time: 下午7:25
 */

namespace Hanccc;


trait Crawler
{
    public $client;

    public $crawler;
    
    public $logPath;

    public function crawl($url)
    {
        try{
            return $this->crawler = $this->client->request('get', $url);
        }catch (\Exception $e){
            $this->exceptionHandle($url, $e);
        }
    }
    
    private function getLogPath(){
        return $this->logPath;
    }

    /**
     * @param $url
     * @param $e \Exception
     * @throws \Exception
     */
    private function exceptionHandle($url, $e)
    {
        if(!$this->client->getResponse()){
            Log::getInstance(Log::ERROR, $this->getLogPath())->addError($url . ' : ' . $e->getMessage());
            throw new \Exception('response is null!');
        }
            
        if($this->client->getResponse()->getStatus() == 200){
            $this->crawl($url);
            Log::getInstance(Log::DEBUG, $this->getLogPath())->addDebug($url);
        } else{
            Log::getInstance(Log::ERROR, $this->getLogPath())->addError($url . ' : ' . $e->getMessage());  
        }
    }

}
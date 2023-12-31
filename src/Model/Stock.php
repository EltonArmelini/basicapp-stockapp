<?php

namespace src\Model;

use Error;
use src\Model\Database;
use PDO;

class Stock extends Database
{
    private string $ticker;
    private string $performanceId;
    private mixed $info;

    public function __construct(private string $name)
    {
        parent::__construct();
    }

    public function save()
    {   
        $query = $this->connection()->prepare("INSERT INTO stocks(name,ticker,performance) VALUES(:name,:ticker,:performance) ");
        $query->execute([
            ":name" => $this->name,
            ":performance" => $this->performanceId,
            ":ticker" => $this->ticker
        ]);
    }
    public function isStockReal(){
        try {
            $this->loadProvider();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function exists($name)
    {
        $db = new Database;
        $query = $db->connection()->prepare("SELECT * FROM stocks WHERE name = :name");
        $query->execute(['name'=>$name]);

        return $query->rowCount() > 0; 

    }

    public static function getAll()
    {
        $db = new Database; 
        $query = $db->connection()->query("SELECT * FROM stocks");
        $stocks = [];
        
        while($r = $query->fetch(PDO::FETCH_ASSOC)){
            $stock = self::createFromArray($r);
            array_push($stocks , $stock);
        }

        return $stocks;
    }

    public static function createFromArray($array)
    {
        $stock = new Stock($array['name']);
        $stock->setTicker($array['ticker']);
        $stock->setPerformanceId($array['performance']);
        $stock->loadStock();


        return $stock;
    }

    private function loadProvider()
    {

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://ms-finance.p.rapidapi.com/market/v2/auto-complete?q=".$this->name,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: ms-finance.p.rapidapi.com",
                "X-RapidAPI-Key: f4b72b32e1mshc663c17e970b267p13331ajsn7e32662d1ee0"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Error($err);
        } else {
            $json = json_decode($response);
            $this->performanceId = $json->results[0]->performanceId;
            $this->name = $json->results[0]->name;
            $this->ticker = $json->results[0]->ticker;

        }
    }

    private function loadStock()
    {

        $curl = curl_init();    

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://ms-finance.p.rapidapi.com/stock/v2/get-realtime-data?performanceId=".$this->performanceId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: ms-finance.p.rapidapi.com",
                "X-RapidAPI-Key: f4b72b32e1mshc663c17e970b267p13331ajsn7e32662d1ee0"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Error($err);
        } else {
            $this->info = json_decode($response);
        }
    }
    


    /**
     * Set the value of performanceId
     *
     * @return  self
     */ 
    public function setPerformanceId($performanceId)
    {
        $this->performanceId = $performanceId;

        return $this;
    }

    /**
     * Set the value of ticker
     *
     * @return  self
     */ 
    public function setTicker($ticker)
    {
        $this->ticker = $ticker;

        return $this;
    }

    /**
     * Get the value of ticker
     */ 
    public function getTicker()
    {
        return $this->ticker;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of performanceId
     */ 
    public function getPerformanceId()
    {
        return $this->performanceId;
    }

    /**
     * Get the value of info
     */ 
    public function getStock()
    {
        return $this->info;
    }
}
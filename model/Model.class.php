<?php 

class Model extends MyObject{

    public static function DB(){
        return DataBasePDO::getCurrentPDO();
    }

    public static function exec($request){
        $pdo=self::DB();
        echo $request;

        $pdo->exec($request);
        
    }


    public static function prepare($request){
        $pdo=self::DB();
        //echo $request;
        return $pdo->prepare($request);
    }

    public static function query($request){
        $st = static::DB()->query($request) or die("sql query error ! request : " . $request);
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class()); 
        return $st;
    }


}

?>
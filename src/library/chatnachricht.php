<?php
    class Chatnachricht
    {
        static $neueID;
        public $NachrichtID;
        public $vonBenutzer;
        public $anBenutzer;
        public $Nachricht;   
        

        function __construct()
        {
            self::$neueID++;
            $this->NachrichtID = self::$neueID;
            $this->vonBenutzer = $vonBenutzer;
            $this->anBenutzer = $anBenutzer;
            $this->nachricht = $nachricht;

        }

        
    }

?>
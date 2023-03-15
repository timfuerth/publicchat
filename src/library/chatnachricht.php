<?php
    class Chatnachricht
    {
        static $neueID;
        public $NachrichtID;
        public $vonBenutzer;
        public $anBenutzer;
        public $Nachricht;   
        

        function __construct($vonBenutzer, $anBenutzer, $nachricht)
        {
            self::$neueID++;
            $this->NachrichtID = self::$neueID;
            $this->vonBenutzer = $vonBenutzer;
            $this->anBenutzer = $anBenutzer;
            $this->Nachricht = $nachricht;
        }

        
    }

?>
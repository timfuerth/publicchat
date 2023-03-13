<?php
    class Benutzer
    {

        static $neueID;
        public $BenutzerID;
        public $Vorname;
        public $Nachname;
        public $Username;
        public $Passwort;

        function __construct($Vorname, $Nachname, $Username, $Passwort)
        {
            self::$neueID++;
            $this->BenutzerID = self::$neueID;
            $this->Vorname = $Vorname;
            $this->Nachname = $Nachname;
            $this->Username = $Username;
            $this->Passwort = $Passwort;
        }
        
        
    }

?>
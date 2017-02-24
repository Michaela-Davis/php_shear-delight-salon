<?php
    class Stylist
    {
        private $stylist_name;
        private $id;

        function __construct($stylist_name, $id = null)
        {
            $this->stylist_name = $stylist_name;
            $this->id = $id;
        }

        ///   Stylist getter and setter   ///
        function getStylistName()
        {
            return $this->stylist_name;
        }

        function setStylistName($new_name)
        {
            $this->stylist_name = (string) $new_name;
        }

        ///   id getter   ///
        function getId()
        {
            return $this->id;
        }

        /////     METHODS     /////
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getStylistName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function deleteStylist()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

        /////     Static METHODS     /////
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function getAll()
        {
            $all_stylists = array();
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists ORDER BY name;");
            foreach($returned_stylists as $stylist) {
                $stylist_name = $stylist['name'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($stylist_name, $id);
                array_push($all_stylists, $new_stylist);
            }
            return $all_stylists;
        }



    }
?>

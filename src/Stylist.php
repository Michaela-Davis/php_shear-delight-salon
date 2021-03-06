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

        /////     begin METHODS     /////
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getStylistName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateStylist($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setStylistName($new_name);
        }

        function deleteStylist()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

        function getClients()
        {
            $found_clients = array();
            $all_clients = Client::getAll();
            foreach($all_clients as $client) {
                if ($client->getStylistId() == $this->getId()) {
                    array_push($found_clients, $client);
                }
            }
            return $found_clients;
        }
        /////     end METHODS     /////


        /////     begin Static METHODS     /////
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }

        static function findStylist($search_id)
        {
            $found_stylist = null;
            $all_stylists = Stylist::getAll();
            foreach($all_stylists as $stylist) {
                $found_id = $stylist->getId();
                if ($search_id == $found_id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }
        /////     end Static METHODS     /////
    }
?>

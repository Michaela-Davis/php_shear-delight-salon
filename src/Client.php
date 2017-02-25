<?php
    class Client
    {
        private $id;
        private $client_name;
        private $phone;
        private $stylist_id;

        function __construct($id = null, $client_name, $phone, $stylist_id)
        {
            $this->id = $id;
            $this->client_name = $client_name;
            $this->phone = $phone;
            $this->stylist_id = $stylist_id;
        }

        ///   ClientId getter  ///
        function getClientId()
        {
            return $this->id;
        }

        ///   Client Name getter and setter   ///
        function getClientName()
        {
            return $this->client_name;
        }

        function setClientName($new_name)
        {
            $this->client_name = (string) $new_name;
        }

        ///   Client Phone getter and setter   ///
        function getPhone()
        {
            return $this->phone;
        }

        function setPhone($new_phone)
        {
            $this->phone = (string) $new_phone;
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }


        /////     begin METHODS     /////
        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (id, name, phone, stylist_id) VALUES ('{$this->getClientId()}','{$this->getClientName()}', '{$this->getPhone()}', {$this->getStylistId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function updateClient($new_name, $new_phone)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}', phone = '{$new_phone}' WHERE id = {$this->getClientId()};");
            $this->setClientName($new_name);
            $this->setPhone($new_phone);
        }

        function deleteClient()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id={$this->getClientId()};");
        }
        /////     end METHODS     /////


        /////     begin Static METHODS     /////
        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients ORDER BY name;");
            $all_clients = array();
            foreach($returned_clients as $client) {
                $id = $client['id'];
                $client_name = $client['name'];
                $phone = $client['phone'];
                $stylist_id = $client['stylist_id'];
                $new_client = new Client($id, $client_name, $phone, $stylist_id);
                array_push($all_clients, $new_client);
            }
            return $all_clients;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

        static function findClient($search_id)
        {
            $found_client = null;
            $all_clients = Client::getAll();
            foreach ($all_clients as $client) {
                $client_id = $client->getClientId();
                if($client_id == $search_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

    }








?>

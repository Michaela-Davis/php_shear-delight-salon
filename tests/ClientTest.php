<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function test_save()
        {
            ///   Arrange   ///
            $id = 1;
            $client_name = "Michaela";
            $phone = "4068990000";
            $stylist_id = 1;
            $new_client = new Client($id, $client_name, $phone, $stylist_id);
            $new_client->save();

            ///   Act   ///
            $result = Client::getAll();

            ///   Assert   ///
            $this->assertEquals([$new_client], $result);
        }

        function test_getAll()
        {
            ///   Arrange   ///
            $id = 1;
            $client_name = "Michaela";
            $phone = "4068990000";
            $stylist_id = 1;
            $new_client = new Client($id, $client_name, $phone, $stylist_id);
            $new_client->save();

            $id2 = 2;
            $client_name2 = "Dawn";
            $phone2 = "5038990000";
            $stylist_id2 = 2;
            $new_client2 = new Client($id2, $client_name2, $phone2, $stylist_id2);
            $new_client2->save();

            ///   Act   ///
            $result = Client::getAll();

            ///   Assert   ///
            $this->assertEquals([$new_client2, $new_client], $result);
        }

        function test_findClient()
        {
            ///   Arrange   ///
            $id = 1;
            $client_name = "Michaela";
            $phone = "4068990000";
            $stylist_id = 1;
            $new_client = new Client($id, $client_name, $phone, $stylist_id);
            $new_client->save();

            $id2 = 2;
            $client_name2 = "Dawn";
            $phone2 = "5038990000";
            $stylist_id2 = 2;
            $new_client2 = new Client($id2, $client_name2, $phone2, $stylist_id2);
            $new_client2->save();

            /// Act   ///
            $result = Client::findClient($new_client->getClientId());

            /// Assert ///
            $this->assertEquals($new_client, $result);
        }

        function test_updateClient()
        {
            $id = null;
            $client_name = "Michaela";
            $phone = "4068990000";
            $stylist_id = 1;
            $test_client = new Client($id, $client_name, $phone, $stylist_id);
            $test_client->save();

            $new_value = "4068991111";

            /// Act   ///
            $test_client->updateClient($new_value, $phone);

            /// Assert ///
            $this->assertEquals("4068991111", $test_client->getClientName());
        }

        function test_deleteClient()
        {
            $id = null;
            $client_name = "Michaela";
            $phone = "4068990000";
            $stylist_id = 1;
            $test_client = new Client($id, $client_name, $phone, $stylist_id);
            $test_client->save();

            $id2 = null;
            $client_name2 = "Dawn";
            $phone2 = "5038990000";
            $stylist_id2 = 2;
            $test_client2 = new Client($id2, $client_name2, $phone2, $stylist_id2);
            $test_client2->save();

            $test_client->deleteClient();

            $this->assertEquals([$test_client2], Client::getAll());
        }

    }
?>

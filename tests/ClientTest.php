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

        // function test_getAll()
        // {
        //     ///   Arrange   ///
        //     $id = 1;
        //     $client_name = "Michaela";
        //     $phone = "4068990000";
        //     $stylist_id = 1;
        //     $new_client = new Client($id, $client_name, $phone, $stylist_id);
        //     $new_client->save();
        //
        //     $id = 2;
        //     $client_name2 = "Dawn";
        //     $phone2 = "5038990000";
        //     $stylist_id2 = 2;
        //     $new_client2 = new Client($id, $client_name2, $phone2, $stylist_id2);
        //     $new_client2->save();
        //
        //     ///   Act   ///
        //     $result = Client::getAll();
        //
        //     ///   Assert   ///
        //     $this->assertEquals([$new_client, $new_client2], $result);
        // }

        // function test_findClient()
        // {
        //     ///   Arrange   ///
        //     $client_name = "Michaela";
        //     $phone = "4068990000";
        //     $stylist_id = 1;
        //     $new_client = new Client($id, $client_name, $phone, $stylist_id);
        //     $new_client->save();
        //
        //     $client_name2 = "Dawn";
        //     $phone2 = "5038990000";
        //     $stylist_id2 = 2;
        //     $new_client2 = new Client($id, $client_name2, $phone2, $stylist_id2);
        //     $new_client2->save();
        //
        //     /// Act   ///
        //     $result = Client::findClient($new_client->getClientId());
        //
        //     /// Assert ///
        //     $this->assertEquals($new_client, $result);
        // }

        // function test_updateClient()
        // {
        //     $client_name = "Michaela";
        //     $phone = "4068990000";
        //     $stylist_id = 1;
        //     $id = null;
        //     $test_client = new Client($id, $client_name, $phone, $stylist_id);
        //     $new_client->save();
        //
        //     $new_value = "4068991111";
        //
        //     /// Act   ///
        //     $test_client->updateClient($new_value, $phone);
        //
        //     /// Assert ///
        //     $this->assertEquals("4068991111", $test_client->getClientName());
        // }

        // function test_DeleteClient()
        // {
        //     $restaurant_name = "Matador";
        //     $address = "1234 N Peach Lane, Portland OR";
        //     $keywords = "yummy, cheap, spicy";
        //     $cuisine_id = 1;
        //     $id = null;
        //     $test_restaurant = new Client($restaurant_name, $address, $keywords, $cuisine_id, $id);
        //     $test_restaurant->save();
        //
        //     $restaurant_name2 = "Sivalai Thai";
        //     $address2 = "5678 W Bark Road, Portland OR";
        //     $keywords2 = "pricy, friendly";
        //     $cuisine_id2 = 2;
        //     $new_restaurant2 = new Client($restaurant_name2, $address2, $keywords2, $cuisine_id2);
        //     $new_restaurant2->save();
        //
        //     $test_restaurant->deleteClient();
        //
        //     $this->assertEquals([$new_restaurant2], Client::getAll());
        // }

    }
?>

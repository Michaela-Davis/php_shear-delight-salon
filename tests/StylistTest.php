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

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Stylist::deleteAll();

        }

        function test_save()
        {
            ///   Arrange   ///
            $stylist_name = "Vicki";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            ///   Act   ///
            $result = Stylist::getAll();

            ///   Assert   ///
            $this->assertEquals([$new_stylist], $result);
        }

        function test_getAll()
        {
            ///   Arrange   ///
            $stylist_name = "Vicki";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "Sami";
            $new_stylist2 = new Stylist($stylist_name);
            $new_stylist2->save();

            ///   Act   ///
            $result = Stylist::getAll();

            ///   Assert   ///
            $this->assertEquals([$new_stylist, $new_stylist2], $result);
        }


    }
?>

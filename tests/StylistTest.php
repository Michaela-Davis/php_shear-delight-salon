<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    // require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        function test_save()
        {
            $stylist_name = "Vicki";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "Sami";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$new_stylist, $new_stylist2], $result);
        }


    }
?>

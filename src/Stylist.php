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

    }
?>

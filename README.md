# _Shear Delight Salon_

#### _This web page allows a user to add stylists, and for each stylist, add clients who see that stylist, 23 February 2017_

#### By _**Michaela Davis**_

## Description

_This web page (created using MySQL, Silex, and Twig) allows a user to input a client, view clients, input a stylist to search, and update or delete a client._

## Setup/Installation Requirements

* Ensure [composer](https://getcomposer.org/) is installed on your computer.
* Ensure [MAMP](https://www.mamp.info/en/) is installed on your computer.

* In terminal run the following commands:

1. _Fork and clone this repository from_ [gitHub](https://github.com/Michaela-Davis/php_shear-delight-salon.git).
2. Click the Import tab in myPHPAdmin and choose your database file then click `Go`. Ensure MAMP is pointed is at the root directory.
3. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: `composer install`.
4. To run tests enter `composer test` in terminal.
5. Create a local server in the /web directory within the project folder using the command: php -S localhost:8000 (assuming you are using a mac), or php -S localhost:8888 (if using windows).
6. Open the directory http://localhost:8000/ (if on a mac) or http://localhost:8888/ (if on windows pc) in any standard web browser.

## Specifications

|    *Behavior*   |    *Input 1*    |     *Output*    |
|-----------------|-----------------|-----------------|
| A user clicks on a stylist | click on "Vicki" | Vicki stylist page appears with a list of her clients. |
| A user clicks on a client | click on "Michaela" | Michaela client page appears with her details |
| A user enters a new stylist | type in "Sami" | Stylist page reloads with "Sami" listed as a stylist |
| A user enters a new client | type in "Michaela Davis, 1111 SE Stark St, Portland, OR, 406-899-0000" | Client page reloads with "Michaela" listed as a client |
| A user clicks "delete" button on an existing client page | click "delete" on Michaela page | Page reloads with specific stylist page |
| A user clicks "edit" button on an existing client page | enters "Dawn" | Client page reloads with "Dawn listed as a restaurant instead of "Michaela"|

## Known Bugs

_None so far._

## Support and contact details

_Please contact michaela.delight@gmail.com with concerns or comments._

## Technologies Used

* _Composer_
* _CSS_
* _HTML_
* _MySQL_
* _PHP_
* _PHPUnit_
* _Silex_
* _Twig_

### License

*MIT license*

Copyright (c) 2017 **_Michaela Davis_**

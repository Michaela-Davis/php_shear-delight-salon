<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/home", function() use ($app) {
        $blank_form = array();
        return $app['twig']->render('homeView.html.twig', array('stylists'=> Stylist::getAll(), 'blank_form' => $blank_form));
    });

    ///////////      begin STYLIST ROUTES       ///////////
    $app->post("/add-stylist", function() use ($app) {
        $new_stylist_name = $_POST['name'];
        $new_stylist_name = str_replace("'", "", $new_stylist_name);
        $blank_form = array();
        if (!$new_stylist_name) {
            array_push($blank_form, "empty");
        } else {
            $new_stylist = new Stylist($new_stylist_name);
            $new_stylist->save();
        }

        return $app['twig']->render('homeView.html.twig', array('stylists'=> Stylist::getAll(), 'blank_form' => $blank_form));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $search_stylist = Stylist::findStylist($id);
        $blank_form = array();
        return $app['twig']->render('stylist.html.twig', array('stylist' => $search_stylist, 'clients' => $search_stylist->getClients(), 'blank_form' => $blank_form));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::findStylist($id);
        return $app['twig']->render('stylistEdit.html.twig', array('stylist' => $stylist));
    });

    $app->post("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::findStylist($id);
        return $app['twig']->render('stylistEdit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $this_stylist = Stylist::findStylist($id);
        $this_stylist->updateStylist($name);
        $blank_form = array();
        return $app['twig']->render('homeView.html.twig', array('stylist' => $this_stylist, 'stylists' => Stylist::getAll(), 'blank_form' => $blank_form));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::findStylist($id);
        $stylist->deleteStylist();
        $blank_form = array();
        return $app['twig']->render('homeView.html.twig', array('stylists' => Stylist::getAll(), 'blank_form' => $blank_form));
    });
    ///////////      end STYLIST ROUTES       ///////////


    ///////////      begin Client ROUTES       ///////////
    $app->post("/add-client", function() use ($app) {
        $id = null;
        $new_client_name = $_POST['name'];
        $new_client_name = str_replace("'", "", $new_client_name);
        $new_client_phone = $_POST['phone'];
        $blank_form = array();
        if (!$new_client_name || !$new_client_phone) {
            array_push($blank_form, "empty");
        } else {
            $new_client = new Client($id, $new_client_name, $new_client_phone, $_POST['stylist_id']);
            $new_client->save();
        }
        $stylist = Stylist::findStylist($_POST['stylist_id']);
        return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients(), 'blank_form' => $blank_form));
    });

    $app->get("/clients/{id}", function($id) use ($app) {
        $search_client = Client::findClient($id);
        return $app['twig']->render('client.html.twig', array('client' => $search_client));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::findClient($id);
        $stylist = Stylist::findStylist($id);
        return $app['twig']->render('clientEdit.html.twig', array('client' => $client, 'stylist' => $stylist));
    });

    $app->post("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::findClient($id);
        return $app['twig']->render('clientEdit.html.twig', array('client' => $client));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $this_client = Client::findClient($id);
        $this_client->updateClient($name, $phone);
        $stylist = Stylist::findStylist($this_client->getStylistId());
        $blank_form = array();
        return $app['twig']->render('stylist.html.twig', array('client' => $this_client, 'clients' => $stylist->getClients(), 'stylist' => $stylist, 'blank_form' => $blank_form));
    });

    $app->delete("/clients/{id}", function($id) use ($app) {
        $client = Client::findClient($id);
        $client_stylist_id = $client->getStylistId();
        $stylist = Stylist::findStylist($client_stylist_id);
        $client->deleteClient();
        $blank_form = array();
        return $app['twig']->render('stylist.html.twig', array('clients' => $stylist->getClients(), 'stylist' => $stylist, 'blank_form' => $blank_form));
    });

    ///////////      end Client ROUTES       ///////////

    return $app;
?>

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

    return $app;
?>

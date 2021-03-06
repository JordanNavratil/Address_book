<?php
        require_once __DIR__."/../vendor/autoload.php";
        require_once __DIR__."/../src/People.php";

        session_start();
        if (empty($_SESSION['address_book']))
        {
            $_SESSION['address_book'] = array();
        };

        $app = new Silex\Application();
        $app['debug'] = true;
        $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
        ));

        $app->get("/", function() use ($app) {
            return $app['twig']->render('address_book.html.twig', array('people' => People::getAll()));
        });

        $app->post("/people", function() use ($app) {
            $person = new People($_POST['name'], $_POST['phone_number'], $_POST['address']);
            $person->save();
            return $app['twig']->render('add_contact.html.twig', array('newperson' => $person));

        });

        $app->post("/delete_all", function() use ($app){
            People::deleteAll();
            return $app['twig']->render('delete_all.html.twig');
        });

        return $app;

?>

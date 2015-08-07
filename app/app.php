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

        //error message says no route found for "get/people...allow:POST...but I did POST..?"
        $app->post("/people", function() use ($app) {
            $person = new Person($_POST['name'], $_POST['phone_number'], $_POST['address']);
            $person->save();
            return $app['twig']->render('add_contact.html.twig', array('newcontact' => $person));

        });

        //error message the same as for /people
        $app->post("/delete_contacts", function() use ($app){
            People::deleteAll();
            return $app('twig')->render('delete_contacts.html.twig');
        });

        return $app;

?>

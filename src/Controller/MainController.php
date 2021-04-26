<?php
/**
 * Created by PhpStorm.
 * User: alexkizyma
 * Date: 4/22/21
 * Time: 12:44 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{

    public function index()
    {
        return $this->render('pages/index.html.twig');
    }

    /**
     * @return Response
     */
    public function getWords()
    {
        $cloudWords = [
            'Awesome',
            'String',
            'Internet',
            'Search',
            'Internet',
            'Facebook',
            'Image',
            'Website',
            'Develop',
            'Men',
            'Dog',
            'Link',
            'Virus',
            'Team',
            'Box',
            'Gym',
            'Support',
            'Phone',
            'Style',
            'Macbook',
            'Mouse',
            'Boat',
            'Form',
            'People',
            'Books',
            'Women',
            'Girl',
            'Kids',
            'Favorite',
            'Mashine',
            'Pen',
            'Action',
            'Verbs',
            'Say',
            'Take',
            'Tell',
            'Children',
            'Spell',
            'Steal',
            'Chose',
            'Viber',
            'Telegram',
            'Facebook',
            'Family',
            'Job',
            'Library',
            'Iphone',
            'Watch',
            'Car',
            'Light',
        ];

        $response = new Response(json_encode($cloudWords));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

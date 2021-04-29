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
            0 => [ 'id' => 11, 'word' => 'et', 'searches' => 995 ],
            1 => [ 'id' => 50, 'word' => 'vel', 'searches' => 990 ],
            2 => [ 'id' => 65, 'word' => 'repellat', 'searches' => 985 ],
            3 => [ 'id' => 79, 'word' => 'eos', 'searches' => 980 ],
            4 => [ 'id' => 73, 'word' => 'repudiandae', 'searches' => 979 ],
            5 => [ 'id' => 43, 'word' => 'adipisci', 'searches' => 978 ],
            6 => [ 'id' => 86, 'word' => 'doloremque', 'searches' => 962 ],
            7 => [ 'id' => 83, 'word' => 'optio', 'searches' => 952 ],
            8 => [ 'id' => 63, 'word' => 'autem', 'searches' => 931 ],
            9 => [ 'id' => 8, 'word' => 'et', 'searches' => 927 ],
            10 => [ 'id' => 19, 'word' => 'non', 'searches' => 894 ],
            11 => [ 'id' => 80, 'word' => 'eius', 'searches' => 882 ],
            12 => [ 'id' => 10, 'word' => 'deleniti', 'searches' => 881 ],
            13 => [ 'id' => 99, 'word' => 'sint', 'searches' => 852 ],
            14 => [ 'id' => 32, 'word' => 'hic', 'searches' => 842 ],
            15 => [ 'id' => 54, 'word' => 'dolores', 'searches' => 840 ],
            16 => [ 'id' => 41, 'word' => 'alias', 'searches' => 839 ],
            17 => [ 'id' => 90, 'word' => 'voluptas', 'searches' => 825 ],
            18 => [ 'id' => 78, 'word' => 'quia', 'searches' => 817 ],
            19 => [ 'id' => 36, 'word' => 'quasi', 'searches' => 805 ],
            20 => [ 'id' => 49, 'word' => 'eum', 'searches' => 798 ],
            21 => [ 'id' => 75, 'word' => 'quia', 'searches' => 793 ],
            22 => [ 'id' => 4, 'word' => 'veritatis', 'searches' => 787 ],
            23 => [ 'id' => 7, 'word' => 'earum', 'searches' => 785 ],
            24 => [ 'id' => 5, 'word' => 'natus', 'searches' => 780 ],
            25 => [ 'id' => 97, 'word' => 'natus', 'searches' => 778 ],
            26 => [ 'id' => 29, 'word' => 'itaque', 'searches' => 763 ],
            27 => [ 'id' => 24, 'word' => 'et', 'searches' => 752 ],
            28 => [ 'id' => 27, 'word' => 'quam', 'searches' => 721 ],
            29 => [ 'id' => 100, 'word' => 'eligendi', 'searches' => 693 ],
            30 => [ 'id' => 40, 'word' => 'eos', 'searches' => 676 ],
            31 => [ 'id' => 14, 'word' => 'porro', 'searches' => 667 ],
            32 => [ 'id' => 61, 'word' => 'reprehenderit', 'searches' => 664 ],
            33 => [ 'id' => 20, 'word' => 'cupiditate', 'searches' => 663 ],
            34 => [ 'id' => 37, 'word' => 'est', 'searches' => 655 ],
            35 => [ 'id' => 96, 'word' => 'quia', 'searches' => 652 ],
            36 => [ 'id' => 44, 'word' => 'molestias', 'searches' => 648 ],
            37 => [ 'id' => 17, 'word' => 'voluptatem', 'searches' => 645 ],
            38 => [ 'id' => 38, 'word' => 'aliquid', 'searches' => 640 ],
            39 => [ 'id' => 60, 'word' => 'quis', 'searches' => 640 ],
            40 => [ 'id' => 39, 'word' => 'itaque', 'searches' => 635 ],
            41 => [ 'id' => 67, 'word' => 'quis', 'searches' => 634 ],
            42 => [ 'id' => 30, 'word' => 'aliquam', 'searches' => 585 ],
            43 => [ 'id' => 15, 'word' => 'architecto', 'searches' => 581 ],
            44 => [ 'id' => 47, 'word' => 'nam', 'searches' => 568 ],
            45 => [ 'id' => 55, 'word' => 'sint', 'searches' => 566 ],
            46 => [ 'id' => 16, 'word' => 'at', 'searches' => 555 ],
            47 => [ 'id' => 57, 'word' => 'laborum', 'searches' => 543 ],
            48 => [ 'id' => 69, 'word' => 'inventore', 'searches' => 543 ],
            49 => [ 'id' => 95, 'word' => 'ratione', 'searches' => 54 ]
        ];

        $response = new Response(json_encode($cloudWords));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function search()
    {
        return $this->render('pages/search.html.twig');
    }
}

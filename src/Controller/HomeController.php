<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller{
    
    /**
     * @Route("/")
     * @Route("/home")
     */
    public function home(){
       return $this->render('home.html.twig');
    }
  
}

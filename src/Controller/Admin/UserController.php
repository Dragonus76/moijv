<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/admin/user", name="list_user")
     */
    public function getList(UserRepository $userRepo)
    {
        // notre repository est "injecté" en paramètre de l'action (la méthode) de notre controleur. $userRepo contient donc une instance (un objet) prêt
        // à l'emploi de class UserRepository. Cet objet nous sert à récuperer notre liste d'utilisateur.
        $users = $userRepo->findAll();
        return $this->render('admin/list_user.html.twig', [
                'users' => $users]);//render() sert à faire apparaitre une vue, le html
    }
    
    /**
     * @Route("/admin/user/{id}",name="user_details")
     */
    public function details(User $user){
       
        
        return $this->render('admin/details_user.html.twig',[
            'user' => $user
        ]);
    }
}
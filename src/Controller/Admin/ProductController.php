<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\Tag;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller {

    /**
     * 
     * @Route("/admin/product", name="list_product")
     */
    public function getList(ProductRepository/* non la classe  */ $productRepo/* instanciation de l'objet */) {
// cela equivaut à $userRepo = new \App\Respository\UserRepository();
// notre repository est "injecté" en paramètre de l'action (la méthode de notre controller. $userRepo contient donc une instance 
//(un objet) prêt à l'emploi de la class UserRepository
// Cet objet nous sert à récupérer notre liste d'utilisateurs.
        $products = $productRepo->findAllWithTags();
        return $this->render('admin/list_product.html.twig', [
                    /* @var $products type */
                    'products' => $products
        ]); // le render permet simplement d'afficher une vue
    }

    /**
     * @Route("/admin/product/{id}", name="product_details")
     */
    public function detail(Product $product) {

        // public function detail(UserRepository $userRepo, $id){}
        //$user = $userRepo->find($id);
        return $this->render('admin/details_product.html.twig', [
                    'product' => $product
        ]);
    }

    /**
     * @Route("/admin/product/tag/{name}", name="list_product_by_tag")
     */
    public function getListByTag(Tag $tag) {
// cela equivaut à $userRepo = new \App\Respository\UserRepository();
// notre repository est "injecté" en paramètre de l'action (la méthode de notre controller. $userRepo contient donc une instance 
//(un objet) prêt à l'emploi de la class UserRepository
// Cet objet nous sert à récupérer notre liste d'utilisateurs.
        $products = $tag->getProducts();
        return $this->render('admin/list_product_by_tag.html.twig', [
            'products'=> $products,
            'tag' => $tag    
        ]);
    }
    
/**
     * @Route("/admin/product/tag2/{name}", name="list_product_by_tag2")
     */
    public function getListByTag2(Tag $tag, ProductRepository $productRepo) {
// cela equivaut à $userRepo = new \App\Respository\UserRepository();
// notre repository est "injecté" en paramètre de l'action (la méthode de notre controller. $userRepo contient donc une instance 
//(un objet) prêt à l'emploi de la class UserRepository
// Cet objet nous sert à récupérer notre liste d'utilisateurs.
        $products = $productRepo->findByTagWithTags($tag);
        return $this->render('admin/list_product_by_tag.html.twig', [
            'products'=> $products,
            'tag' => $tag    
        ]);
    }    
}

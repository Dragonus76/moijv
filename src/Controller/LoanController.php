<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class LoanController extends Controller {

    /**
     * @Route("/add/product", name="add_product")
     */
    public function addProduct(ObjectManager $manager, Request $request) {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez être connecté pour accéder à cette page');
        $product = new Product();
        
        $form = $this->createForm(ProductType::class,$product)
                ->add('Envoyer', SubmitType::class);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            //upload du fichier image 
            
            $image = $product->getImage();
            $filename = md5(uniqid()).'.'.$image->guessExtension();
            // move upload_file
            $image->move('uploads/product', $filename);
            $product->setImage($filename);
            $product->SetUser($this->getUser());
            //enregistrement du produit
            $manager->persist($product);
            $manager->flush();
            return $this->redirectToRoute('my_products');
        }
        


        return $this->render('add_product.html.twig', array(
                    'form' => $form->createView()
        ));
    }
    /**
     * @Route("/product",name="my_products")
     */
public function myProduct(){
    $this->denyAccessUnlessGranted('ROLE_USER',null,'Vous devez étre connecté a cette page');
    
    return $this->render('my_product.html.twig');
    
}
}

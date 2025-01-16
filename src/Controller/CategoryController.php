<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{

        public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly CategoryRepository $repo
    ){}

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $this->repo->findAll()
        ]);
    }

    #[Route('/categorie/{id}', name: 'app_categories')]
    public function show(int $id): Response
    {
        return $this->render('category/category.html.twig', [
            'category' => $this->repo->find($id)
        ]);
    }

    #[Route('/categoryf', name: 'app_categories_form')]
    public function form(Request $request): Response
    {
        $categor = new Category();

        $form = $this->createForm(CategoryType::class, $categor);

        $form->handleRequest($request);

    if ($form->isSubmitted()) {

        if ($this->repo->findOneBy(['libele' => $categor->getLibele()])) {
                $type = 'danger';
                $message = "La category existe déjà";
        } else {

            $this->em->persist($categor);
            $this->em->flush();

                $type = 'success';
                $message = "Categorie bien ajoutée ! ";
            return $this->redirectToRoute('app_category');

        }
        $this->addFlash($type,$message);
    }
        return $this->render('category/createCat.html.twig', [
            'formulaire' => $form->createView(),
        ]);
    }
}

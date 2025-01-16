<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Form\ArticleType;

class ArticleController extends AbstractController
{
    public function __construct(private readonly ArticleRepository $repo,        private readonly EntityManagerInterface $em,){}

    #[Route('/articles', name: 'app_article')]
    public function showAll(): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $this->repo->findAll(),
        ]);
    }


    #[Route('/article/{id}', name: 'app_article_bis')]
    public function show(int $id): Response
    {
        return $this->render('article/article.html.twig', [
            'article' => $this->repo->find($id)
        ]);
    }

#[Route('/articleAdd', name: 'app_article_new')]
public function create(Request $request): Response
{
    $article = new Article();

    $form = $this->createForm(ArticleType::class, $article);

    $form->handleRequest($request);

    if ($form->isSubmitted()) {

        $newArticle = $this->repo->findOneBy([
            'title' => $article->getTitle(),
            'content' => $article->getContent()
        ]);

        if ($newArticle) {
            $type = "erreur";
            $message = "titre déjà pris";

        } else {

            $article->setCreateAt(new \DateTimeImmutable());

            $this->em->persist($article);
            $this->em->flush();

            $type = "success";
            $message = "Article créé.";
            
            return $this->redirectToRoute('app_article');

        }
        $this->addFlash($type,$message);
    }

    return $this->render('article/new.html.twig', [
        'form' => $form->createView(),
    ]);
}


}

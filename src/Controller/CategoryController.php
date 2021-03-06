<?php


namespace App\Controller;


use App\Entity\Category;
use App\Entity\Program;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @return Response
     * @route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories]
        );
    }

    /**
     * @route("/{categoryName}", name="show")
     * @param string $categoryName
     * @return Response
     */
    public function show(string $categoryName):Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        if($category){
            $programs = $this->getDoctrine()
                ->getRepository(Program::class)
                ->findBy(['category' => $category], ['id' => 'DESC'],3
                );
        }

        if (!$category) {
            throw $this->createNotFoundException(
                'catégorie { $categoryName } introuvable'
            );
        }

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'programs' => $programs
        ]);

    }

}
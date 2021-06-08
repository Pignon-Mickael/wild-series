<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    /**
     * @route ("/new", name="new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();
            return $this->redirectToRoute('category_show', [ 'categoryName'=> $program->getCategory()->getName()]);
        }
        return $this->render('program/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @param Program $program
     * @return Response
     */

    public function show(Program $program): Response
    {
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    /**
     * @route("/{program<^[0-9]+$>}/seasons/{season<^[0-9]+$>}", methods={"GET"}, name="season_show")
     * @param Program $program
     * @param Season $season
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {
        return $this->render('program/show_season.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }

    /**
     * @route("/{program}/comment/{comment}", name="show_comment")
     */
    public function showProgramComment(Program $program, Comment $comment): Response
    {
        return $this->render('program/comment.html.twig', [
            'program' => $program,
            'comment' => $comment
        ]);
    }

    /**
     * @route("/{program}/seasons/{season}/episodes/{episode}", name="episode_show")
     * @param Program $program
     * @param Season $season
     * @param Episode $episode
     * @return Response
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }
}
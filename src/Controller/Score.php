<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Encounter;
use App\Form\ScoreFormType;
use App\Repository\EncounterRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class Score
{
    #[Route(path: '/encounters/{encounter}/score', name: 'score')]
    public function __invoke(
        Encounter $encounter,
        Environment $twig,
        FormFactoryInterface $formFactory,
        Request $request,
        EncounterRepository $encounterRepository,
        RouterInterface $router
    ) {
        $formBuilder = $formFactory->createBuilder();
        $formBuilder
            ->add(
                'scorePlayerA', ScoreFormType::class, ['encounter' => $encounter]
            )
            ->add(
                'scorePlayerB', ScoreFormType::class, ['encounter' => $encounter]
            )
            ->add('submit', SubmitType::class)
        ;

        $form = $formBuilder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encounter->setScores(...$form->getData());
            $encounter->setStatus(Encounter::STATUS_OVER);

            $encounterRepository->flush();

            return new RedirectResponse($router->generate('lobby'));
        }

        return new Response(
            $twig->render(
                'encounter/score.html.twig',
                ['encounter' => $encounter, 'form' => $form->createView()])
        );
    }
}

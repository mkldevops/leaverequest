<?php

namespace App\Controller;

use App\Entity\LeaveRequest;
use App\Form\LeaveRequestType;
use App\Entity\Enum\StatusEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function __invoke(Request $request, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = new LeaveRequest();
        $form = $this->createForm(LeaveRequestType::class, $leaveRequest);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $leaveRequest->setUser($this->getUser());
            $leaveRequest->setStatus(StatusEnum::SUBMITTED);
            $entityManager->persist($leaveRequest);
            $entityManager->flush();

            $this->addFlash('success', 'Your leave request has been submitted');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home.html.twig', [
            'form' => $form,
        ]);
    }
}

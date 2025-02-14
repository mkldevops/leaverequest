<?php

namespace App\Controller;

use App\Repository\LeaveRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LeaveRequestController extends AbstractController
{
    #[Route('/leave-request', name: 'app_leave_request')]
    public function __invoke(LeaveRequestRepository $leaveRequestRepository): Response
    {
        $leaveRequests = $leaveRequestRepository->findBy(
            ['user' => $this->getUser()],
            ['startDate' => 'DESC'],
        );

        return $this->render('leave_request.html.twig', [
            'leave_requests' => $leaveRequests,
        ]);
    }
}

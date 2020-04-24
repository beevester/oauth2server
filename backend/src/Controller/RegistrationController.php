<?php

namespace App\Controller;

use App\Model\ConfirmRegistrationHandler;
use App\Model\CreateUserHandler;
use App\Model\ExecuteCreateUser;
use App\Model\ExecuteRegisterConfirmation;
use App\Model\ExecuteRegisterUser;
use App\Model\RegisterUserHandler;
use Exception as ExceptionAlias;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/signup")
 */
class RegistrationController extends AbstractController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * RegistrationController constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("", name="user_create")
     * @param Request $request
     * @param RegisterUserHandler $handler
     * @return JsonResponse
     */
    public function registration(Request $request, CreateUserHandler $handler): JsonResponse
    {
        /** @var ExecuteRegisterUser $data */
        $data = $this->serializer->deserialize($request->getContent(), ExecuteCreateUser::class, 'json');

        $handler->handle($data);

        return $this->json([], JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/confirm", name="confirm_token", methods={"POST"})
     * @param Request $request
     * @param ConfirmRegistrationHandler $handler
     * @return JsonResponse
     * @throws ExceptionAlias
     */
    public function confirm(Request $request, ConfirmRegistrationHandler $handler): JsonResponse
    {
        /** @var ExecuteRegisterConfirmation $data */
        $data = $this->serializer->deserialize(
            $request->getContent(),
            ExecuteRegisterConfirmation::class, 'json');

        $handler->handle($data);

        return $this->json([$request->getContent()], JsonResponse::HTTP_CREATED);
    }
}

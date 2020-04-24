<?php

namespace App\Controller;

use App\Model\ChangeUserEmailHandler;
use App\Model\ChangeUserNameHandler;
use App\Model\ChangeUserPasswordHandler;
use App\Model\ExecuteChangeEmail;
use App\Model\ExecuteChangeUserName;
use App\Model\ExecuteChangeUserPassword;
use App\Model\GetProfileHandler;
use App\Query\GetProfileById;
use App\Query\ProfileView;
use App\Security\ProfileByEmail;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/profile")
 */
class ProfileController extends AbstractController
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route("", name="user_profile", methods={"GET"})
     * @param GetProfileHandler $handler
     * @return Response
     * @throws \Exception
     */
    public function show(GetProfileHandler $handler): Response
    {
        /** @var ProfileByEmail|null $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['Error' => 'User not found']);
        }

        $query = new GetProfileById((string)$user->getId());

        /** @var ProfileView $user */
        $user = $handler->handle($query);

        return $this->json(
            [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName()
            ]
        );
    }

    /**
     * @Route("/name", name="change_user_name", methods={"PATCH"})
     * @param Request $request
     * @param ChangeUserNameHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function changeName(Request $request, ChangeUserNameHandler $handler): JsonResponse
    {
        /** @var ExecuteChangeUserName $command */
        $command = $this->serializer->deserialize($request->getContent(), ExecuteChangeUserName::class, 'json');

        $handler->handle($command);

        return $this->json([], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/email", name="change_user_email", methods={"PATCH"})
     * @param Request $request
     * @param ChangeUserEmailHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function changeEmail(Request $request, ChangeUserEmailHandler $handler): JsonResponse
    {
        /** @var ExecuteChangeEmail $command */
        $command = $this->serializer->deserialize($request->getContent(), ExecuteChangeEmail::class, 'json');

        $handler->handle($command);

        return $this->json([], JsonResponse::HTTP_OK);
    }

    /**
     * @Route("/password", name="change_user_password", methods={"PATCH"})
     * @param Request $request
     * @param ChangeUserPasswordHandler $handler
     * @return JsonResponse
     * @throws Exception
     */
    public function changePassword(Request $request, ChangeUserPasswordHandler $handler): JsonResponse
    {
        /** @var ExecuteChangeUserPassword $command */
        $command = $this->serializer->deserialize($request->getContent(), ExecuteChangeUserPassword::class, 'json');

        $handler->handle($command);

        return $this->json([], JsonResponse::HTTP_OK);
    }
}

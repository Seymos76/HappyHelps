<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route(path="/register", name="register", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function register(Request $request)
    {
        /*
         * Traitement full stack
         */
        /*$user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($request->request->get('user'));
            die;
        }

        return $this->render(
            'security/register.html.twig',
            [
                'form' => $form->createView()
            ]
        );*/

        /*
         * Traitement API
         */
        if ($request->isMethod("POST")) {
            if ($request->request->get('email') !== "") {
                dump($request->request);
                $data = array(
                    'email' => $request->request->get('email'),
                    'password' => $request->request->get('password'),
                    'message' => "Requête POST reçue et request ok !"
                );
                return new JsonResponse($data, Response::HTTP_OK);
                /*$user = new User();
                $user->setEmail($request->request->get('email'));
                $user->setPassword($request->request->get('password'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $data = array(
                    'message' => "Utilisateur créé !"
                );
                return new JsonResponse($data, Response::HTTP_OK);*/
            } else {

                return new JsonResponse("Requête POST reçue mais request vide !", Response::HTTP_OK);
            }
            /*if (!$request->request->has('email') || !$request->request->has('password')) {
                return new JsonResponse("No data for registration...", Response::HTTP_OK);
            }
            $data = array(
                'email' => $request->request->get('email'),
                'password' => $request->request->get('password'),
                'message' => "Registration API !"
            );

            return new JsonResponse($data, Response::HTTP_OK);*/
            return new JsonResponse("Requête POST reçue !", Response::HTTP_OK);
        } else {
            return new JsonResponse("Méthode non POST", Response::HTTP_OK);
        }

    }
}

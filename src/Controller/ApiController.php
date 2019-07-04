<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Post(
     *     path = "/api/post/{routeName}",
     *     name = "entity_post"
     * )
     */
    public function postAction($routeName, Request $request)
    {
        if ($request->query->get('token')) {
            $user = $this->em->getRepository(User::class)
                ->findOneBy(['apiToken' => $request->query->get('token')]);

            if ($user !== null) {
                $user = new User();
                $user->setId($request->get('id'))
                    ->setUsername($request->get('username'))
                    ->setEmail($request->get('email'))
                    ->setEnabled(true);

                $this->em->persist($user);
                $this->em->flush();

                return new Response($user);
            } else {
                return new Response('You have no rights access');
            }
        }
    }

    /**
     * @Get(
     *     path = "/api/{routeName}",
     *     name = "entity_show_all"
     * )
     * @View()
     */
    public function showAllAction($routeName)
    {
        $apiConfig = $this->getApiConfig($routeName, 'showAll');

        if ($apiConfig !== false) {
            $entityPath = "App\\Entity\\" . $apiConfig['name'];
            $entityObject = $this->getDoctrine()->getRepository($entityPath)->findAll();

            return $this->serializeContent($entityObject);
        }

        throw new NotFoundHttpException();
    }

    /**
     * @Get(
     *     path = "/api/{routeName}/{id}",
     *     name = "entity_show_one",
     *     requirements={"id"="\d+"}
     * )
     * @View()
     */
    public function showOneAction($routeName, $id)
    {
        $apiConfig = $this->getApiConfig($routeName, 'showOne');

        if ($apiConfig !== false) {
            $entityPath = "App\\Entity\\" . $apiConfig['name'];
            $entityObject = $this->getDoctrine()->getRepository($entityPath)->findOneBy(array('id' => $id));

            return $this->serializeContent($entityObject);
        }

        throw new NotFoundHttpException();
    }

    public function getApiConfig($routeName, $routeType)
    {
        $apiConfig = Yaml::parseFile('../config/api.yaml');

        foreach ($apiConfig['api']['entities'] as $entity) {
            if (isset($entity[$routeType])) {
                if ($entity[$routeType] == $routeName) {
                    return $entity;
                }
            } else {
                // Route name of type is not defined in config
                throw new NotFoundHttpException($routeType . ' has to be defined in config/api.yaml');
            }
        }
        // API not defined for this entity
        return false;
    }

    public function serializeContent($entityObject)
    {
        $serializer = SerializerBuilder::create()->build();

        $data = $serializer->serialize($entityObject, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
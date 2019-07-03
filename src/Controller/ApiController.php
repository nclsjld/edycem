<?php

namespace App\Controller;

use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Yaml\Yaml;


class ApiController extends AbstractController
{

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
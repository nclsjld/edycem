<?php

namespace App\EventListener;

use App\Entity\Project;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Events;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\DependencyInjection\ContainerInterface;


class AdminEventSubscriber extends AbstractController implements EventSubscriberInterface
{
    protected $container;

    /**
     * AppSubscriber constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $eventManager = new EventManager();
        $eventManager->addEventListener(array(EasyAdminEvents::PRE_UPDATE), new ProjectValidateListener());
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            EasyAdminEvents::PRE_LIST => 'checkUserRights',
            EasyAdminEvents::PRE_EDIT => 'checkUserRights',
            EasyAdminEvents::PRE_SHOW => 'checkUserRights',
            EasyAdminEvents::PRE_NEW => 'checkUserRights',
            EasyAdminEvents::PRE_DELETE => 'checkUserRights',

        );
    }

    /**
     * show an error if user is not superadmin and tries to manage restricted stuff
     *
     * @param GenericEvent $event event
     * @return null
     * @throws AccessDeniedException
     */
    public function checkUserRights(GenericEvent $event)
    {
        $authorization = $this->container->get('security.authorization_checker');

        // if super admin, allow all
        if ($authorization->isGranted('ROLE_SUPER_ADMIN')) {
            return;
        }

        $request = $this->container->get('request_stack')->getCurrentRequest()->query;
        $entity = $request->get('entity');
        $action = $request->get('action');

        $config = $this->container->get('easyadmin.config.manager')->getBackendConfig();
        // check for permission for each action
        foreach ($config['entities'] as $k => $v) {
            if ($entity == $k && !$authorization->isGranted($v[$action]['role'])) {
                throw new AccessDeniedException();
            }
        }
    }

    public function onValidateProject(GenericEvent $event)
    {
        if ($event->getSubject() instanceof Project) {
            $em = $this->getDoctrine()->getEntityManager();
            $uow = $em->getUnitOfWork();
            $uow->computeChangeSet($em->getClassMetadata(get_class($event->getSubject())), $event->getSubject());

            $newValidate = $event->getSubject()->getIsValidate();
            var_dump($event->hasChangedField('isValidate'));

            $isValidateChange = isset($uow->getEntityChangeSet($event->getSubject())['isValidate']);
            if ($isValidateChange && $newValidate === true) {
                $project = $em->getRepository('App\Entity\Project')->findOneBy(['id' => $event->getSubject()->getId()]);
                $project->setName($event->getSubject()->getName());
                $project->setCreatedAt(new \DateTime(date("Y-m-d H:i:s")));
            }
        }
        return;

    }
}
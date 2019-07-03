<?php

namespace App\Service;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class NotificationHandler
{
    private $logger;
    private $mailer;
    private $twig;
    private $container;

    public function __construct(LoggerInterface $logger, \Swift_Mailer $mailer, \Twig_Environment $twig, ContainerInterface $container){
        $this->logger = $logger;
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->container = $container;
    }

    /**
     * Send notification message
     * @param $templateName
     * @param $context
     * @param $attachments
     *
     * @throws \Throwable
     * @return Boolean
     */
    public function sendMessage($templateName, $context, $toEmail = null, $attachments = array())
    {
        try{
            $template = $this->twig->load($templateName);
            $subject = $template->renderBlock('subject', $context);
            $textBody = $template->renderBlock('body_text', $context);

            $htmlBody = '';

            if ($template->hasBlock('body_html', $context)) {
                $htmlBody = $template->renderBlock('body_html', $context);
            }

            $message = (new \Swift_Message())
                ->setSubject($subject)
                ->setFrom(array($this->container->getParameter('mailer_from') => $this->container->getParameter('app_title')));

            if ($toEmail == null){
                $message->setTo($this->container->getParameter('mailer_to'));
            } else {
                $message->setTo($toEmail);
            }

            if (!empty($htmlBody)) {
                $message->setBody($htmlBody, 'text/html')
                    ->addPart($textBody, 'text/plain');
            } else {
                $message->setBody($textBody);
            }

            if (sizeof($attachments) > 0){
                foreach ($attachments as $attachment){
                    $message->attach(\Swift_Attachment::fromPath($attachment['path'])
                        ->setFileName($attachment['name'])
                    );
                }
            }
            $this->logger->info("NotificationHandler.sendMessage", array("Envoi réussi"));

            return $this->mailer->send($message);
        }catch(\Exception $exception){
            $this->logger->error("NotificationHandler.sendMessage", array("Cannot send notification", $exception->getMessage()));

            return false;
        }
    }
}
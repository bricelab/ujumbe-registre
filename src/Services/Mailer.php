<?php
namespace App\Services;

use Scheb\TwoFactorBundle\Mailer\AuthCodeMailerInterface;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer implements AuthCodeMailerInterface
{
    private $engine;
    private $mailer;
    private $from;

    public function __construct(MailerInterface $mailer, Environment $engine, string $from)
    {
        $this->mailer = $mailer;
        $this->engine = $engine;
        $this->from = $from;
    }

    public function sendEmail($from, $to, $subject, $html, $priority = Email::PRIORITY_NORMAL,$text = '', $attachement = '', $attachementName = null)
    {
        $mail = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($html)
            ->replyTo($from)
            ->priority($priority);
        
        if (!empty($text)) {
            $mail->text($text);
        }
            
        if($attachementName != null && !empty($attachement)){
            if ($attachement == null) {
                $mail->attachFromPath($attachement);
            } else {
                $mail->attachFromPath($attachement, $attachementName);
            }            
        }            

        $this->mailer->send($mail);
    }

    public function createBodyMail($view, array $parameters)
    {
        return $this->engine->render($view, $parameters);
    }

    public function sendNotification($to, $subject, $body, array $context, $priority = TemplatedEmail::PRIORITY_HIGH)
    {
        //$mail = (new NotificationEmail())
        $mail = (new NotificationEmail())
            ->from($this->from)
            ->to($to)
            ->subject($subject)
            ->htmlTemplate($body)
            ->context($context)
            ->priority($priority);    

        $this->mailer->send($mail);
    }

    public function sendAuthCode(TwoFactorInterface $user): void
    {
        $authCode = $user->getEmailAuthCode();

        $body = $this->createBodyMail("emails/2fa.html.twig", [
            'authCode' => $authCode,
        ]);

        $this->sendEmail($this->from, $user->getEmailAuthRecipient(), "Two factor authentication", $body);

    }
}
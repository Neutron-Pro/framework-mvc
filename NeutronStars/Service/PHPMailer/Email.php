<?php

namespace NeutronStars\Service\PHPMailer;

use NeutronStars\View\View;
use NeutronStars\View\ViewEngine;

class Email
{
    private PHPMailer $mailer;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->initMailer();
    }

    /**
     * @throws Exception
     */
    private function initMailer(): void
    {
        $this->mailer->isSMTP();
        $this->mailer->Host       = MAIL_HOST;
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = MAIL_USER;
        $this->mailer->Password   = MAIL_PASSWORD;
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->CharSet = MAIL_CHARSET;
        $this->mailer->Port       = MAIL_PORT;
        $this->mailer->setFrom(MAIL_RECIPIENT_EMAIL, MAIL_RECIPIENT_NAME);
    }

    /**
     * @param string $to
     * @param string $name
     * @return $this
     * @throws Exception
     */
    public function add(string $to, string $name = ''): self
    {
        $this->mailer->addAddress($to, $name);
        return $this;
    }

    /**
     * @param string $subject
     * @param string $content
     * @param int $engine
     * @param array $params,
     * @param ?string $layout
     * @param bool $isHTML
     * @throws Exception
     */
    public function send(string $subject, string $content, array $params = [], ?string $layout = null, bool $isHTML = true, int $engine = VIEW_ENGINE): void
    {
        $this->mailer->isHTML($isHTML);
        $this->mailer->Subject = $subject;
        if ($isHTML) {
            $this->mailer->Body    = (new View($engine, $content, $params))->run($layout);
        } else {
            $this->mailer->Body    = $content;
        }
        $this->mailer->send();
    }
}

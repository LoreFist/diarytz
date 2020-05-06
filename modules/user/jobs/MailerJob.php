<?php

namespace app\modules\user\jobs;

use yii\base\BaseObject;
use yii\mail\MailerInterface;
use yii\mail\MessageInterface;
use yii\queue\JobInterface;

/**
 * Class MailerJob
 *
 * @package app\components
 */
class MailerJob extends BaseObject implements JobInterface {
    /** @var MessageInterface */
    public $message;

    private $mailer;

    /**
     * MailerJob constructor.
     *
     * @param MailerInterface $mailer
     * @param array           $config
     */
    public function __construct(MailerInterface $mailer, $config = []) {
        $this->mailer = $mailer;

        parent::__construct($config);
    }

    /**
     * @param \yii\queue\Queue $queue
     *
     * @return mixed|void
     */
    public function execute($queue) {
        return $this->message->send($this->mailer);
    }
}
<?php

namespace App\Service;

use App\Entity\Subscriber;
use App\Exception\SubscriberAlreadyExists;
use App\Repository\SubscriberRepository;
use App\Request\SubscriberRequest;

class SubscriberService
{
    public function __construct(
        private SubscriberRepository $subscriberRepository,
    ) { }

    public function subscribe(SubscriberRequest $request)
    {
        if ($this->subscriberRepository->existsByEmail($request->getEmail())) {
            throw new SubscriberAlreadyExists;
        }

        $subscriber = new Subscriber;
        $subscriber->setEmail($request->getEmail());

        $this->subscriberRepository->save($subscriber, true);

        return [
            'success' => true
        ];
    }
}
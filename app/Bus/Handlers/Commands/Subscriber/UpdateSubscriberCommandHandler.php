<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Bus\Handlers\Commands\Subscriber;

use CachetHQ\Cachet\Bus\Commands\Subscriber\SubscribeSubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\VerifySubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\UpdateSubscriberCommand;
use CachetHQ\Cachet\Bus\Events\Subscriber\SubscriberHasSubscribedEvent;
use CachetHQ\Cachet\Models\Component;
use CachetHQ\Cachet\Models\Subscriber;
use CachetHQ\Cachet\Models\Subscription;
use CachetHQ\Cachet\Notifications\Subscriber\VerifySubscriptionNotification;

/**
 * This is the subscribe subscriber command handler.
 *
 * @author James Brooks <james@alt-three.com>
 * @author Joseph Cohen <joe@alt-three.com>
 * @author Graham Campbell <graham@alt-three.com>
 * @author Erik Johansson
 */
class UpdateSubscriberCommandHandler
{
    /**
     * Handle the subscribe subscriber command.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\Subscriber\UpdateSubscriberCommand $command
     *
     * @return \CachetHQ\Cachet\Models\Subscriber
     */
    public function handle(UpdateSubscriberCommand $command)
    {
        $subscriber = $command->subscriber;
        $subscriber->fill($this->filter($command));

        $subscriber->save();

        return $subscriber;
    }

    /**
     * Filter the command data.
     *
     * @param \CachetHQ\Cachet\Bus\Commands\Incident\UpdateSubscriberCommand $command
     *
     * @return array
     */
    protected function filter(UpdateSubscriberCommand $command)
    {
        $params = [
            //'email'            => $command->email,
            'sms_number'     => $command->sms_number,
            //'verified'         => $command->verified,
            //'subscriptions'    => $command->subscriptions,
        ];

        return $params;

        /*
        return array_filter($params, function ($val) {
            return $val !== null;
        });
        */
    }
}

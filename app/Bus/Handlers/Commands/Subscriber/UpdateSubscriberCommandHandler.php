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

use AltThree\Validator\ValidationException;
use CachetHQ\Cachet\Bus\Commands\Subscriber\SubscribeSubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\VerifySubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\UpdateSubscriberCommand;
use CachetHQ\Cachet\Bus\Events\Subscriber\SubscriberHasSubscribedEvent;
use CachetHQ\Cachet\Models\Component;
use CachetHQ\Cachet\Models\Subscriber;
use CachetHQ\Cachet\Models\Subscription;
use CachetHQ\Cachet\Notifications\Subscriber\VerifySubscriptionNotification;
use Illuminate\Support\MessageBag;

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

        $dup = Subscriber::where('email', $command->email)->where('id', '<>', $subscriber->id)->get();

        if($dup->count() > 0) {
            throw new ValidationException(new MessageBag([trans('dashboard.subscribers.edit.error.duplicate')])); 
        } else if($subscriber->getIsVerifiedAttribute() && !$command->verified) {
            $subscriber->verified_at = null;
        } else if(!$subscriber->getIsVerifiedAttribute() && $command->verified) {
            $subscriber->verified_at = time();
        }

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
            'email'         => $command->email,
            'sms_number'    => empty($command->sms_number) ? null : $command->sms_number,
            'sms_notify'    => $command->sms_notify,
            'email_notify'  => $command->email_notify
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

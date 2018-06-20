<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Bus\Commands\Subscriber;

use CachetHQ\Cachet\Models\Subscriber;

/**
 * This is the subscribe subscriber command.
 *
 * @author James Brooks <james@alt-three.com>
 * @author Erik Johansson
 */
final class UpdateSubscriberCommand
{
    /**
     * The subscribtion to update.
     *
     * @var Subscriber
     */
    public $subscriber;

    /**
     * The subscriber email.
     *
     * @var string
     */
    public $email;

    /**
     * The subscriber phone number.
     *
     * @var number
     */
    public $sms_number;

    /**
     * The subscriber auto verification.
     *
     * @var bool
     */
    public $verified;

    /**
     * The list of subscriptions to set the subscriber up with.
     *
     * @var array|null
     */
    public $subscriptions;

    /**
     * The validation rules.
     *
     * @var array
     */
    public $rules = [
        'email' => 'nullable|email',
        'sms_number' => 'nullable|numeric'
    ];

    /**
     * Create a new subscribe subscriber command instance.
     *
     * @param Subscriber $subscriber
     * @param string     $email
     * @param bool       $verified
     * @param array|null $subscriptions
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber, $email, $sms_number, $verified = false, $subscriptions = null)
    {
        $this->subscriber = $subscriber;
        $this->email = $email;
        $this->sms_number = $sms_number;
        $this->verified = $verified;
        $this->subscriptions = $subscriptions;
    }
}

<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Http\Controllers\Dashboard;

use AltThree\Validator\ValidationException;
use CachetHQ\Cachet\Bus\Commands\Subscriber\SubscribeSubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\UnsubscribeSubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\UpdateSubscriberCommand;
use CachetHQ\Cachet\Bus\Commands\Subscriber\UpdateSubscriberSubscriptionCommand;
use CachetHQ\Cachet\Models\Subscriber;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use CachetHQ\Cachet\Models\Component;
use CachetHQ\Cachet\Models\ComponentGroup;
use CachetHQ\Cachet\Models\Subscription;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use CachetHQ\Cachet\Notifications\Subscriber\VerifySubscriptionNotification;

class SubscriberController extends Controller
{
    /**
     * Stores the sub-sidebar tree list.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * Creates a new subscriber controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return void
     */
    public function __construct()
    {
        $this->subMenu = [
            'subscribers' => [
                'title'  => trans('dashboard.subscribers.subscribers'),
                'url'    => cachet_route('dashboard.subscribers'),
                'icon'   => '',
                'active' => false,
            ],
            'sms' => [
                'title'  => trans('dashboard.subscribers.sms.sms'),
                'url'    => cachet_route('dashboard.subscribers.sms'),
                'icon'   => '',
                'active' => false,
            ],
        ];
        
        View::share([
            'subMenu'  => $this->subMenu,
            'subTitle' =>trans('dashboard.subscribers.subscribers'),
        ]);
    }

    /**
     * Shows the subscribers view.
     *
     * @return \Illuminate\View\View
     */
    public function showSubscribers()
    {
        $this->subMenu['subscribers']['active'] = true;

        return View::make('dashboard.subscribers.index')
            ->withPageTitle(trans('dashboard.subscribers.subscribers').' - '.trans('dashboard.dashboard'))
            ->withSubscribers(Subscriber::all());
    }

    /**
     * Shows the add subscriber view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddSubscriber()
    {
        return View::make('dashboard.subscribers.add')
            ->withPageTitle(trans('dashboard.subscribers.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Creates a new subscriber.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createSubscriberAction()
    {
        $verified = app(Repository::class)->get('setting.skip_subscriber_verification');

        try {
            $subscribers = preg_split("/\r\n|\n|\r/", Binput::get('email'));

            foreach ($subscribers as $subscriber) {
                execute(new SubscribeSubscriberCommand($subscriber, $verified));
            }
        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.subscribers.create')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.subscribers.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return cachet_redirect('dashboard.subscribers.create')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.subscribers.add.success')));
    }

    /**
     * Deletes a subscriber.
     *
     * @param \CachetHQ\Cachet\Models\Subscriber $subscriber
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSubscriberAction(Subscriber $subscriber)
    {
        execute(new UnsubscribeSubscriberCommand($subscriber));

        return cachet_redirect('dashboard.subscribers');
    }

    /**
     * Shows the subscribers view.
     *
     * @return \Illuminate\View\View
     */
    public function showSMSSubscribers()
    {
        $this->subMenu['sms']['active'] = true;

        return View::make('dashboard.subscribers.sms.index')
            ->withPageTitle(trans('dashboard.subscribers.sms.sms').' - '.trans('dashboard.dashboard'))
            ->withAvaibleSubscribersCount(Subscriber::whereNull('sms_number')->count())
            ->withSubscribers(Subscriber::all());
    }

    /**
     * Shows the add subscriber view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddSMSSubscriber()
    {
        return View::make('dashboard.subscribers.sms.add')
            ->withPageTitle(trans('dashboard.subscribers.sms.add.title').' - '.trans('dashboard.dashboard'))
            ->withSubscribers(Subscriber::whereNull('sms_number')->get());
    }

    /**
     * Creates a new SMS subscriber.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createSMSSubscriberAction()
    {
        try {

            $subscriber = Subscriber::where('email', '=', Binput::get('subscribers'))->first();

            if(!$subscriber) {
                throw new ValidationException(new MessageBag([trans('dashboard.subscribers.sms.add.error.not_found')])); 
            }

            dispatch(new UpdateSubscriberCommand($subscriber, 
                $subscriber->email, 
                Binput::get('sms-number'), 
                $subscriber->getIsVerifiedAttribute(), 
                $subscriber->email_notify, 
                Binput::get('sms-notify', false)
            ));

        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.subscribers.sms.add')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.subscribers.sms.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return cachet_redirect('dashboard.subscribers.sms')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.subscribers.sms.add.success')));
    }

    /**
     * Deletes a SMS subscriber.
     *
     * @param \CachetHQ\Cachet\Models\Subscriber $subscriber
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSMSSubscriberAction(Subscriber $subscriber)
    {
        dispatch(new UpdateSubscriberCommand($subscriber, 
            $subscriber->email, 
            null, 
            $subscriber->getIsVerifiedAttribute(), 
            $subscriber->email_notify, 
            $subscriber->sms_notify
        ));

        return cachet_redirect('dashboard.subscribers.sms');
    }

    /**
     * Shows the edit subscriber view.
     *
     * @return \Illuminate\View\View
     */
    public function showEditSubscriber(Subscriber $subscriber)
    {        
        $usedComponentGroups = Component::enabled()->where('group_id', '>', 0)->groupBy('group_id')->pluck('group_id');
        $componentGroups = ComponentGroup::whereIn('id', $usedComponentGroups)->orderBy('order')->get();
        $ungroupedComponents = Component::enabled()->where('group_id', '=', 0)->orderBy('order')->orderBy('created_at')->get();

        return View::make('dashboard.subscribers.edit')
            ->withPageTitle(trans('dashboard.subscribers.edit.title').' - '.trans('dashboard.dashboard'))
            ->withSubscriber($subscriber)
            ->withUngroupedComponents($ungroupedComponents)
            ->withSubscriptions($subscriber->subscriptions->pluck('component_id')->all())
            ->withComponentGroups($componentGroups);
    }

    /**
     * Edit a subscriber.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editSubscriberAction(Subscriber $subscriber)
    {
        try {
            dispatch(new UpdateSubscriberCommand($subscriber, 
                Binput::get('email'), 
                $subscriber->sms_number, 
                Binput::get('verified', false), 
                Binput::get('email-notify', false), 
                $subscriber->sms_notify
            ));

            execute(new UpdateSubscriberSubscriptionCommand($subscriber, Binput::get('subscriptions')));

        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.subscribers.edit', ['id' => $subscriber->id])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.subscribers.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return cachet_redirect('dashboard.subscribers')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.subscribers.edit.success')));
    }

    /**
     * Shows the SMS edit subscriber view.
     *
     * @return \Illuminate\View\View
     */
    public function showEditSMSSubscriber(Subscriber $subscriber)
    {
        return View::make('dashboard.subscribers.sms.edit')
            ->withPageTitle(trans('dashboard.subscribers.sms.edit.title').' - '.trans('dashboard.dashboard'))
            ->withSubscriber($subscriber);
    }

    /**
     * Edit a SMS subscriber.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editSMSSubscriberAction(Subscriber $subscriber)
    {
        try {
            dispatch(new UpdateSubscriberCommand($subscriber, 
                $subscriber->email, 
                Binput::get('sms-number'), 
                $subscriber->getIsVerifiedAttribute(), 
                $subscriber->email_notify, 
                Binput::get('sms-notify', false)
            ));

        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.subscribers.sms.edit', ['id' => $subscriber->id])
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.subscribers.sms.edit.failure')))
                ->withErrors($e->getMessageBag());
        }

        return cachet_redirect('dashboard.subscribers.sms')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.subscribers.sms.edit.success')));
    }

    /**
     * Send test SMS to subscriber.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendTestSMSToSubscriberAction(Subscriber $subscriber)
    {
        if (! ($to = $subscriber->routeNotificationFor('sms'))) {
            return cachet_redirect('dashboard.subscribers.sms.edit', ['id' => $subscriber->id])
            ->withTitle(sprintf('%s', trans('notifications.subscriber.sms.test.failure')))
            ->withErrors("No SMS number");
        }

        $client = new Client();
        $res = $client->request('GET', config('sms.url'), [
        'query' => [
                'username' => config('sms.username'),
                'password' => config('sms.password'),
                'from' => config('sms.from'),
                'to'=> $to,
                'text' => Config::get('setting.sms-test-message') ? Config::get('setting.sms-test-message') : trans('notifications.subscriber.sms.test.content')
        ]
        ]);

        return cachet_redirect('dashboard.subscribers.sms.edit', ['id' => $subscriber->id])
            ->withSuccess(sprintf('%s', trans('notifications.subscriber.sms.test.success')));

        Log::info($to . ":Send SMS:" . $message->content . ":Response:" . serialize($res));
    }

    /**
     * Send test SMS to subscriber.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendVerifyEmail(Subscriber $subscriber)
    {
        $subscriber->notify(new VerifySubscriptionNotification());

        return cachet_redirect('dashboard.subscribers.edit', ['id' => $subscriber->id])
            ->withSuccess(sprintf('%s', trans('dashboard.subscribers.edit.resend_verify_success')));
    }
}

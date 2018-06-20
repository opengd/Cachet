<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Http\Routes\Dashboard;

use Illuminate\Contracts\Routing\Registrar;

/**
 * This is the dashboard subscriber routes class.
 *
 * @author James Brooks <james@alt-three.com>
 * @author Connor S. Parks <connor@connorvg.tv>
 */
class SubscriberRoutes
{
    /**
     * Defines if these routes are for the browser.
     *
     * @var bool
     */
    public static $browser = true;

    /**
     * Define the dashboard subscriber routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function map(Registrar $router)
    {
        $router->group([
            'middleware' => ['auth'],
            'namespace'  => 'Dashboard',
            'prefix'     => 'dashboard/subscribers',
        ], function (Registrar $router) {
            $router->get('/', [
                'as'   => 'get:dashboard.subscribers',
                'uses' => 'SubscriberController@showSubscribers',
            ]);

            $router->get('create', [
                'as'   => 'get:dashboard.subscribers.create',
                'uses' => 'SubscriberController@showAddSubscriber',
            ]);
            $router->post('create', [
                'as'   => 'post:dashboard.subscribers.create',
                'uses' => 'SubscriberController@createSubscriberAction',
            ]);

            $router->delete('{subscriber}/delete', [
                'as'   => 'delete:dashboard.subscribers.delete',
                'uses' => 'SubscriberController@deleteSubscriberAction',
            ]);

            $router->get('sms', [
                'as'   => 'get:dashboard.subscribers.sms',
                'uses' => 'SubscriberController@showAddSMSSubscriber',
            ]);
            $router->post('sms', [
                'as'   => 'post:dashboard.subscribers.sms',
                'uses' => 'SubscriberController@createSMSSubscriberAction',
            ]);

            $router->delete('{subscriber}/delete/sms', [
                'as'   => 'delete:dashboard.subscribers.delete_sms',
                'uses' => 'SubscriberController@deleteSMSSubscriberAction',
            ]);
        });
    }
}

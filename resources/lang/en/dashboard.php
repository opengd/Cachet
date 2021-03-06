<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'dashboard'          => 'Dashboard',
    'writeable_settings' => 'The Cachet settings directory is not writeable. Please make sure that <code>./bootstrap/cachet</code> is writeable by the web server.',
    'notifications_disabled' => 'Notifications are disabled',
    // Incidents
    'incidents' => [
        'title'                    => 'Incidents & Maintenance',
        'incidents'                => 'Incidents',
        'logged'                   => '{0}There are no incidents reported.|[1]You have logged one incident.|[2,*]You have reported <strong>:count</strong> incidents.',
        'ongoing'                  => '{0}There are no ongoing incidents.|[1]You have <strong>1</strong> ongoing incident.|[2,*]You have <strong>:count</strong> ongoing incidents.',
        'past'                     => '{0}There are no past incidents.|[1]You have <strong>1</strong> past incident.|[2,*]You have <strong>:count</strong> past incidents.',
        'incident-create-template' => 'Create Template',
        'incident-templates'       => 'Incident Templates',
        'updates'                  => [
            'title'   => 'Incident updates for :incident',
            'count'   => '{0}:count Updates|[1]:count Update|[2]:count Updates|[3,*]:count Updates',
            'add'     => [
                'title'   => 'Create new incident update',
                'success' => 'Your new incident update has been created.',
                'failure' => 'Something went wrong with the incident update.',
            ],
            'edit' => [
                'title'   => 'Edit incident update',
                'success' => 'The incident update has been updated.',
                'failure' => 'Something went wrong updating the incident update',
            ],
            'updated_by'    => 'Update by <strong>:user</strong> at <i>:date</i>',
            'last_updated_by'    => 'Last update at <i>:date</i>',
            'fixed_by'    => 'Fixed at <i>:date</i>',
        ],
        'reported_by'              => 'Reported by <strong>:user</strong> at <i>:date</i>',
        'ticket'                   => 'Ticket',
        'add'                      => [
            'title'   => 'Report an incident',
            'success' => 'Incident added.',
            'failure' => 'There was an error adding the incident, please try again.',
        ],
        'edit' => [
            'title'   => 'Edit an incident',
            'success' => 'Incident updated.',
            'failure' => 'There was an error editing the incident, please try again.',
        ],
        'delete' => [
            'success' => 'The incident has been deleted and will not show on your status page.',
            'failure' => 'The incident could not be deleted, please try again.',
        ],

        // Incident templates
        'templates' => [
            'templates' => 'Templates',
            'title' => 'Incident Templates',
            'name' => 'Incident',
            'add'   => [
                'title'   => 'Create an incident template',
                'message' => 'Create your first incident template.',
                'success' => 'Your new incident template has been created.',
                'failure' => 'Something went wrong with the incident template.',
            ],
            'edit' => [
                'title'   => 'Edit Template',
                'success' => 'The incident template has been updated.',
                'failure' => 'Something went wrong updating the incident template',
            ],
            'delete' => [
                'success' => 'The incident template has been deleted.',
                'failure' => 'The incident template could not be deleted, please try again.',
            ],
            'update' => [
                'title' => 'Incident Update Templates',
                'name' => 'Incident Update',
                'add'   => [
                    'title'   => 'Create an incident update template',
                    'message' => 'Create your first incident update template.',
                    'success' => 'Your new incident update template has been created.',
                    'failure' => 'Something went wrong with the incident update template.',
                ],
                'edit' => [
                    'title'   => 'Edit Template',
                    'success' => 'The incident update template has been updated.',
                    'failure' => 'Something went wrong updating the incident update template',
                ],
                'delete' => [
                    'success' => 'The incident update template has been deleted.',
                    'failure' => 'The incident update template could not be deleted, please try again.',
                ],
            ]
        ],
    ],

    // Incident Maintenance
    'schedule' => [
        'schedule'     => 'Maintenance',
        'logged'       => '{0}There has been no Maintenance, good work.|[1]You have logged one schedule.|[2,*]You have reported <strong>:count</strong> schedules.',
        'scheduled_at' => 'Scheduled at :timestamp',
        'add'          => [
            'title'   => 'Add Maintenance',
            'success' => 'Maintenance added.',
            'failure' => 'Something went wrong adding the Maintenance, please try again.',
        ],
        'edit' => [
            'title'   => 'Edit Maintenance',
            'success' => 'Maintenance has been updated!',
            'failure' => 'Something went wrong editing the Maintenance, please try again.',
        ],
        'delete' => [
            'success' => 'The Maintenance has been deleted and will not show on your status page.',
            'failure' => 'The Maintenance could not be deleted, please try again.',
        ],
    ],

    // Components
    'components' => [
        'components'         => 'Components',
        'component_statuses' => 'Component Statuses',
        'listed_group'       => 'Grouped under :name',
        'add'                => [
            'title'   => 'Add a component',
            'message' => 'You should add a component.',
            'success' => 'Component created.',
            'failure' => 'Something went wrong with the component group, please try again.',
        ],
        'edit' => [
            'title'   => 'Edit a component',
            'success' => 'Component updated.',
            'failure' => 'Something went wrong with the component group, please try again.',
        ],
        'delete' => [
            'success' => 'The component has been deleted!',
            'failure' => 'The component could not be deleted, please try again.',
        ],

        // Component groups
        'groups' => [
            'groups'        => 'Component group|Component groups',
            'no_components' => 'You should add a component group.',
            'add'           => [
                'title'   => 'Add a component group',
                'success' => 'Component group added.',
                'failure' => 'Something went wrong with the component group, please try again.',
            ],
            'edit' => [
                'title'   => 'Edit a component group',
                'success' => 'Component group updated.',
                'failure' => 'Something went wrong with the component group, please try again.',
            ],
            'delete' => [
                'success' => 'Component group has been deleted!',
                'failure' => 'The component group could not be deleted, please try again.',
            ],
        ],
    ],

    // Metrics
    'metrics' => [
        'metrics' => 'Metrics',
        'add'     => [
            'title'   => 'Create a metric',
            'message' => 'You should add a metric.',
            'success' => 'Metric created.',
            'failure' => 'Something went wrong with the metric, please try again.',
        ],
        'edit' => [
            'title'   => 'Edit a metric',
            'success' => 'Metric updated.',
            'failure' => 'Something went wrong with the metric, please try again.',
        ],
        'delete' => [
            'success' => 'The metric has been deleted and will no longer display on your status page.',
            'failure' => 'The metric could not be deleted, please try again.',
        ],
    ],
    // Subscribers
    'subscribers' => [
        'subscribers'          => 'Subscribers',
        'description'          => 'Subscribers will receive email updates when incidents are created or components are updated.',
        'description_disabled' => 'To use this feature, you need allow people to signup for notifications.',
        'verified'             => 'Verified',
        'not_verified'         => 'Not verified',
        'subscriber'           => ':email, subscribed :date',
        'no_subscriptions'     => 'Subscribed to no components',
        'global'               => 'Globally subscribed',
        'notify'               => 'Notify',
        'components'           => 'Components',
        'subscribed'           => 'Subscribed: :date',
        'add'                  => [
            'title'   => 'Add a new subscriber',
            'success' => 'Subscriber has been added!',
            'failure' => 'Something went wrong adding the subscriber, please try again.',
            'help'    => 'Enter each subscriber on a new line.',
        ],
        'edit' => [
            'title'     => 'Update subscriber',
            'success'   => 'Subscriber has been updated!',
            'failure'   => 'Something went wrong editing the subscriber, please try again.',
            'error' => [
                'duplicate' => 'Duplicate emails, subscriber already exist.'
            ],
            'verified'  => 'Email verified',
            'notify'    => 'Notify subscriber by email',
            'components'    => 'Component subscriptions',
            'resend_verify_success' => 'Verify email has been sent to subscriber.', 
        ],
        'sms' => [
            'subscriber'   => 'Subscriber',
            'sms'           => 'SMS',
            'description'   => 'Add a phone number to a subscriber and the subscriber will be notify via SMS.',
            'email'         => 'Email',
            'sms_number'    => 'SMS number',
            'notify'        => 'Notify',
            'add' => [
                'title'     => 'Add SMS subscription',
                'success'   => 'SMS subscription have been added',
                'failure'   => 'Something went wrong adding the SMS subsciptions, please try again.',
                'help'      => 'Enter the phone number for the SMS subsciption',
                'error' => [
                    'not_found' => 'Unable to find matching subscriber.'
                ],
                'notify'    => 'Notify subscriber by SMS',
            ],
            'edit' => [
                'title'   => 'Update SMS subscriber',
                'success' => 'Subscriber has been updated!',
                'failure' => 'Something went wrong editing the SMS subscriber, please try again.',
                'notify'  => 'Notify subscriber by SMS',
            ],
        ]
    ],

    // Team
    'team' => [
        'team'        => 'Team',
        'member'      => 'Member',
        'profile'     => 'Profile',
        'description' => 'Team Members will be able to add, modify & edit components and incidents.',
        'add'         => [
            'title'   => 'Add a new team member',
            'success' => 'Team member added.',
            'failure' => 'The team member could not be added, please try again.',
        ],
        'edit' => [
            'title'   => 'Update profile',
            'success' => 'Profile updated.',
            'failure' => 'Something went wrong updating the profile, please try again.',
        ],
        'delete' => [
            'success' => 'Team member has been deleted and will no longer have access to the dashboard!',
            'failure' => 'The team member could not be added, please try again.',
        ],
        'invite' => [
            'title'   => 'Invite a new team member',
            'success' => 'An invite has been sent',
            'failure' => 'The invite could not be sent, please try again.',
        ],
    ],

    // Settings
    'settings' => [
        'settings'  => 'Settings',
        'app-setup' => [
            'app-setup'   => 'Application Setup',
            'images-only' => 'Only images may be uploaded.',
            'too-big'     => 'The file you uploaded is too big. Upload an image smaller than :size',
        ],
        'analytics' => [
            'analytics' => 'Analytics',
        ],
        'log' => [
            'log' => 'Log',
        ],
        'localization' => [
            'localization' => 'Localization',
        ],
        'customization' => [
            'customization' => 'Customization',
            'header'        => 'Custom Header HTML',
            'footer'        => 'Custom Footer HTML',
        ],
        'mail' => [
            'mail'  => 'Mail',
            'test'  => 'Test',
            'email' => [
                'subject' => 'Test notification from Cachet',
                'body'    => 'This is a test notification from Cachet.',
            ],
        ],
        'security' => [
            'security'   => 'Security',
            'two-factor' => 'Users without two-factor authentication',
        ],
        'stylesheet' => [
            'stylesheet' => 'Stylesheet',
        ],
        'theme' => [
            'theme' => 'Theme',
        ],
        'edit' => [
            'success' => 'Settings saved.',
            'failure' => 'Settings could not be saved.',
        ],
        'credits' => [
            'credits'       => 'Credits',
            'contributors'  => 'Contributors',
            'license'       => 'Cachet is a BSD-3-licensed open source project, released by <a href="https://alt-three.com/?utm_source=cachet&utm_medium=credits&utm_campaign=Cachet%20Credit%20Dashboard" target="_blank">Alt Three Services Limited</a>.',
            'backers-title' => 'Backers & Sponsors',
            'backers'       => 'If you\'d like to support future development, check out the <a href="https://patreon.com/jbrooksuk" target="_blank">Cachet Patreon</a> campaign.',
            'thank-you'     => 'Thank you to each and every one of the :count contributors.',
        ],
        'extra' => [
            'extra'         => 'Extra',
            'status_page'   => 'Status Page',
            'mail'          => 'Mail',
            'sms'           => 'SMS',
            'incident'      => 'Create Incident'
        ]
    ],

    // Login
    'login' => [
        'login'      => 'Login',
        'logged_in'  => 'You\'re logged in.',
        'welcome'    => 'Welcome back!',
        'two-factor' => 'Please enter your token.',
    ],

    // Sidebar footer
    'help'        => 'Help',
    'status_page' => 'Status Page',
    'logout'      => 'Logout',

    // Notifications
    'notifications' => [
        'notifications' => 'Notifications',
        'awesome'       => 'Awesome.',
        'whoops'        => 'Whoops.',
    ],

    // Widgets
    'widgets' => [
        'support'          => 'Support Cachet',
        'support_subtitle' => 'Check out our <strong><a href="https://patreon.com/jbrooksuk" target="_blank">Patreon</a></strong> page!',
        'news'             => 'Latest News',
        'news_subtitle'    => 'Get the latest update',
    ],

    // Welcome modal
    'welcome' => [
        'welcome' => 'Welcome to your new status page, :username!',
        'message' => 'You\'re almost ready but you might want to configure these extra settings first...',
        'close'   => 'I\'m good thanks!',
        'steps'   => [
            'component'  => 'Add your components',
            'incident'   => 'Create an incident',
            'customize'  => 'Customize your page',
            'team'       => 'Add your team',
            'api'        => 'Generate an API token',
            'two-factor' => 'Setup Two Factor Authentication',
        ],
    ],

];

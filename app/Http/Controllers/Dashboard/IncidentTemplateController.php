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
use CachetHQ\Cachet\Integrations\Contracts\System;
use CachetHQ\Cachet\Models\Incident;
use CachetHQ\Cachet\Models\IncidentTemplate;
use CachetHQ\Cachet\Models\IncidentUpdateTemplate;
use GrahamCampbell\Binput\Facades\Binput;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

/**
 * This is the incident template controller.
 *
 * @author James Brooks <james@alt-three.com>
 */
class IncidentTemplateController extends Controller
{
    /**
     * Stores the sub-sidebar tree list.
     *
     * @var array
     */
    protected $subMenu = [];

    /**
     * The guard instance.
     *
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * The system instance.
     *
     * @var \CachetHQ\Cachet\Integrations\Contracts\System
     */
    protected $system;

    /**
     * Creates a new incident controller instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth, System $system)
    {
        $this->auth = $auth;
        $this->system = $system;

        //View::share('sub_title', trans('dashboard.incidents.title'));

        $this->subMenu = [
            'incidents' => [
                'title'  => trans('dashboard.incidents.templates.name'),
                'url'    => cachet_route('dashboard.templates'),
                'icon'   => '',
                'active' => false,
            ],
            'incidents_updates' => [
                'title'  => trans('dashboard.incidents.templates.update.name'),
                'url'    => cachet_route('dashboard.templates.update'),
                'icon'   => '',
                'active' => false,
            ],
        ];
        
        View::share([
            'subMenu'  => $this->subMenu,
            'subTitle' =>trans('dashboard.incidents.templates.templates'),
        ]);
    }

    /**
     * Shows the incident templates.
     *
     * @return \Illuminate\View\View
     */
    public function showTemplates()
    {
        $this->subMenu['incidents']['active'] = true;

        return View::make('dashboard.templates.index')
            ->withPageTitle(trans('dashboard.incidents.templates.title').' - '.trans('dashboard.dashboard'))
            ->withIncidentTemplates(IncidentTemplate::all());
    }

    /**
     * Shows the add incident template view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddIncidentTemplate()
    {
        return View::make('dashboard.templates.add')
            ->withPageTitle(trans('dashboard.incidents.templates.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Shows the edit incident template view.
     *
     * @param \CachetHQ\Cachet\Models\IncidentTemplate $template
     *
     * @return \Illuminate\View\View
     */
    public function showEditTemplateAction(IncidentTemplate $template)
    {
        return View::make('dashboard.templates.edit')
            ->withPageTitle(trans('dashboard.incidents.templates.edit.title').' - '.trans('dashboard.dashboard'))
            ->withTemplate($template);
    }

    /**
     * Deletes an incident template.
     *
     * @param \CachetHQ\Cachet\Models\IncidentTemplate $template
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteTemplateAction(IncidentTemplate $template)
    {
        $template->delete();

        return cachet_redirect('dashboard.templates')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.incidents.templates.delete.success')));
    }

    /**
     * Creates a new incident template.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createIncidentTemplateAction()
    {
        try {
            IncidentTemplate::create([
                'name'     => Binput::get('name'),
                'template' => Binput::get('template', null, false, false),
            ]);
        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.templates.create')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.incidents.templates.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return cachet_redirect('dashboard.templates')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.incidents.templates.add.success')));
    }

    /**
     * Edit an incident template.
     *
     * @param \CachetHQ\Cachet\Models\IncidentTemplate $template
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editTemplateAction(IncidentTemplate $template)
    {
        try {
            $template->update(Binput::get('template'));
        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.templates.edit', ['id' => $template->id])
                ->withUpdatedTemplate($template)
                ->withTemplateErrors($e->getMessageBag()->getErrors());
        }

        return cachet_redirect('dashboard.templates.edit', ['id' => $template->id])
            ->withUpdatedTemplate($template);
    }

    /**
     * Shows the incident update templates.
     *
     * @return \Illuminate\View\View
     */
    public function showUpdateTemplates()
    {
        $this->subMenu['incidents_updates']['active'] = true;

        return View::make('dashboard.templates.update.index')
            ->withPageTitle(trans('dashboard.incidents.templates.update.title').' - '.trans('dashboard.dashboard'))
            ->withIncidentUpdateTemplates(IncidentUpdateTemplate::all());
    }

    /**
     * Shows the add incident update template view.
     *
     * @return \Illuminate\View\View
     */
    public function showAddIncidentUpdateTemplate()
    {
        return View::make('dashboard.templates.update.add')
            ->withPageTitle(trans('dashboard.incidents.templates.update.add.title').' - '.trans('dashboard.dashboard'));
    }

    /**
     * Shows the edit incident update template view.
     *
     * @param int $template_id
     *
     * @return \Illuminate\View\View
     */
    public function showEditIncidentUpdateTemplateAction(int $template_id)
    {
        $template = IncidentUpdateTemplate::find($template_id);

        error_log(json_encode($template));
        return View::make('dashboard.templates.update.edit')
            ->withPageTitle(trans('dashboard.incidents.templates.update.edit.title').' - '.trans('dashboard.dashboard'))
            ->withTemplate($template);
    }

    /**
     * Deletes an incident update template.
     *
     * @param int $template_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteIncidentUpdateTemplateAction(int $template_id)
    {
        $template = IncidentUpdateTemplate::find($template_id);

        $template->delete();

        return cachet_redirect('dashboard.templates.update')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.incidents.templates.update.delete.success')));
    }

    /**
     * Creates a new incident update template.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createIncidentUpdateTemplateAction()
    {
        try {
            IncidentUpdateTemplate::create([
                'name'     => Binput::get('name'),
                'template' => Binput::get('template', null, false, false),
                'status'   => Binput::get('status')
            ]);
        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.templates.update.create')
                ->withInput(Binput::all())
                ->withTitle(sprintf('%s %s', trans('dashboard.notifications.whoops'), trans('dashboard.incidents.templates.update.add.failure')))
                ->withErrors($e->getMessageBag());
        }

        return cachet_redirect('dashboard.templates.update')
            ->withSuccess(sprintf('%s %s', trans('dashboard.notifications.awesome'), trans('dashboard.incidents.templates.update.add.success')));
    }

    /**
     * Edit an incident update template.
     *
     * @param int $template_id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editIncidentUpdateTemplateAction(int $template_id)
    {
        try {
            $template = IncidentUpdateTemplate::find($template_id);
            $template->update(Binput::get('template'));
            $template->update(['status' => Binput::get('status')]);
        } catch (ValidationException $e) {
            return cachet_redirect('dashboard.templates.update.edit', ['id' => $template->id])
                ->withUpdatedTemplate($template)
                ->withTemplateErrors($e->getMessageBag()->getErrors());
        }

        return cachet_redirect('dashboard.templates.update.edit', ['id' => $template->id])
            ->withUpdatedTemplate($template);
    }
}

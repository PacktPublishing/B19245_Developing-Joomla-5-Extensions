<?php

namespace Piedpiper\Component\Spm\Administrator\View\Projects;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;


class HtmlView extends BaseHtmlView
{
    public $filterForm;
    public $state;
    public $items=[];
    public $pagination;
    public $activeFilters=[];
    public $filterForm;

    public function display($tpl=null): void
    {
        $this->state      = $this->get('State');
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');

        if (count($errors = $this->get('Errors')))
        {
            throw new GenericDataException(implode("\n", $errors), 500);
        }

        if ($this->getLayout() !== 'modal') {
            $this->addToolbar();
        }

        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return void
     *
     */
    protected function addToolbar(): void
    {
        $user  = Factory::getApplication()->getIdentity();
        ToolbarHelper::title(Text::_('COM_SPM_PROJECTS'), 'bookmark banners-levels');

        $toolbar = Toolbar::getInstance('toolbar');

        if ($user->authorise('core.admin', 'com_spm') || $user->authorise('core.options', 'com_spm')) {
            $toolbar->preferences('com_spm');
        }
    }
}

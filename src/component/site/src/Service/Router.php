<?php

namespace Piedpiper\Component\Spm\Site\Service;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Menu\AbstractMenu;

class Router extends RouterView
{
    private $db;

    public function __construct(SiteApplication $app, AbstractMenu $menu, $category, DatabaseInterface $db)
    {
        $this->db = $db;

        $projects = new RouterViewConfiguration('projects');
        $this->registerView($projects);

        $project = new RouterViewConfiguration('project');
        $project->setKey('id')->setParent($projects);
        $this->registerView($project);

        $customers = new RouterViewConfiguration('customers');
        $this->registerView($customers);

        $customer = new RouterViewConfiguration('customer');
        $customer->setKey('id')->setParent($customers);
        $this->registerView($customer);

        parent::__construct($app, $menu);

        $this->attachRule(new MenuRules($this));
        $this->attachRule(new StandardRules($this));
        $this->attachRule(new NomenuRules($this));
    }

    public function getProjectSegment($key, $urlQuery)
    {
        $query = $this->db->getQuery(true);

        $query->select($this->db->quoteName('alias'))
            ->from('#__spm_projects')
            ->where($this->db->quoteName('id') . ' = ' . (int) $key);

        $this->db->setQuery($query);
        $id = $this->db->loadResult();

        return [$id];
    }

    public function getProjectId($segment, $urlQuery)
    {
        $query = $this->db->getQuery(true);

        $query->select($this->db->quoteName('id'))
            ->from('#__spm_projects')
            ->where($this->db->quoteName('alias') . ' = :alias')
            ->bind(':alias', $segment);;

        $this->db->setQuery($query);

        return (int) $this->db->loadResult();
    }
}


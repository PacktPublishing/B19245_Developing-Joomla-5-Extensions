<?php

namespace Piedpiper\Module\ProjectsList\Site\Helper;

use Piedpiper\Component\Spm\Site\Model\ProjectsModel;
use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;


class ProjectsListHelper implements DatabaseAwareInterface
{
    use DatabaseAwareTrait;

    public function getProjects(Registry $params, SiteApplication $app)
    {
        $model = $app->bootComponent('com_spm')->getMVCFactory()->createModel('Projects', 'Site', ['ignore_request' => true]);

        $model->setState('params', $app->getParams());
        $model->setState('list.limit', (int) $params->get('total', 5));

        switch ($params->get('ordering', '')) {
        case 'random':
            $db = $this->getDatabase();
            $ordering = $db->getQuery(true)->rand();
            break;
        case 'oldest':
            $ordering = 'a.created ASC';
            break;
        case 'newest':
        default:
            $ordering = 'a.created DESC';
        }

        $model->setState('list.ordering', $ordering);
        $model->setState('list.direction', '');

        $model->setState('filter.customer', (int) $params->get('customer', 0));

        $items = $model->getItems();

        return $items;
    }
}


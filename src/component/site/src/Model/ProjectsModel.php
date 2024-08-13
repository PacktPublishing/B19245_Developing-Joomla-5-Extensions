<?php

namespace Piedpiper\Component\Spm\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

class ProjectsModel extends ListModel
{

    protected function populateState($ordering = 'name', $direction = 'ASC')
    {
        $app = Factory::getApplication();
        $value = $app->input->get('limit', $app->get('list_limit', 0), 'uint');
        $this->setState('list.limit', $value);

        $value = $app->input->get('limitstart', 0, 'uint');
        $this->setState('list.start', $value);

        parent::populateState($ordering, $direction);
    }

    protected function getListQuery()
    {
        $db    = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select(
            $this->getState(
                'list.select',
                [
                    $db->quoteName('a.id'),
                    $db->quoteName('a.name'),
                    $db->quoteName('a.deadline'),
                ]
            )
        )->from($db->quoteName('#__spm_projects', 'a'));

        $id_customers = $this->state->get('filter.customer', []);
        if (implode('', $id_customers)) {
            $query->where(
                $db->quoteName('a.id_customer')
                . ' IN (' . implode(',', $id_customers) . ')'
            );
        }


        $orderCol  = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'ASC');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        return $query;
    }

}

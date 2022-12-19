<?php

namespace Piedpiper\Component\Spm\Administrator\Model;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class ProjectModel extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_spm.project', 'project', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_spm.edit.project.data', array());

        if (empty($data))
        {
            $data = $this->getItem();

        }

        return $data;
    }

    public function getTable($name = '', $prefix = '', $options = array())
    {
        $name = 'Projects';
        $prefix = 'Table';

        if ($table = $this->_createTable($name, $prefix, $options))
        {
            return $table;
        }

        throw new \Exception(Text::sprintf('JLIB_APPLICATION_ERROR_TABLE_NAME_NOT_SUPPORTED', $name), 0);
    }
}

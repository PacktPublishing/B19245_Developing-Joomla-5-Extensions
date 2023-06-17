<?php

\defined('_JEXEC');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo Route::_('index.php?option=com_spm&view=projects'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
        	<?php echo LayoutHelper::render('joomla.searchtools.default', ['view' => $this]); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <caption><?php echo Text::_('COM_SPM_PROJECTS_LIST');?></caption>
            <thead>
                <tr>
                    <td><?php echo Text::_('COM_SPM_PROJECTS_LIST_ID');?></td>
                    <td><?php echo Text::_('COM_SPM_PROJECTS_LIST_NAME');?></td>
                    <td><?php echo Text::_('COM_SPM_PROJECTS_LIST_DEADLINE');?></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $item) : ?>
                   <tr>
                   <td><?php echo $item->id; ?></td>
                   <td><?php echo $item->name; ?></td>
                   <td><?php echo $item->deadline; ?></td>
                   </tr>
                <?php endforeach;?>
            </tbody>
            <tfooter>
                <?php echo $this->pagination->getListFooter(); ?>
            </tfooter>
        </table>
    </div>

    <input type="hidden" name="task" value="projects">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>

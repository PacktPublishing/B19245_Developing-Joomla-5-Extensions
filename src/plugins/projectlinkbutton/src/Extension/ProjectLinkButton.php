<?php

namespace Piedpiper\Plugin\EditorsXtd\ProjectLinkButton\Extension;

use Joomla\CMS\Editor\Button\Button;
use Joomla\CMS\Event\Editor\EditorButtonsSetupEvent;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Session\Session;
use Joomla\Event\SubscriberInterface;

\defined('_JEXEC') or die;

/**
 * Editor Article button
 *
 * @since  1.5
 */
final class ProjectLinkButton extends CMSPlugin implements SubscriberInterface
{
    /**
     * Returns an array of events this subscriber will listen to.
     *
     * @return array
     *
     * @since   5.0.0
     */
    public static function getSubscribedEvents(): array
    {
        return ['onEditorButtonsSetup' => 'onEditorButtonsSetup'];
    }

    /**
     * @param  EditorButtonsSetupEvent $event
     * @return void
     *
     * @since   5.0.0
     */
    public function onEditorButtonsSetup(EditorButtonsSetupEvent $event)
    {
        $subject  = $event->getButtonsRegistry();
        $disabled = $event->getDisabledButtons();

        if (\in_array($this->_name, $disabled)) {
            return;
        }

        $this->loadLanguage();

        $button = $this->onDisplay($event->getEditorId());

        if ($button) {
            $subject->add($button);
        }
    }

    /**
     * Display the button
     *
     * @param   string  $name  The name of the button to add
     *
     * @return  Button|void  The button options as Button object, void if ACL check fails.
     *
     * @since   1.5
     *
     * @deprecated  6.0 Use onEditorButtonsSetup event
     */
    public function onDisplay($name)
    {
        $user  = $this->getApplication()->getIdentity();

        $link = 'index.php?option=com_spm&view=projects&layout=modal&tmpl=component&'
            . Session::getFormToken() . '=1&editor=' . $name;

        $button = new Button(
            $this->_name,
            [
                'action'  => 'modal',
                'link'    => $link,
                'text'    => Text::_('PLG_EDITORS-XTD_PROJECTLINKBUTTON_INSERT_PROJECT'),
                'icon'    => 'file-add',
                'iconSVG' => '<svg viewBox="0 0 32 32" width="24" height="24"><path d="M28 24v-4h-4v4h-4v4h4v4h4v-4h4v-4zM2 2h18v6h6v10h2v-10l-8-'
                    . '8h-20v32h18v-2h-16z"></path></svg>',
                'name' => $this->_type . '_' . $this->_name,
            ]
        );

        return $button;
    }
}
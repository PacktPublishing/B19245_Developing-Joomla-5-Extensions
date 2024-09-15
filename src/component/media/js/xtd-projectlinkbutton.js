document.querySelectorAll('.select-button').forEach(element => {
    // Listen for click event
    const editor = Joomla.getOptions('xtd-projectlinkbutton').editor;
    element.addEventListener('click', event => {
        const id = event.target.getAttribute('data-id');
        const tag = '{projectlink ' + id + '}';
        window.parent.Joomla.editors.instances[editor].replaceSelection(tag);
        window.parent.Joomla.Modal.getCurrent().close();
    });
});
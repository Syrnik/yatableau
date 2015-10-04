<?php

class siteYatableauPlugin extends sitePlugin
{
    public function handlerBackendSidebar()
    {
        $view = wa()->getView();

        return array('menu_li' => $view->fetch($this->path . '/templates/backend_sidebar_menu_li.html'));
    }

    public function uninstall()
    {
        $path = wa()->getDataPath("plugins/yatableau/", true);
        waFiles::delete($path, true);
        parent::uninstall();
    }
}

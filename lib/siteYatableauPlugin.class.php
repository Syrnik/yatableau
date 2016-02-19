<?php

/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.0.1
 * @copyright Serge Rodovnichenko, 2015
 */
class siteYatableauPlugin extends sitePlugin
{
    public function handlerBackendSidebar()
    {
        $view = wa()->getView();

        return array('menu_li' => $view->fetch($this->path . '/templates/backend_sidebar_menu_li.html'));
    }
}

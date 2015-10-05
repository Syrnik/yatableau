<?php
return array(
    'name'     => 'Yandex.Tableau',
    'icon'     => 'img/yatableau.gif',
    'version'  => '1.0.0',
    'vendor'   => '670917',
    'frontend' => true,
    'settings' => true,
    'handlers' =>array(
        'backend_sidebar' => 'handlerBackendSidebar'
/* Wait for new event. We need it to cleanup uploaded files and drop settings */
// 'domain_delete' => 'handlerDomainDelete'
    ),
);

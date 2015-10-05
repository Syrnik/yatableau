<?php

/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.0.0
 * @copyright Serge Rodovnichenko, 2015
 */
class siteYatableauPluginDomainsettingsAction extends waViewAction
{
    public function execute()
    {
        $plugin = wa('site')->getPlugin('yatableau');
        $domain_info = siteHelper::getDomainInfo();
        $all_domains_settings = $plugin->getSettings('domains');
        if (!is_array($all_domains_settings)) {
            $all_domains_settings = array();
        }

        $domain_settings = array(
            'id' => null,
            'logo_file' => null,
            'widget_color' => '#ffffff',
        );

        foreach ($all_domains_settings as $d) {
            if ($d['id'] == $domain_info['id']) {
                $domain_settings = $d;
            }
        }
        $this->view->assign(compact('domain_info', 'domain_settings'));
    }
}

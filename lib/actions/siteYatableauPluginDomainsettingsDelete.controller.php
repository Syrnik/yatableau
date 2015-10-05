<?php

/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.0.0
 * @copyright Serge Rodovnichenko, 2015
 */
class siteYatableauPluginDomainsettingsDeleteController extends waJsonController
{
    public function execute()
    {
        $this->getResponse()->addHeader('Content-type', 'application/json');
        $domain_id = waRequest::request('domain_id');

        if (!$domain_id) {
            return;
        }

        $plugin = wa('site')->getPlugin('yatableau');
        $all_domain_settings = $plugin->getSettings('domains');

        foreach ($all_domain_settings as $key => $domain) {
            if ($domain['id'] == $domain_id) {
                $path = wa()->getDataPath("plugins/yatableau/$domain_id/", true);
                waFiles::delete($path, true);
                unset($all_domain_settings[$key]);
            }
        }

        $plugin->saveSettings(array('domains' => $all_domain_settings));
    }
}

<?php

/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version
 * @copyright Serge Rodovnichenko, 2015
 * @license
 */
class siteYatableauPluginFrontendManifestController extends waViewController
{
    public function execute()
    {
        $domain_id = siteHelper::getDomainId();
        $plugin = wa('site')->getPlugin('yatableau');

        $all_domain_settings = $plugin->getSettings('domains');

        if (!is_array($all_domain_settings)) {
            $all_domain_settings = array();
        }

        $domain_settings = array(
            'id'           => null,
            'logo_file'    => null,
            'widget_color' => '#ffffff',
            'enabled'      => 0,
            'show_title'   => 1
        );

        foreach ($all_domain_settings as $d) {
            if ($d['id'] == $domain_id) {
                $domain_settings = $d;
            }
        }

        if (!$domain_settings['enabled'] || !$domain_settings['logo_file']) {
            throw new waException('Not found');
        }


        $logo = $path = wa()->getDataUrl("plugins/yatableau/$domain_id/", true, null, true) . $domain_settings['logo_file'];
        $data = array(
            'version'     => "1.0",
            'api_version' => 4,
            'layout'      => array(
                'logo'       => $logo,
                'color'      => $domain_settings['widget_color'],
                'show_title' => ($domain_settings['show_title'] ? true : false)
            )
        );

        $this->getResponse()->addHeader('Content-Type', 'application/json');
        $this->blocks[] = str_replace('\/', '/', json_encode($data));
    }
}

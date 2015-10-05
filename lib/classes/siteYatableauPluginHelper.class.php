<?php

/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version
 * @copyright Serge Rodovnichenko, 2015
 * @license
 */
class siteYatableauPluginHelper
{
    public static function meta()
    {
        $domain_info = siteHelper::getDomainInfo();
        $domain_id = siteHelper::getDomainId();
        $plugin = wa('site')->getPlugin('yatableau');

        $all_domain_settings = $plugin->getSettings('domains');

        if (!is_array($all_domain_settings)) {
            $all_domain_settings = array();
        }

        // @deprecated ?
        $domain_settings = array(
            'id'           => null,
            'logo_file'    => null,
            'widget_color' => '#ffffff',
            'show_title'   => 0
        );

        foreach ($all_domain_settings as $d) {
            if ($d['id'] == $domain_id) {
                $domain_settings = $d;
            }
        }

        if (!$domain_settings['logo_file']) {
            return '';
        }


        $logo = $path = wa()->getDataUrl("plugins/yatableau/$domain_id/", true) . $domain_settings['logo_file'];

        return
            '<link rel="yandex-tableau-widget" href="' .
            wa()->getRouteUrl('site/yatableau/manifest', array('domain' => $domain_info['name']), true) .
            '" />';
    }
}

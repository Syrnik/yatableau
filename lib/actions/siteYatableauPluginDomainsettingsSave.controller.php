<?php

/**
 * @author Serge Rodovnichenko <serge@syrnik.com>
 * @version 1.0.0
 * @copyright Serge Rodovnichenko, 2015
 */
class siteYatableauPluginDomainsettingsSaveController extends waJsonController
{
    //@todo it may be a good idea to store pre-rendered json file inside a datadir and just serve it
    public function execute()
    {
        $plugin = wa('site')->getPlugin('yatableau');
        $domain_id = siteHelper::getDomainId();
        $domains_settings = $plugin->getSettings('domains');
        $logo_file = $this->saveLogo($domain_id);
        $widget_color = $this->getRequest()->post('widget_color', '#ffffff');

        $data = array(
            'id'           => $domain_id,
            'logo_file'    => ($logo_file ? $logo_file : ''),
            'widget_color' => $widget_color
        );

        if (!is_array($domains_settings)) {
            $domains_settings = array();
        }

        foreach ($domains_settings as $key => $domain) {
            if ($domain['id'] == $domain_id) {
                if (empty($data['logo_file'])) {
                    unset($data['logo_file']);
                }
                $data = array_merge($domains_settings[$key], $data);
                unset($domains_settings[$key]);
            }
        }

        $domains_settings[] = $data;
        $plugin->saveSettings(array('domains' => $domains_settings));

    }

    private function saveLogo($domain_id)
    {
        $logo_file = waRequest::file('logo');

        if (!$logo_file || !$logo_file->uploaded()) {
            return false;
        }

        $name = false;
        try {
            if ($logo_file->extension != 'png') {
                throw new waException('Допустимы только файлы с расширением png');
            }
            $path = wa()->getDataPath("plugins/yatableau/$domain_id/", true);
            $name = $logo_file->name;
            if (!file_exists($path) || !is_writeable($path)) {
                throw new waException('Не удалось сохранить логотип. Видимо, недостаточно прав для записи');
            }
            if (!$logo_file->moveTo($path, $logo_file->name)) {
                throw new waException(_w('Failed to upload file.'));
            }
        } catch (waException $ex) {
            $this->errors = $ex->getMessage();

            $name = false;
        }

        return $name;
    }
}

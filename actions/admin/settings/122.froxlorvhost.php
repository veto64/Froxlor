<?php

/**
 * This file is part of the Froxlor project.
 * Copyright (c) 2016 the Froxlor Team (see authors).
 *
 * For the full copyright and license information, please view the COPYING
 * file that was distributed with this source code. You can also view the
 * COPYING file online at http://files.froxlor.org/misc/COPYING.txt
 *
 * @copyright  (c) the authors
 * @author     Froxlor team <team@froxlor.org> (2016-)
 * @license    GPLv2 http://files.froxlor.org/misc/COPYING.txt
 * @package    \Froxlor\Settings
 *
 */
return array(
	'groups' => array(
		'froxlorvhost' => array(
			'title' => $lng['admin']['froxlorvhost'] . (call_user_func(array('\Froxlor\Settings\FroxlorVhostSettings', 'hasVhostContainerEnabled')) == false ? $lng['admin']['novhostcontainer'] : ''),
			'icon' => 'fa-solid fa-wrench',
			'fields' => array(
				/**
				 * Webserver-Vhost
				 */
				'system_froxlordirectlyviahostname' => array(
					'label' => $lng['serversettings']['froxlordirectlyviahostname'],
					'settinggroup' => 'system',
					'varname' => 'froxlordirectlyviahostname',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField'
				),
				'system_froxloraliases' => array(
					'label' => $lng['serversettings']['froxloraliases'],
					'settinggroup' => 'system',
					'varname' => 'froxloraliases',
					'type' => 'text',
					'string_regexp' => '/^(([a-z0-9\-\._]+, ?)*[a-z0-9\-\._]+)?$/i',
					'string_emptyallowed' => true,
					'default' => '',
					'save_method' => 'storeSettingField'
				),
				/**
				 * SSL / Let's Encrypt
				 */
				'system_le_froxlor_enabled' => array(
					'label' => $lng['serversettings']['le_froxlor_enabled'],
					'settinggroup' => 'system',
					'varname' => 'le_froxlor_enabled',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingClearCertificates',
					'visible' => \Froxlor\Settings::Get('system.leenabled') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				'system_le_froxlor_redirect' => array(
					'label' => $lng['serversettings']['le_froxlor_redirect'],
					'settinggroup' => 'system',
					'varname' => 'le_froxlor_redirect',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.use_ssl') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				'system_hsts_maxage' => array(
					'label' => $lng['admin']['domain_hsts_maxage'],
					'settinggroup' => 'system',
					'varname' => 'hsts_maxage',
					'type' => 'number',
					'min' => 0,
					'max' => 94608000, // 3-years
					'default' => 0,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.use_ssl') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				'system_hsts_incsub' => array(
					'label' => $lng['admin']['domain_hsts_incsub'],
					'settinggroup' => 'system',
					'varname' => 'hsts_incsub',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.use_ssl') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				'system_hsts_preload' => array(
					'label' => $lng['admin']['domain_hsts_preload'],
					'settinggroup' => 'system',
					'varname' => 'hsts_preload',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.use_ssl') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				'system_honorcipherorder' => array(
					'label' => $lng['admin']['domain_honorcipherorder'],
					'settinggroup' => 'system',
					'varname' => 'honorcipherorder',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.use_ssl') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				'system_sessiontickets' => array(
					'label' => $lng['admin']['domain_sessiontickets'],
					'settinggroup' => 'system',
					'varname' => 'sessiontickets',
					'type' => 'checkbox',
					'default' => true,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.use_ssl') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					), true)
				),
				/**
				 * FCGID
				 */
				'system_mod_fcgid_enabled_ownvhost' => array(
					'label' => $lng['serversettings']['mod_fcgid_ownvhost'],
					'settinggroup' => 'system',
					'varname' => 'mod_fcgid_ownvhost',
					'type' => 'checkbox',
					'default' => true,
					'save_method' => 'storeSettingField',
					'websrv_avail' => array(
						'apache2'
					),
					'visible' => \Froxlor\Settings::Get('system.mod_fcgid') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				'system_mod_fcgid_httpuser' => array(
					'label' => $lng['admin']['mod_fcgid_user'],
					'settinggroup' => 'system',
					'varname' => 'mod_fcgid_httpuser',
					'type' => 'text',
					'default' => 'froxlorlocal',
					'save_method' => 'storeSettingWebserverFcgidFpmUser',
					'websrv_avail' => array(
						'apache2'
					),
					'visible' => \Froxlor\Settings::Get('system.mod_fcgid') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				'system_mod_fcgid_httpgroup' => array(
					'label' => $lng['admin']['mod_fcgid_group'],
					'settinggroup' => 'system',
					'varname' => 'mod_fcgid_httpgroup',
					'type' => 'text',
					'default' => 'froxlorlocal',
					'save_method' => 'storeSettingField',
					'websrv_avail' => array(
						'apache2'
					),
					'visible' => \Froxlor\Settings::Get('system.mod_fcgid') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				'system_mod_fcgid_defaultini_ownvhost' => array(
					'label' => $lng['serversettings']['mod_fcgid']['defaultini_ownvhost'],
					'settinggroup' => 'system',
					'varname' => 'mod_fcgid_defaultini_ownvhost',
					'type' => 'select',
					'default' => '2',
					'option_options_method' => array(
						'\\Froxlor\\Http\\PhpConfig',
						'getPhpConfigs'
					),
					'save_method' => 'storeSettingField',
					'websrv_avail' => array(
						'apache2'
					),
					'visible' => \Froxlor\Settings::Get('system.mod_fcgid') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				/**
				 * php-fpm
				 */
				'system_phpfpm_enabled_ownvhost' => array(
					'label' => $lng['phpfpm']['ownvhost'],
					'settinggroup' => 'phpfpm',
					'varname' => 'enabled_ownvhost',
					'type' => 'checkbox',
					'default' => true,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('phpfpm.enabled') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				'system_phpfpm_httpuser' => array(
					'label' => $lng['phpfpm']['vhost_httpuser'],
					'settinggroup' => 'phpfpm',
					'varname' => 'vhost_httpuser',
					'type' => 'text',
					'default' => 'froxlorlocal',
					'save_method' => 'storeSettingWebserverFcgidFpmUser',
					'visible' => \Froxlor\Settings::Get('phpfpm.enabled') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				'system_phpfpm_httpgroup' => array(
					'label' => $lng['phpfpm']['vhost_httpgroup'],
					'settinggroup' => 'phpfpm',
					'varname' => 'vhost_httpgroup',
					'type' => 'text',
					'default' => 'froxlorlocal',
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('phpfpm.enabled') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				'system_phpfpm_defaultini_ownvhost' => array(
					'label' => $lng['serversettings']['mod_fcgid']['defaultini_ownvhost'],
					'settinggroup' => 'phpfpm',
					'varname' => 'vhost_defaultini',
					'type' => 'select',
					'default' => '2',
					'option_options_method' => array(
						'\\Froxlor\\Http\\PhpConfig',
						'getPhpConfigs'
					),
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('phpfpm.enabled') && call_user_func(array(
						'\Froxlor\Settings\FroxlorVhostSettings',
						'hasVhostContainerEnabled'
					))
				),
				/**
				 * DNS
				 */
				'system_dns_createhostnameentry' => array(
					'label' => $lng['serversettings']['dns_createhostnameentry'],
					'settinggroup' => 'system',
					'varname' => 'dns_createhostnameentry',
					'type' => 'checkbox',
					'default' => false,
					'save_method' => 'storeSettingField',
					'visible' => \Froxlor\Settings::Get('system.bind_enable')
				)
			)
		)
	)
);

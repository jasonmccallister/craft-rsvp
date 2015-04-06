<?php namespace Craft;

class RsvpPlugin extends BasePlugin {

	/**
	 * Get the plugins name.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return Craft::t('Rsvp');
	}

	/**
	 * Get the version of the plugin.
	 *
	 * @return string
	 */
	public function getVersion()
	{
		return '1.1.0';
	}

	/**
	 * Get the developers name.
	 *
	 * @return string
	 */
	public function getDeveloper()
	{
		return 'Jason McCallister';
	}

	/**
	 * Get the developers website.
	 *
	 * @return string
	 */
	public function getDeveloperUrl()
	{
		return 'http://letcoder.com';
	}

	/**
	 * @return bool
	 */
	public function hasCpSection()
	{
		return true;
	}

	/**
	 * Define settings for the plugin.
	 *
	 * @return array
	 */
	protected function defineSettings()
	{
		return array(
			'notificationEmail'     => array(
				AttributeType::Email,
				'required' => true
			),
			'notificationSubject'   => array(
				AttributeType::String,
				'required' => true,
				'default'  => "New RSVP!"
			),
			'notificationMessage'   => array(
				AttributeType::String,
				'required' => true,
				'default'  => "Congratulations! You have a new RSVP on your website!"
			),
			'sendConfirmationEmail' => array(
				AttributeType::Bool,
				'required' => false
			),
			'confirmationSubject'   => array(
				AttributeType::String,
				'required' => true,
				'default'  => "Thank You!"
			),
			'confirmationMessage'   => array(
				AttributeType::String,
				'required' => true,
				'default'  => "We have received your RSVP, if we have any questions we will be in touch. Thank you and have a great day!"
			)
		);
	}

	/**
	 * Return the settings template.
	 *
	 * @return mixed
	 */
	public function getSettingsHtml()
	{
		return craft()->templates->render('rsvp/_settings', array(
			'settings' => $this->getSettings()
		));
	}


	/**
	 * Register the plugins control panel routes.
	 *
	 * @return array
	 */
	public function registerCpRoutes()
	{
		return array(
			'rsvp' => array(
				'action' => 'rsvp/index'
			),
			'rsvp/new' => array(
				'action' => 'rsvp/new'
			),
			'rsvp/(?P<rsvpId>\d+)' => array(
				'action' => 'rsvp/view'
			)
		);
	}
}

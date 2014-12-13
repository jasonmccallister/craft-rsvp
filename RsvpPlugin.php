<?php
namespace Craft;

class RsvpPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Rsvp');
	}

	public function getVersion()
	{
		return '1.1';
	}

	public function getDeveloper()
	{
		return 'Jason McCallister';
	}

	public function getDeveloperUrl()
	{
		return 'http://www.letcoder.com';
	}

	public function hasCpSection()
	{
		return true;
	}

	protected function defineSettings()
	{
		 return array(
			'notificationEmail' => array(
				AttributeType::Email,
				'required' => true
			),
			'notificationSubject' => array(
				AttributeType::String,
				'required' => true,
				'default' => "New RSVP!"
			),
			'notificationMessage' => array(
				AttributeType::String,
				'required' => true,
				'default' => "Congratulations! You have a new RSVP on your website!"
			),
			'sendConfirmationEmail' => array(
				AttributeType::Bool,
				'required' => false
			),
			'confirmationSubject' => array(
				AttributeType::String,
				'required' => true,
				'default' => "Thank You!"
			),
			'confirmationMessage' => array(
				AttributeType::String,
				'required' => true,
				'default' => "We have received your RSVP, if we have any questions we will be in touch. Thank you and have a great day!"
			)
		);
	}

	public function getSettingsHtml()
	{
	   return craft()->templates->render('rsvp/_settings', array(
		   'settings' => $this->getSettings()
	   ));
	}


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

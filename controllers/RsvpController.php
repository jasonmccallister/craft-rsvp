<?php
namespace Craft;

class RsvpController extends BaseController
{

	private $rsvp;
	private $plugin;

	protected $allowAnonymous = array('actionSubmit');

	public function init()
	{
		$this->plugin = craft()->plugins->getPlugin('rsvp');

		if (!$this->plugin)
		{
			throw new Exception("Couldn't find the Rsvp plugin!");
		}
	}

	public function actionIndex()
	{

		// get all rsvps from service
		$variables['rsvps'] = craft()->rsvp->getAllRsvps();

		// render template with variables
		$this->renderTemplate('rsvp/index', $variables);
	}

	public function actionView(array $variables = array())
	{
		if (!empty($variables['rsvpId']))
		{
			$variables['rsvp'] = craft()->rsvp->getRsvpById($variables['rsvpId']);
		}

		$this->renderTemplate('rsvp/view', $variables);


	}

	public function actionSubmit()
	{
		// require post
		$this->requirePostRequest();

		$errors = array();

		// make a new rsvp
		$model = new RsvpModel();

		// assign the attributes from the post to the model
		$model->name      = craft()->request->getPost('name');
		$model->email     = craft()->request->getPost('email');
		$model->phone     = craft()->request->getPost('phone');
		$model->guests    = craft()->request->getPost('guests');
		$model->attending = craft()->request->getPost('attending');
		$model->comments  = craft()->request->getPost('comments');

		// validate
		if ($model->validate())
        {
			// save it!
			craft()->rsvp->saveRsvp($model);

			// redirect to posted URL
			return $this->redirectToPostedUrl($variables = array());
		}

		else
		{

			if ($model->getError('name'))
            {
				$errors['name'] = 'Name is required';
			}

			if ($model->getError('email'))
            {
				$errors['email'] = 'Email address is required';
			}

			if ($model->getError('phone'))
            {
				$errors['phone'] = 'Phone number is required';
			}

			if ($model->getError('guests'))
            {
				$errors['guests'] = 'Number of guests is required';
			}

			// Send the data back to the template
			craft()->urlManager->setRouteVariables(array(
				'errors'	=> $errors,
				'name'		=> $model->name,
				'email'		=> $model->email,
				'phone'		=> $model->phone,
				'guests'	=> $model->guests,
			));

		}

	}
}

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

        // Craft::dd($variables);

        $this->renderTemplate('rsvp/view', $variables);


    }

    public function actionSubmit()
    {
        // require post
        $this->requirePostRequest();

        // make a new rsvp
        $rsvp = new RsvpModel();

        // assign the attributes from the post to the model
        $rsvp->name      = craft()->request->getPost('name');
        $rsvp->email     = craft()->request->getPost('email');
        $rsvp->phone     = craft()->request->getPost('phone');
        $rsvp->guests    = craft()->request->getPost('guests');
        $rsvp->attending = craft()->request->getPost('attending');
        $rsvp->comments  = craft()->request->getPost('comments');

        // Save it!
        craft()->rsvp->saveRsvp($rsvp);

        return $this->redirectToPostedUrl($variables = array());
    }
}

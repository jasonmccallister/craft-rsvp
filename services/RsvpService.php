<?php
namespace Craft;

class RsvpService extends BaseApplicationComponent
{
	protected $rsvpRecord;
	protected $_rsvpById;
	protected $rsvp;

	public function init($rsvpRecord = null)
	{
		$this->rsvpRecord = $rsvpRecord;

		if (is_null($this->rsvpRecord))
		{
			$this->rsvpRecord = RsvpRecord::model();
		}
	}

	public function getAllRsvps($indexBy = null)
	{
		$rsvps = RsvpRecord::model()->findAll();

		return $rsvps;
	}

	public function getRsvpById($rsvpId)
	{
		if (!isset($this->_rsvpById) || !array_key_exists($irsvpIdd, $this->_rsvpById))
		{
			$rsvpRecord = RsvpRecord::model()->findById($rsvpId);

			if ($rsvpRecord)
			{
				$this->_rsvpById[$rsvpId] = RsvpModel::populateModel($rsvpRecord);
			}
			else
			{
				$this->_rsvpById[$rsvpId] = null;
			}
		}

		return $this->_rsvpById[$rsvpId];
	}

	public function saveRsvp(RsvpModel $model)
	{
		$record = new RsvpRecord();

		$record->name       = $model->name;
		$record->email      = $model->email;
		$record->phone      = $model->phone;
		$record->attending  = $model->attending;
		$record->guests     = $model->guests;
		$record->comments 	= $model->comments;

		$record->validate();

		$model->addErrors($record->getErrors());

		if ($model->hasErrors())
		{
			return false;
		}

		$transaction = craft()->db->getCurrentTransaction() === null ? craft()->db->beginTransaction() : null;
		try
		{
			$record->save(false);

			if ($transaction !== null)
			{
				$transaction->commit();
			}


			else
			{
				return false;
			}
		}

		catch (\Exception $e)
		{
			if ($transaction !== null)
			{
				$transaction->rollback();
			}

			throw $e;
		}

		return true;
	}

	public function onSave(Event $event)
	{
		$this->raiseEvent('onSave', $event);

		$settings = craft()->plugins->getPlugin('rsvp')->getSettings();

		if (!empty($settings->notificationEmail)) {

			$email = new EmailModel();
			$email->toEmail = $settings->notificationEmail;
			$email->subject = $settings->notificationSubject;
			$email->body    = $settings->notificationMessage;

			craft()->email->sendEmail($email);

			// add another if statement for confirmation email
		}
	}

}

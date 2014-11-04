<?php
namespace Craft;

class RsvpService extends BaseApplicationComponent
{
    protected $rsvpRecord;
    protected $_rsvpById;

    public function init($rsvpRecord = null)
    {
        $this->rsvpRecord = $rsvpRecord;
        if (is_null($this->rsvpRecord)) {
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

        $record = $this->rsvpRecord->create();

        $record->setAttributes($model->getAttributes());

        if($record->save())
        {
            return true;
        }
        else
        {
            $model->addErrors($record->getErrors());

            return false;
        }
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

    // public function getTotalAttendees()
    // {
    //     // $records = $this->rsvpRecord->findAll(array(
    //     //     'attending' => 'Yes'
    //     // ));
    //
    //     $query = craft()->db->createCommand()
    //         // ->select('guests, attending')
    //         ->select('attending, guests')
    //         ->from('rsvps')
    //         // ->where('attending = ' . 'attending')
    //         ->where('attending=:attending', array(
    //             ':attending'=>'Yes'
    //         ))
    //         // ->where('attending=:attending', array(
    //         //     ':attending'=> 'Yes'
    //         // ))
    //         ->queryRow();
    //
    //
    //
    //     // $total = count ($query);
    //     $total = count ($query);
    //
    //     return $total;
    // }

}

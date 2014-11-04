<?php
namespace Craft;

class RsvpVariable
{
    /**
     * Get all RSVPs
     *
     * @return array
     */
    public function getAllRsvps()
    {
        return craft()->rsvp->getAllRsvps();
    }

    public function getTotalAttendees()
    {
        return craft()->rsvp->getTotalAttendees();
    }

}

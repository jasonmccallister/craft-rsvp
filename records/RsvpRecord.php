<?php
namespace Craft;

class RsvpRecord extends BaseRecord
{
    public function getTableName()
    {
        return 'rsvps';
    }

    public function defineAttributes()
    {
        return array(
            'name' => array(
                AttributeType::String,
                'required' => true
            ),
            'email' => array(
                AttributeType::String,
                'required' => true
            ),
            'phone' => array(
                AttributeType::String,
                'required' => true
            ),
            'attending' => array(
                AttributeType::String,
                'required' => true
            ),
            'guests' => array(
                AttributeType::Number,
                'required' => true
            ),
            'comments' => array(
                AttributeType::String,
                'required' => true
            ),
        );
    }

    public function create()
    {
        $class = get_class($this);
        $record = new $class();

        return $record;
    }
}

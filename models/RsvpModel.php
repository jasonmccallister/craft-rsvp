<?php
namespace Craft;

class RsvpModel extends BaseModel
{

    protected function defineAttributes()
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

}

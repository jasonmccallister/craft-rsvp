<?php
namespace Craft;

class RsvpModel extends BaseModel
{
	// public $errors = array();

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
				AttributeType::String
			),
			'guests' => array(
				AttributeType::Number,
				'required' => true
			),
			'comments' => array(
				AttributeType::String
			),
		);
	}

	// public function validate()
	// {
	// 	// TODO: this is a hack, it return all if the error exists
	// 	$this->errors["name"] = "You forgot to fill out your name.";
	// 	$this->errors["email"]	= "You forgot to fill out your email.";
	// 	$this->errors["phone"]	= "You forgot to fill out your phone.";
	// 	$this->errors["guests"]	= "You forgot to fill out the number of guests.";
	// }

}

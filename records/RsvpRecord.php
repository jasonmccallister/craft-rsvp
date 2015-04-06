<?php namespace Craft;

class RsvpRecord extends BaseRecord {

	/**
	 * Get the table name for the records.
	 *
	 * @return string
	 */
	public function getTableName()
	{
		return 'rsvps';
	}

	/**
	 * Define the attributes for the table.
	 *
	 * @return array
	 */
	public function defineAttributes()
	{
		return array(
			'name'      => array(
				AttributeType::String
			),
			'email'     => array(
				AttributeType::String
			),
			'phone'     => array(
				AttributeType::String
			),
			'attending' => array(
				AttributeType::String
			),
			'guests'    => array(
				AttributeType::Number
			),
			'comments'  => array(
				AttributeType::String
			),
		);
	}

	/**
	 * Create a new instance of the current class. This allows us to
	 * properly unit test our service layer.
	 *
	 * @return BaseRecord
	 */
	public function create()
	{
		$class = get_class($this);
		$record = new $class();

		return $record;
	}
}

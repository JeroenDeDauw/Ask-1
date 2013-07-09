<?php

namespace Ask\Serializers;

use Ask\Language\Description\AnyValue;
use Ask\Language\Description\Description;
use Ask\Language\Description\DescriptionCollection;
use Ask\Language\Description\SomeProperty;
use Ask\Language\Description\ValueDescription;
use Ask\Serializers\Exceptions\UnsupportedObjectException;

/**
 * @since 0.1
 *
 * @file
 * @ingroup Ask
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class DescriptionSerializer implements Serializer {

	public function serialize( $askObject ) {
		$this->assertCanSerialize( $askObject );
		return $this->getSerializedDescription( $askObject );
	}

	protected function getSerializedDescription( Description $description ) {
		return array(
			'objectType' => 'description',
			'descriptionType' => $description->getType(),
			'value' => $this->getDescriptionValueSerialization( $description ),
		);
	}

	protected function getDescriptionValueSerialization( Description $description ) {
		if ( $description instanceof AnyValue ) {
			return array();
		}

		if ( $description instanceof SomeProperty ) {
			return array(
				'property' => $description->getPropertyId()->toArray(),
				'description' => $this->serialize( $description->getSubDescription() ),
				'isSubProperty' => $description->isSubProperty(),
			);
		}

		if ( $description instanceof ValueDescription ) {
			return array(
				'value' => $description->getValue()->toArray(),
				'comparator' => $description->getComparator(),
			);
		}

		if ( $description instanceof DescriptionCollection ) {
			$serializationMethod = array( $this, 'serialize' );

			return array(
				'descriptions' => array_map(
					function( Description $description ) use ( $serializationMethod ) {
						return call_user_func( $serializationMethod, $description );
					},
					$description->getDescriptions()
				)
			);
		}

		throw new UnsupportedObjectException( $description, $this );
	}

	protected function assertCanSerialize( $askObject ) {
		if ( !$this->canSerialize( $askObject ) ) {
			throw new UnsupportedObjectException( $askObject, $this );
		}
	}

	public function canSerialize( $askObject ) {
		return $askObject instanceof Description;
	}

}
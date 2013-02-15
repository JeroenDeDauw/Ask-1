<?php

namespace Ask\Language;
use Ask\Language\Description\Description;
use Ask\Language\SelectionRequest\SelectionRequest;

/**
 * Object representing a query definition.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @since 0.1
 *
 * @file
 * @ingroup Ask
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */
class Query implements \Ask\Immutable {

	/**
	 * @since 0.1
	 *
	 * @var Description
	 */
	protected $description;

	/**
	 * @since 0.1
	 *
	 * @var SelectionRequest[]
	 */
	protected $selectionRequests;

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 *
	 * @param Description $description
	 * @param SelectionRequest[] $selectionRequests
	 */
	public function __construct( Description $description, array $selectionRequests ) {
		$this->description = $description;
		$this->selectionRequests = $selectionRequests;
	}

	/**
	 * @since 0.1
	 *
	 * @return Description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @since 0.1
	 *
	 * @return SelectionRequest[]
	 */
	public function getSelectionRequests() {
		return $this->selectionRequests;
	}

	// TODO: limit, etc

}

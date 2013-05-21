<?php

/**
 * Initialization file for the Ask library.
 *
 * Documentation:	 		https://www.mediawiki.org/wiki/Extension:Ask
 * Support					https://www.mediawiki.org/wiki/Extension_talk:Ask
 * Source code:				https://gerrit.wikimedia.org/r/gitweb?p=mediawiki/extensions/Ask.git
 *
 * @file
 * @ingroup Ask
 *
 * @licence GNU GPL v2+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

/**
 * This documentation group collects source code files belonging to Ask.
 *
 * @defgroup Ask Ask
 */

/**
 * Tests part of the Ask extension.
 *
 * @defgroup AskTests AskTest
 * @ingroup Ask
 * @ingroup Test
 */

// Attempt to include the DataValues lib if that hasn't been done yet.
if ( !defined( 'DataValues_VERSION' ) ) {
	@include_once( __DIR__ . '/../DataValues/DataValues.php' );
}

// Only initialize the extension when all dependencies are present.
if ( !defined( 'DataValues_VERSION' ) ) {
	throw new Exception( 'You need to have the DataValues library loaded in order to use Ask' );
}

define( 'Ask_VERSION', '0.1 alpha' );

// @codeCoverageIgnoreStart
spl_autoload_register( function ( $className ) {
	$className = ltrim( $className, '\\' );
	$fileName = '';
	$namespace = '';

	if ( $lastNsPos = strripos( $className, '\\') ) {
		$namespace = substr( $className, 0, $lastNsPos );
		$className = substr( $className, $lastNsPos + 1 );
		$fileName  = str_replace( '\\', '/', $namespace ) . '/';
	}

	$fileName .= str_replace( '_', '/', $className ) . '.php';

	$namespaceSegments = explode( '\\', $namespace );

	if ( $namespaceSegments[0] === 'Ask' ) {
		if ( count( $namespaceSegments ) === 1 || $namespaceSegments[1] !== 'Tests' ) {
			require_once __DIR__ . '/includes/' . $fileName;
		}
	}
} );

if ( defined( 'MEDIAWIKI' ) ) {
	call_user_func( function() {
		require_once __DIR__ . '/Ask.mw.php';
	} );
}

// @codeCoverageIgnoreEnd
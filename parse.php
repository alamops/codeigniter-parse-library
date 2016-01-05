<?php

/**
 * @author: Alamo Pereira Saravali
 * @email: alamo.sarvali@gmail.com
 * @github: alamops
 * @facebook: fb.me/alamosaravali
 * @twitter: @alamosaravali
 * @instagram: @alamoweb
 * @website: alamoweb.com.br
 */

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require_once "./parse/autoload.php";

use Parse\ParseClient;
use Parse\ParseUser;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseSessionStorage;

session_start ();

class Parse {

	private $lastError = null;
	
	public function __construct() {
		$appId = '*************';
		$restApiKey = '*************';
		$masterKey = '*************';
		
		// initialize parse
		ParseClient::initialize ( $appId, $restApiKey, $masterKey );
		
		// set session storage
		ParseClient::setStorage ( new ParseSessionStorage () );
	}
	
	// NEW OBJECT
	public function newObject($className) {
		return new ParseObject ( $className );
	}
	
	// SAVE OBJECT
	public function save($parseObject) {
		try {
			$parseObject->save ();
			return true;
		} catch ( ParseException $e ) {
			$this->lastError = $e;
			return false;
		}
	}
	
	// GET AN OBJECT
	public function get($className, $objectId) {
		$query = new ParseQuery ( $className );
		
		try {
			$parseObject = $query->get ( $objectId );
			$parseObject->status = 1;
			return $parseObject;
		} catch ( ParseException $e ) {
			$this->lastError = $e;
			
			$errorObject = new stdClass ();
			$errorObject->status = 0;
			$errorObject->code = $e->getCode ();
			$errorObject->message = $e->getMessage ();
			return $errorObject;
		}
	}
	
	// FIND OBJECTS
	public function find($className, $equalToArray = array(), $ascending = null, $desceding = null, $limit = null, $skip = null, $includeArray = array()) {
		$query = new ParseQuery ( $className );
		
		if ($equalToArray) {
			foreach ( $equalToArray as $key => $value ) {
				$query->equalTo ( $key, $value );
			}
		}
		
		if ($ascending) {
			$query->ascending ( $ascending );
		}
		
		if ($desceding) {
			$query->descending ( $descending );
		}
		
		if ($limit) {
			$query->limit ( $limit );
		}
		
		if ($skip) {
			$query->skip ( $skip );
		}
		
		if ($includeArray) {
			foreach ( $includeArray as $include ) {
				$query->includeKey ( $include );
			}
		}
		
		return $query->find ();
	}
	
	// FIRST OBJECT
	public function first($className, $equalToArray = array(), $ascending = null, $desceding = null, $skip = null, $includeArray = array()) {
		$query = new ParseQuery ( $className );
		
		if ($equalToArray) {
			foreach ( $equalToArray as $key => $value ) {
				$query->equalTo ( $key, $value );
			}
		}
		
		if ($ascending) {
			$query->ascending ( $ascending );
		}
		
		if ($desceding) {
			$query->descending ( $descending );
		}
		
		if ($skip) {
			$query->skip ( $skip );
		}
		
		if ($includeArray) {
			foreach ( $includeArray as $include ) {
				$query->includeKey ( $include );
			}
		}
		
		return $query->first ();
	}
	
	// GET LAST ERROR
	public function getLastError() {
		return $this->lastError;
	}
	
	// GET CURRENT USER
	public function getCurrentUser() {
		$user = ParseUser::getCurrentUser ();
		if (! $user) {
			return false;
		} else {
			$user = $user->fetch ( true );
			return $user;
		}
	}
	
	// USER LOGIN
	public function userLogin($username = null, $password = null) {
		if (! $username || ! $password) {
			return array (
					'status' => '0',
					'message' => 'Por favor, preencha todos os campos antes de prosseguir' 
			);
		}
		else {
			try {
				$user = ParseUser::logIn ( $username, $password );
				$user = $user->fetch ( true );
				
				if ($user) {
					return array (
							'status' => '1',
							'user' => $user 
					);
				} else {
					return array (
							'status' => '0',
							'message' => 'Username e Senha inválidos. Por favor, tente novamente.' 
					);
				}
			}
			catch ( ParseException $error ) {
				return array (
						'status' => '0',
						'message' => 'Username e Senha inválidos. Por favor, tente novamente.' 
				);
			}
		}
	}
}

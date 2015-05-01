<?php

namespace GF\Sessions;

interface ISession{
	
	public function getSessionId();
	
	public function saveSession();

	public function destroySessionId();

	public function __get($name);

	public function __set($name, $value);
}
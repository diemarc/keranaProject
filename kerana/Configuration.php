<?php
/*
 * This file is part of keranaProject
 * Copyright (C) 2017-2018  diemarc  diemarc@protonmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace kerana;

(!defined('__APPFOLDER__')) ? exit('No esta permitido el acceso directo a este archivo'):"";
/**
 * Configuración general, creamos una clase Configuracion
 * creamos dos metodos uno para setear y otra para recuperar valores de una variable
 */

class Configuration {
	
	private $variables;
	private static $instance;
	
	//Constructor
           
	private function __construct(){
		
		$this->variables = array();
	}
	
	//método para asignar variables, recibe dos parametros, nombre y su valor correspondiente a asignar
	
	public function set($nombre,$valor){
		
		if (!isset($this->variables[$nombre])) {
			
			$this->variables[$nombre] = $valor;
			
		}
	}
	
	// método para recuperar valor de una variable
	
	public function get($nombre){
		
		if(isset($this->variables[$nombre])){
			
			return $this->variables[$nombre];
		}
	
	}
	
	// método estático para el patrón singleton
	
	public static function singleton(){
		
		if (!isset(self::$instance)) {
			
			$c = __CLASS__;
			self::$instance = new $c;
			
		}
		
		return self::$instance;
		
	}
}
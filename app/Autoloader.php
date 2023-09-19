<?php
	namespace App;
	
	class Autoloader{

		public static function register(){
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		public static function autoload($class){

			//$class = Model\Managers\VehiculeManager (FullyQualifiedClassName)
			//namespace = Model\Managers, nom de la classe = VehiculeManager

			
			//divise une chaîne de caractères en un tableau de sous-chaînes en utilisant une expression régulière comme délimiteur. 
			$parts = preg_split('#\\\#', $class);
			

			// on extrait le dernier element 
			$className = array_pop($parts);
			

			// on créé le chemin vers la classe
			// concatène en utilisant le séparateur de répertoire DS, puis convertit le résultat en minuscules à l'aide de strtolower(). 
			// Ds car compatible avec plusieurs systèmes d'exploitation.
			$path = strtolower(implode(DS, $parts));
			

			//$path = 'model/manager'
			$file = $className.'.php';
			$filepath = BASE_DIR.$path.DS.$file;
			if(file_exists($filepath)){
              
				require $filepath;
			}
			
		}
	}

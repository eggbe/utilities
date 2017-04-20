<?php
namespace Eggbe\Utilities;

class AliasMaker {

	/**
	 * @var array
	 */
	private $Aliases = [];

	/**
	 * AliasMaker constructor.
	 * @param array $Rules
	 * @throws \Exception
	 */
	public function __construct(array $Rules) {
		foreach ($Rules as $condition => $rule){
			if (!preg_match('/^\\\?[\w\[\],\\\]+\*?$/', $condition)){
				throw new \Exception('Invalid condition: "' . $condition . '"!');
			}

			if (!preg_match('/^\\\?[\w&\\\]+$/', $rule)){
				throw new \Exception('Invalid rule: "' . $rule . '"!');
			}
		}
	}

	/**
	 * @param string $name
	 * @return  string
	 */
	public final function alike(string $name) {
		return $name;
	}
}

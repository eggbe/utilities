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
	public function __construct(array $Rules = []) {
		foreach ($Rules as $condition => $rule){

			/**
			 * The condition string with special characters
			 * have to been compiled into a regular expression.
			 *
			 * If the condition string includes unsupported characters an exception will be thrown here.
			 */
			if (!preg_match('/^\\\?[\w\[\],\\\]+\*?$/', $condition)){
				throw new \Exception('Invalid condition: "' . $condition . '"!');
			}

			$condition = '/^\/?' . preg_replace('/(\\\+)/',
				'\\\$1', preg_replace('/\*/', '.*', preg_replace_callback('/\[[\w,]+\]/', function($value){
					return '(' . implode('|', preg_split('/,+/', trim($value[0], ']['), -1, PREG_SPLIT_NO_EMPTY)) . ')';
				}, $condition))) . '$/';


			/**
			 * The replacement string have to be compiled
			 * because it could include special characters too.
			 *
			 * If the replacement string includes unsupported characters an exception will be thrown here.
			 */
			if (!preg_match('/^\\\?[\w&\\\]+$/', $rule)){
				throw new \Exception('Invalid rule: "' . $rule . '"!');
			}

			$rule = preg_replace('/(\\\+)/',
				'\\\$1', preg_replace('/&+/', '\$1', $rule));

			/**
			 * Eventually all compiled couples have to be storage in given order.
			 * The first accordance will be always returned so the order is important!
			 */
			$this->Aliases[$condition] =  $rule;
		}
	}

	/**
	 * @var array
	 */
	private $Cache = [];

	/**
	 * @param string $source
	 * @return  string
	 */
	public final function alike(string $source): string {
		if (isset($this->Cache[$source = preg_replace('/\\\+/', '\\', $source)])) {
			return $this->Cache[$source];
		}

		$this->Cache[$source] = $source;

		/**
		 * We don't like error control operator but it is useful sometime.
		 * If condition is wrong the original string have to be returned.
		 */
		foreach ($this->Aliases as $condition => $replacement) {
			if (@preg_match($condition, $source)) {
				$this->Cache[$source] = preg_replace($condition, $replacement, $source);
				break;
			}
		}

		return $this->Cache[$source];
	}
}

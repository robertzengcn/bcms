<?php
/**
 * 主测试类
 * */

class AllTests {
	/**
	 * 测试入口
	 * */
	public static function main() {
		PHPUnit_TextUI_TestRunner::run(self::suite());
	}

	public static function suite() {
		$list = self::getFiles();
		if (empty($list)) {
			return;
		}
		
		//导入测试类
		foreach ($list['filepath'] as $path) {
			require_once $path;
		}
		
		$suite = new PHPUnit_Framework_TestSuite('Zend Framework - Zend');
		
		//加入测试队列
		foreach ($list['classnames'] as $class) {
			$suite->addTestSuite($class); //最佳测试类
		}
		
		return $suite;
	}
	
	/**
	 * 获取所有需要测试的测试文件
	 * */
	protected static function getFiles() {
		$list = array();
		$doc = new DOMDocument();
		$doc->load('classes.xml');
		$classes = $doc->getElementsByTagName('class');
		if ( empty($classes) ) {
			return $list;
		}
		
		foreach ($classes as $class) {
			$list['filepath'][] = $class->getElementsByTagName('filepath')->item(0)->nodeValue;
			$list['classnames'][] = $class->getElementsByTagName('classname')->item(0)->nodeValue;
		}
		return $list;
	}
}


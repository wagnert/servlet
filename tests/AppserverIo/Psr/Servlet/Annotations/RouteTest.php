<?php

/**
 * AppserverIo\Psr\Servlet\Annotations\RouteTest
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Appserver
 * @package    Psr
 * @subpackage Servlet
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io-psr/servlet
 * @link       http://www.appserver.io
 */

namespace AppserverIo\Psr\Servlet\Annotations;

use AppserverIo\Lang\Reflection\ReflectionClass;
use AppserverIo\Psr\Servlet\Annotations\Route;

/**
 * Annotation to define a servlets routing.
 *
 * @category   Appserver
 * @package    Psr
 * @subpackage Servlet
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io-psr/servlet
 * @link       http://www.appserver.io
 */
class RouteTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test @Route annotation initialization.
     *
     * @return void
     */
    public function testGetRouteAnnotation()
    {

        // initialize the annotations to ignore and the aliases
        $ignore = array();
        $aliases = array('Route' => 'AppserverIo\Psr\Servlet\Annotations\Route');

        // we need to load the annotation instance from the mock servlet implementation
        $reflectionClass = new ReflectionClass('AppserverIo\Psr\Servlet\Annotations\HelloWorldServlet', $ignore, $aliases);
        $reflectionAnnotation = $reflectionClass->getAnnotation(Route::ANNOTATION);
        $routeAnnotation = $reflectionAnnotation->newInstance($reflectionAnnotation->getAnnotationName(), $reflectionAnnotation->getValues());

        // define the URL patterns and the initialization parameters
        $urlPattern = array('/helloWorld.do', '/helloWorld.do*');
        $initParams = array(array('name1', 'value1'), array('name2', 'value2'));

        // check te values
        $this->assertSame('helloWorld', $routeAnnotation->getName());
        $this->assertSame('Hello World', $routeAnnotation->getDisplayName());
        $this->assertSame('The Hello World! as servlet implementation.', $routeAnnotation->getDescription());
        $this->assertSame($urlPattern, $routeAnnotation->getUrlPattern());
        $this->assertSame($initParams, $routeAnnotation->getInitParams());
    }
}
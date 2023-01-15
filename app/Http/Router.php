<?php

namespace App\Http;

use \Closure;
use \Exception;
use \ReflectionFunction;

class Router
{

    /**
     * Complete URL of project (root)
     * @var string
     */
    private $url = '';

    /**
     * Prefix from all routes
     * @var string
     */
    private $prefix = '';

    /**
     * Route index
     * @var array
     */
    private $routes = [];

    /**
     * Request instance
     * @var Request
     */
    private $request;

    /**
     * Initiate the class and define values
     * @param string $url
     */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Set the routes prefix
     */
    private function setPrefix()
    {
        // Current URL info
        $parseUrl = parse_url($this->url);

        // Set prefix
        $this->prefix = $parseUrl['path'] ?? '';
    }

    /**
     * Add a route in the class
     * @param string $method
     * @param string $route
     * @param array $params
     */
    private function addRoute($method, $route, $params = [])
    {
        // Params validation
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        // Variable routes
        $params['variables'] = [];

        // Variable routes validation pattern
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        // URL validation pattern
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        // Add the route inside the class
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Set a GET route
     * @param string $route
     * @param array $params
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * Set a POST route
     * @param string $route
     * @param array $params
     */
    public function post($route, $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }

    /**
     * Set a PUT route
     * @param string $route
     * @param array $params
     */
    public function put($route, $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }

    /**
     * Set a DELETE route
     * @param string $route
     * @param array $params
     */
    public function delete($route, $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Return the URI without prefix
     * @return string
     */
    private function getUri()
    {
        $uri = $this->request->getUri();

        // Split the URI
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // Return the last position of the split above (/)
        return end($xUri);
    }

    /**
     * Return the data from current route
     * @return array
     */
    private function getRoute()
    {
        // URI
        $uri = $this->getUri();

        // Method
        $httpMethod = $this->request->getHttpMetod();

        // Validate routes
        foreach ($this->routes as $patternRoute => $methods) {
            // Checks if URI matches the pattern
            if (preg_match($patternRoute, $uri, $matches)) {
                // Checks method
                if (isset($methods[$httpMethod])) {
                    // Remove first position (first url route)
                    unset($matches[0]);

                    // Processed variables
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    // Return the route params
                    return $methods[$httpMethod];
                }

                // Method not allowed/defined
                throw new Exception("Método não permitido", 405);
            }
        }

        // URL not found
        throw new Exception("URL não encontrada", 404);
    }

    /**
     * Execute current URL
     * @return Response
     */
    public function run()
    {
        try {
            // GET current route
            $route = $this->getRoute();

            // Checks controller
            if (!isset($route['controller'])) {
                throw new Exception("A URL não pode ser processada", 500);
            }

            // Function args
            $args = [];

            // Reflection
            $reflection = new ReflectionFunction($route['controller']);
            foreach($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            // Function execution
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }
}

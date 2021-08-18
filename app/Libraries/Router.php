<?php

namespace App\Libraries;

class Router {

    public $routes = [
        'GET' => [],

        'POST' => [],
    ];

    public static function load($file)
    {
        // Initialize / Construct class
        $router = new static;
    
        // File where routes are stored
        require $file; 

        return $router;
    }


    /**
     * Get info about a certain route
     * @param $uri (string) the route to check
     * @param $requestType (string) GET or POST
     */
    public function direct($uri, $requestType)
    {
        if ($requestType != 'POST' && $requestType != 'GET') {
            return $requestType;
        }

        $uri = $this->checkForParameters($uri, $requestType);
        
        if (array_key_exists($uri, $this->routes[$requestType])) {
            $routeData = $this->stripFunctionName($this->routes[$requestType][$uri]);

            if (isset($routeData['middleware']) && $routeData['middleware'] !== false) {
                foreach($routeData['middleware'] as $key => $middleWare)
                {
                    if (!is_string($key)) {
                        throw new \Exception('This function expects a string.');
                    }
                    
                    new $middleWare($uri, $key);
                }
            }

            return $routeData;
        }

        throw new \Exception('No route defined for this route (' . $uri . " | " . print_r($this->routes[$requestType], true) . ')');
    }


    /**
     * Get route
     * @param $uri (string) the route
     * @param $controller (string) which controller to use
     * @param $middleWare (string) optional if you want to use any middleware
     */
    public function get($uri, $controller, array $middleware = [])
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'middleware' => $middleware
        ];
    }

    /**
     * Post route
     * @param $uri (string) the route
     * @param $controller (string) which controller to use
     * @param $middleWare (string) optional if you want to use any middleware
     */
    public function post($uri, $controller, array $middleware = [])
    {
        $this->routes['POST'][$uri] = [
            'controller' => $controller,
            'middleware' => $middleware
        ];
    }

    /**
     * Get route, function (@{functionName} and class from route)
     * @param $uri (string) the route
     */
    private function stripFunctionName($uri)
    {
        $class = str_ireplace('.php', '', $uri['controller']);

        $data = [
            'uri' => lcfirst($uri['controller']),
            'function' => 'index',
            'class' => str_replace('/', '\\', $class),
        ];

        $atSign = strpos($uri['controller'], '@');

        if ($atSign !== false)
        {
            $class = str_replace('/', '\\', substr($uri['controller'], 0, $atSign));
            $class = str_ireplace('.php', '', $class);
            $data = [
                'uri' => lcfirst(substr($uri['controller'], 0, $atSign)),
                'function' => substr($uri['controller'], $atSign + 1),
                'class' => $class,
                'middleware' => $uri['middleware'],
            ];
        }

        return $data;
    }


    /**
     * Check url for an id
     * @param $uri (string) the URL to search in
     * @param $requestType (string) the request type like GET or POST
     */
    private function checkForParameters($uri, $requestType)
    {
        if (empty($uri)) {
            return $uri;
        }

        $expl = explode('/', $uri);

        // When there's only one parameter, there's not ID to be found
        if (count($expl) === 1) {
            return $uri;
        }

        // It should be an integer value
        $id = (int)$expl[1];

        if ($id === 0) {
            return $uri;
        }

        // The 'main' route is the first occurance in the URL such as user, profile, home etc.
        $mainRoute = $expl[0];

        // The 'crud' parameter (if any) is the one after the ID that was found
        //  such as edit, delete 
        //  The full URL could be something like user/1/edit or education/10 or education/10/delete etc.
        $crudRoute = count($expl) >= 3 ? $expl[2] : '';

        // In the routes file an ID is written as {id}
        //  Now we have to rebuild the URI with '/{id}' because thats what's in the route:
        //  e.g. $router->get('user/{id}/edit', 'App/Controllers/UserController.php@edit')
        return $mainRoute . '/{id}' . (!empty($crudRoute) ? '/' . $crudRoute : '');
    }
}
<?php

if (! function_exists('is_excluded_route')) {
    function is_excluded_route($route)
    {
        $namespaces = array_map('valid_namespace', config('menu.exclude.namespaces'));
        if (count($namespaces) > 0
            && preg_match("/^(" . implode('|',
                    $namespaces) . ")(.*)/", trim($route->getActionName())) > 0) {
            return true;
        }

        $controllers = array_map('valid_namespace', config('menu.exclude.controllers'));
        if (count($controllers) > 0
            && preg_match("/^(" . implode('|', $controllers) . ")@(.*)/", trim($route->getActionName())) > 0) {
            return true;
        }

        $actions = array_map('valid_namespace', config('menu.exclude.actions'));
        if (count($actions) > 0
            && preg_match("/^(" . implode('|', $actions) . ")/", trim($route->getActionName())) > 0) {
            return true;
        }

        return false;
    }
}

if (! function_exists('is_working_route')) {
    function is_working_route($route)
    {
        $namespaces = array_map('valid_namespace', config('menu.include.namespaces'));
        if (count($namespaces) > 0
            && preg_match("/^(" . implode('|',
                    $namespaces) . ")(.*)/", trim($route->getActionName())) > 0) {
            return true;
        }

        $controllers = array_map('valid_namespace', config('menu.include.controllers'));
        if (count($controllers) > 0
            && preg_match("/^(" . implode('|', $controllers) . ")@(.*)/", trim($route->getActionName())) > 0) {
            return true;
        }

        $actions = array_map('valid_namespace', config('menu.include.actions'));
        if (count($actions) > 0
            && preg_match("/^(" . implode('|', $actions) . ")/",
                trim($route->getActionName())) > 0) {
            return true;
        }

        return false;
    }
}

if (! function_exists('explode_route')) {
    function explode_route($route)
    {
        $actionName = $route->getActionName();
        $action = substr($actionName, strpos($actionName, '@') + 1);
        $controller = substr($actionName, strrpos($actionName, '\\') + 1, -(strlen($action) + 1));
        return [
            'namespace'  => substr($actionName, 0, strrpos($actionName, '\\')),
            'controller' => $controller,
            'method'     => $route->methods[0],
            'action'     => $action
        ];
    }
}

if (! function_exists('valid_namespace')) {
    function valid_namespace($namespace)
    {
        return str_replace('\\', '\\\\', $namespace);
    }
}

<?php

function load(string $controller, string $action, ...$params)
{
    try {
        $controllerNameSpace = "app\\Controllers\\{$controller}";

        if (!class_exists($controllerNameSpace)) {
            throw new \Exception("Controller {$controllerNameSpace} not found");
        }

        $controllerInstance = new $controllerNameSpace();

        if (!method_exists($controllerInstance, $action)) {
            throw new \Exception("Action {$action} not found");
        }

        call_user_func_array([$controllerInstance, $action], $params);
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}


$router = [
    "GET" => [
        '/' => fn() => load("FormController", "index"),
        '/nova-ficha' => fn() => load("FormController", "newForm"),
        '/editar-ficha/(\d+)' => fn($id) => load("FormController", "editForm", $id),
        '/imprimir/(\d+)' => fn($id) => load("FormController", "print", $id),
        '/ficha/(\d+)' => fn($id) => load("FormController", "show", $id),
        '/api/data' => fn() => load("FormController", "getAllJson"),
    ],
    "POST" => [
        '/criar-ficha' => fn() => load("FormController", "create"),
        '/atualizar-ficha/(\d+)' => fn($id) => load("FormController", "update", $id),
    ],
    "DELETE" => [
        '/deletar-ficha/(\d+)' => fn($id) => load("FormController", "delete", $id),
    ]
];

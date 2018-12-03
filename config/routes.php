<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks(DashedRoute::class);
});

Router::scope('/api/v1', function (RouteBuilder $routes) {
    
    /**
     * マスター用
     */
    $routes->get('/pokemons', ['prefix' => 'api/master', 'controller' => 'Pokemons', 'action' => 'getList']);
    $routes->get('/pokemons/:zukanNo/:subNo', ['prefix' => 'api/master', 'controller' => 'Pokemons', 'action' => 'get'])->setPass(['zukanNo', 'subNo']);
    $routes->get('/pokemons/:zukanNo/:subNo/skills', ['prefix' => 'api/master', 'controller' => 'Pokemons', 'action' => 'getSkills'])->setPass(['zukanNo', 'subNo']);
    $routes->get('/qualities', ['prefix' => 'api/master', 'controller' => 'Qualities', 'action' => 'getList']);
    $routes->get('/qualities/:qualityId', ['prefix' => 'api/master', 'controller' => 'Qualities', 'action' => 'get'])->setPass(['qualityId']);
    $routes->get('/skills', ['prefix' => 'api/master', 'controller' => 'Skills', 'action' => 'getList']);
    $routes->get('/skills/:skillId', ['prefix' => 'api/master', 'controller' => 'Skills', 'action' => 'get'])->setPass(['skillId']);
    
    /**
     * 育成用
     */
    $routes->get('/pokemons/:zukanNo/:subNo/soldiers', ['prefix' => 'api/traning', 'controller' => 'Soldiers', 'action' => 'getList'])->setPass(['zukanNo', 'subNo']);
    $routes->post('/pokemons/:zukanNo/:subNo/soldiers', ['prefix' => 'api/traning', 'controller' => 'Soldiers', 'action' => 'add'])->setPass(['zukanNo', 'subNo']);
    $routes->get('/pokemons/:zukanNo/:subNo/soldiers/:soldierId', ['prefix' => 'api/traning', 'controller' => 'Soldiers', 'action' => 'get'])->setPass(['zukanNo', 'subNo', 'soldierId']);
    $routes->put('/pokemons/:zukanNo/:subNo/soldiers/:soldierId', ['prefix' => 'api/traning', 'controller' => 'Soldiers', 'action' => 'update'])->setPass(['zukanNo', 'subNo', 'soldierId']);
    $routes->delete('/pokemons/:zukanNo/:subNo/soldiers/:soldierId', ['prefix' => 'api/traning', 'controller' => 'Soldiers', 'action' => 'delete'])->setPass(['zukanNo', 'subNo', 'soldierId']);

    $routes->get('/pokemons/:zukanNo/:subNo/roleTargets', ['prefix' => 'api/traning', 'controller' => 'RoleTargets', 'action' => 'getList'])->setPass(['zukanNo', 'subNo']);
    $routes->post('/pokemons/:zukanNo/:subNo/roleTargets', ['prefix' => 'api/traning', 'controller' => 'RoleTargets', 'action' => 'add'])->setPass(['zukanNo', 'subNo']);
    $routes->put('/pokemons/:zukanNo/:subNo/roleTargets/:targetId', ['prefix' => 'api/traning', 'controller' => 'RoleTargets', 'action' => 'update'])->setPass(['zukanNo', 'subNo', 'targetId']);
    $routes->delete('/pokemons/:zukanNo/:subNo/roleTargets/:targetId', ['prefix' => 'api/traning', 'controller' => 'RoleTargets', 'action' => 'delete'])->setPass(['zukanNo', 'subNo', 'targetId']);
    
    /**
     * 対戦用
     */
    $routes->get('/pokemons/supports', ['prefix' => 'api/battle', 'controller' => 'Supports', 'action' => 'getList']);
    $routes->post('/pokemons/supports', ['prefix' => 'api/battle', 'controller' => 'Supports', 'action' => 'add']);
    $routes->put('/pokemons/supports/:supportId', ['prefix' => 'api/battle', 'controller' => 'Supports', 'action' => 'update'])->setPass(['supportId']);
    $routes->delete('/pokemons/supports/:supportId', ['prefix' => 'api/battle', 'controller' => 'Supports', 'action' => 'delete'])->setPass(['supportId']);
    
    $routes->fallbacks(DashedRoute::class);
});

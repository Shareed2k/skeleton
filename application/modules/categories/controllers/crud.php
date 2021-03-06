<?php
/**
 * @author   Viacheslav Nogin
 * @created  25.11.12 09:29
 */
namespace Application;

use Application\Categories;
use Bluz\Controller;
use Application\Categories\Table;

return
/**
 * @privilege Management
 */
function ($parentId = null) use ($view) {
    /**
     * @var \Application\Bootstrap $this
     */
    $view->parentId = $parentId;

    $crudController = new Controller\Crud();
    $crudController->setCrud(Categories\Crud::getInstance());

    return $crudController();
};

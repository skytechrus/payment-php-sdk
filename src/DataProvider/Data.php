<?php


namespace Skytech\DataProvider;


use Skytech\Operation\Operation;

abstract class Data
{
    abstract protected function loadDataProvider($operationType, Operation $operation);
}

<?php
namespace CDash\Test;

use CDash\ServiceContainer;
use CDash\Test\UseCase\UseCase;

class CDashUseCaseTestCase extends CDashTestCase
{
    /** @var  ServiceContainer $originalServiceContainer */
    private static $originalServiceContainer;

    public function setUseCaseModelFactory(UseCase $useCase)
    {
        self::$originalServiceContainer = ServiceContainer::getInstance();

        $mockServiceContainer = $this->getMockBuilder(ServiceContainer::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $mockServiceContainer
            ->expects($this->any())
            ->method('create')
            ->willReturnCallback(function ($class_name) use ($useCase) {
                $model = $this->getMockBuilder($class_name)
                    ->setMethods(['Insert', 'Update', 'Save'])
                    ->getMock();

                $model->expects($this->any())
                    ->method('Save')
                    ->willReturnCallback(function () use ($class_name, $model, $useCase) {
                        $model->Id = $useCase->getIdForClass($class_name);
                    });

                $model->expects($this->any())
                    ->method('Insert')
                    ->willReturnCallback(function () use ($class_name, $model, $useCase) {
                        $model->Id = $useCase->getIdForClass($class_name);
                    });

                return $model;
            });

        ServiceContainer::setInstance(ServiceContainer::class, $mockServiceContainer);
    }
}

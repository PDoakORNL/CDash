<?php
namespace CDash\Test;

use CDash\ServiceContainer;
use CDash\Test\UseCase\UseCase;
use DI;

class CDashUseCaseTestCase extends CDashTestCase
{
    /** @var  UseCase $useCase */
    protected $useCase;

    public function setUp()
    {
        parent::setUp();
        $di = ServiceContainer::getInstance();
        $container = $di->getContainer();

        // Site
        $container->set(\Site::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Site::class)
                ->setMethods(['Insert', 'Update'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // Project
        $container->set(\Project::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Project::class)
                ->setMethods(['Save'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // SiteInformation
        $container->set(\SiteInformation::class, DI\factory(function () {
            $model = $this->getMockBuilder(\SiteInformation::class)
                ->setMethods(['Save'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // BuildInformation
        $container->set(\BuildInformation::class, DI\factory(function () {
            $model = $this->getMockBuilder(\BuildInformation::class)
                ->setMethods(['Save'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // Build
        $container->set(\Build::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Build::class)
                ->setMethods(['Save', 'GetCommitAuthors'])
                ->getMock();
            $model
                ->expects($this->any())
                ->method('Save')
                ->willReturnCallback(function () use ($model) {
                    $model->Id = $this->useCase->getIdForClass(\Build::class);
                });
            $model
                ->expects($this->any())
                ->method('GetCommitAuthors')
                ->willReturnCallback(function () use ($model) {
                    return $this->useCase->getAuthors($model->SubProjectName);
                });
            $model->Filled = true;
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // Test
        $container->set(\Test::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Test::class)
                ->setMethods(['Insert'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // BuildTest
        $container->set(\BuildTest::class, DI\factory(function () {
            $model = $this->getMockBuilder(\BuildTest::class)
                ->setMethods(['Insert'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // TestMeasurement
        $container->set(\TestMeasurement::class, DI\factory(function () {
            $model = $this->getMockBuilder(\TestMeasurement::class)
                ->setMethods(['Insert'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // Label
        $container->set(\Label::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Label::class)
                ->setMethods(['Insert'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // Image
        $container->set(\Image::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Image::class)
                ->setMethods(['Load', 'Save', 'GetData'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));

        // Feed
        $container->set(\Feed::class, DI\factory(function () {
            $model = $this->getMockBuilder(\Feed::class)
                ->setMethods(['Insert', 'InsertBuild', 'InsertTest', 'InsertUpdate'])
                ->getMock();
            return $model;
        })->scope(DI\Scope::PROTOTYPE));
    }
    /*
    public function setUseCaseModelFactory(UseCase $useCase)
    {

        // TODO: Of course this pretty much prevents you from using your fancy new DI container
        $mockServiceContainer
            ->expects($this->any())
            ->method('create')
            ->willReturnCallback(function ($class_name) use ($useCase) {
                $model = $this->getMockBuilder($class_name)
                    ->setMethods(['Insert', 'Update', 'Save', 'GetCommitAuthors'])
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

                // Prevent Build::FillFromId from resetting our state
                if (\Build::class === $class_name) {
                    $model->Filled = true;
                    $model
                        ->expects($this->any())
                        ->method('GetCommitAuthors')
                        ->willReturnCallback(function () use ($useCase) {
                            return $useCase->getAuthors();
                        });
                }

                return $model;
            });

        ServiceContainer::setInstance(ServiceContainer::class, $mockServiceContainer);
    }
    */
}

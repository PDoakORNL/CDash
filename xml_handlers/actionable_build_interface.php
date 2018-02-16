<?php

/**
 * ActionableHandler
 */
interface ActionableBuildInterface
{
    /**
     * @return Build[]
     */
    public function getActionableBuilds();

    /**
     * @return Project
     */
    public function GetProject();
}

<?php
namespace CDash\Collection;

use TestMeasurement;

class TestMeasurementCollection extends Collection
{
    /**
     * @param TestMeasurement $measurement
     */
    public function add(TestMeasurement $measurement)
    {
        $key = str_replace(' ', '', $measurement->Name);
        parent::addItem($measurement, $key);
    }
}

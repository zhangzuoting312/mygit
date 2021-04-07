<?php
public function getUserYearEfforts($accounts, $year)
{
    return $this->loadExtension('effort')->getUserYearEfforts($accounts, $year);
}

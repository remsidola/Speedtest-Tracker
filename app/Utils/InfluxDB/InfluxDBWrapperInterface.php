<?php

namespace App\Utils\InfluxDB;

use App\Speedtest;

interface InfluxDBWrapperInterface
{
    public function testConnection(): bool;
    public function doesDatabaseExist(string $database): bool;
    public function createDatabase(string $database): bool;
    public function store(Speedtest $speedtest): bool;
}

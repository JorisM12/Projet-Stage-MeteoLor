<?php
class City
{
    private string $name;
    private array $location;
    private int $weather_code;
    private int $temperature;
    private int $gust;

    public function __construct(string $name, array $location, int $weather_code, int $temperature, int $gust)
    {
        $this->name = $name;
        $this->location = $location;
        $this->weather_code = $weather_code;
        $this->temperature = $temperature;
        $this->gust = $gust;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLocation(): array
    {
        return $this->location;
    }

    public function setLocation(array $location): void
    {
        $this->location = $location;
    }

    public function getWeatherCode(): int
    {
        return $this->weather_code;
    }

    public function setWeatherCode(int $weather_code): void
    {
        $this->weather_code = $weather_code;
    }

    public function getTemperature(): int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getGust(): int
    {
        return $this->gust;
    }

    public function setGust(int $gust): void
    {
        $this->gust = $gust;
    }
}

<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;
use App\Services\HttpService;

class LatestNews extends Component
{
    public $selectedApi;
    public $news;

    protected $httpService;

    private $allowedApis = [
        'https://newsapi.org/v2/top-headlines?country=it&apiKey=YOUR_KEY',
        'https://newsapi.org/v2/top-headlines?country=gb&apiKey=YOUR_KEY',
        'https://newsapi.org/v2/top-headlines?country=us&apiKey=YOUR_KEY',
    ];

    public function __construct()
    {
        $this->httpService = app(HttpService::class);
    }

    public function fetchNews()
    {
        if (filter_var($this->selectedApi, FILTER_VALIDATE_URL) === FALSE) {
            $this->news = 'Invalid URL';
            return;
        }

        if (!in_array($this->selectedApi, $this->allowedApis)) {
            $this->news = 'Unauthorized source blocked';
            return;
        }

        $parsedUrl = parse_url($this->selectedApi);

        if (isset($parsedUrl['host']) && str_contains($parsedUrl['host'], 'internal.finance')) {
            $this->news = 'Internal access denied';
            return;
        }

        try {
            $response = $this->httpService->getRequest($this->selectedApi);
            $this->news = json_decode($response, true);
        } catch (\Exception $e) {
            $this->news = 'Error fetching news';
        }
    }

    public function render()
    {
        return view('livewire.latest-news');
    }
}
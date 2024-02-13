<?php

namespace App;

use Illuminate\Support\Facades\Http;

class NYTimesFetcher {
  public $most_popular_base_path = '/svc/mostpopular/v2/';

    public function __construct($base_url = '') {
      // 
    }

    public function getMostPopularViewed()
    {
      return $this->fetchData($this->most_popular_base_path . 'viewed/1.json');
    }

    public function getMostPopularEmailed()
    {
      return $this->fetchData($this->most_popular_base_path . 'emailed/1.json');
    }

    public function getMostPopularShared()
    {
      return $this->fetchData($this->most_popular_base_path . 'shared/1.json');
    }

    public function getSinglePost($postId) {
        // $url = $this->base_url . "/post/" . $postId;
        // return $this->fetchData($url);
    }

    private function fetchData($url) {
      $response = Http::get(env('NYTIMES_API') . $url . '?api-key=' . env('NYTIMES_TOKEN'));
      return $response->json();
    }
}

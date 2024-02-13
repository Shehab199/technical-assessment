<?php

namespace App\Http\Controllers;

use App\NYTimesFetcher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class NYTimesAPIController extends Controller
{
    public $nytimes_fetcher;

    public function __construct()
    {
        $this->nytimes_fetcher = new NYTimesFetcher();
    }

    public function index()
    {
        $savedArticles = Cache::get('saved_articles', []);

        $data = [
            "most_popular_viewed" => $this->nytimes_fetcher->getMostPopularViewed(),
            "most_popular_emailed" => $this->nytimes_fetcher->getMostPopularEmailed(),
            "most_popular_shared" => $this->nytimes_fetcher->getMostPopularShared(),
            "savedArticles" => $savedArticles,
        ];

        return view('home', $data);
    }

    public function most($type)
    {
        $title = '';
        $articles = [];

        switch ($type) {
            case 'viewed':
                $title = 'Most Viewed Articles';
                $articles = $this->nytimes_fetcher->getMostPopularViewed();
                break;
            case 'shared':
                $title = 'Most Shared Articles';
                $articles = $this->nytimes_fetcher->getMostPopularShared();
                break;
            case 'emailed':
                $title = 'Most Emailed Articles';
                $articles = $this->nytimes_fetcher->getMostPopularEmailed();
                break;
            default:
                abort(404);
        }

        $articles = $articles['results'];
        $currentPage = request()->get('page', 1);
        $search = request()->get('s', '');
        $selectedSection = request()->get('selected_section', '');
        $selectedByline = request()->get('selected_author', '');
        $selectedType = request()->get('selected_type', '');
        $perPage = 6; // Number of items per page

        // Searching articles
        $filteredArticles = array_filter($articles, function ($article) use ($search, $selectedSection, $selectedByline, $selectedType) {
            // Check if the title or abstract contains the search term
            $matchSearch = strpos(strtolower($article['title']), strtolower($search)) !== false
            || strpos(strtolower($article['abstract']), strtolower($search)) !== false;

            // Check if the section, byline, and type match the selected values
            $matchSection = $selectedSection == "" || $article['section'] === $selectedSection;
            $matchByline = $selectedByline == "" || $article['byline'] === $selectedByline;
            $matchType = $selectedType == "" || $article['type'] === $selectedType;

            // Return true if all conditions are met
            return $matchSearch && $matchSection && $matchByline && $matchType;
        });

        // Initialize empty arrays for each index
        $sections = [];
        $bylines = [];
        $types = [];

        // Iterate through the articles array
        foreach ($articles as $article) {
            // Add unique values to the corresponding arrays
            if (!in_array($article['section'], $sections)) {
                $sections[] = $article['section'];
            }

            if (!in_array($article['byline'], $bylines)) {
                $bylines[] = $article['byline'];
            }

            if (!in_array($article['type'], $types)) {
                $types[] = $article['type'];
            }
        }

        // Manually slice the array based on the current page and number of items per page
        $offset = ($currentPage - 1) * $perPage;
        $pagedData = array_slice($filteredArticles, $offset, $perPage, true);

        // Create a LengthAwarePaginator instance
        $paginatedPosts = new LengthAwarePaginator(
            $pagedData, // Items for the current page
            count($filteredArticles), // Total items count
            $perPage, // Items per page
            $currentPage, // Current page
            ['path' => route('most', ['type' => $type])]// Additional paginator options
        );

        $savedArticles = Cache::get('saved_articles', []);

        return view('articles.index', [
            'articles' => $paginatedPosts,
            'title' => $title,
            'sections' => $sections,
            'bylines' => $bylines,
            'types' => $types,
            's' => $search,
            'selectedSection' => $selectedSection,
            'selectedByline' => $selectedByline,
            'selectedType' => $selectedType,
            'savedArticles' => $savedArticles,
        ]);
    }
}

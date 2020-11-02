<?php


namespace App\Service\RSS;

use App\Repository\FeedItemRepository;

class FeedFetchService
{
    protected $feed_validation_service;
    protected $feed_item_repository;

    public function __construct(FeedItemRepository $feed_item_repository, FeedValidationService $feed_validation_service)
    {
        $this->feed_validation_service = $feed_validation_service;
        $this->feed_item_repository = $feed_item_repository;
    }

    public function fetchFeed(string $feed_url): array
    {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $feed_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);

        $feed_data = curl_exec($handle);
        $rss_xml_string = simplexml_load_string($feed_data, 'SimpleXMLElement', LIBXML_NOCDATA);
        $rss_feed_items = $rss_xml_string->channel->item;

        $rss_feed_items_array = [];

        foreach ($rss_feed_items as $rss_feed_item) {
            $json = json_encode($rss_feed_item);
            $array = json_decode($json, TRUE);
            $rss_feed_items_array[] = $array;
        }

        return array_filter($rss_feed_items_array, function ($feed_item) {
            return $this->feed_validation_service->validateFeedItem($feed_item);
        });
    }
}

<?php


namespace App\Service\RSS;

class FeedValidationService
{
    /**
     * Attributes that can be present inside an <item> attribute according to the RSS spec
     */
    protected const RSS_ITEM_VALUES = [
        'title',
        'link',
        'description',
        'author',
        'category',
        'comments',
        'enclosure',
        'guid',
        'source',
        'pubDate',
    ];

    public function validateFeedItem($feed_item): bool
    {
        if (empty($feed_item)) {
            return false;
        }

        if (!isset($feed_item['title']) || !isset($feed_item['description'])) {
            return false;
        }

        $key_rss_item_values = array_combine(self::RSS_ITEM_VALUES, self::RSS_ITEM_VALUES);

        foreach ($feed_item as $key => $value) {
            if (!isset($key_rss_item_values[$key])) {
                return false;
            }
        }

        return true;
    }
}

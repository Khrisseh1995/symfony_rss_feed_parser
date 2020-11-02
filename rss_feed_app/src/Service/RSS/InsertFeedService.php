<?php
namespace App\Service\RSS;

use App\Entity\FeedItem;
use App\Repository\FeedItemRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class InsertFeedService
{
    protected $feed_item_repository;
    protected $feed_fetch_service;
    protected $entity_manager;

    public function __construct(
        EntityManagerInterface $entity_manager,
        FeedFetchService $feed_fetch_service,
        FeedItemRepository $feed_item_repository
    ) {
        $this->entity_manager = $entity_manager;
        $this->feed_item_repository = $feed_item_repository;
        $this->feed_fetch_service = $feed_fetch_service;
    }

    protected function removeDuplicateGuids(array $feed_items): array
    {
        $guids = array_map(function ($feed_item) {
            return $feed_item['guid'];
        }, $feed_items);

        $matching_feed_items = $this->feed_item_repository->findBy(['guid' => $guids]);

        $matching_guids = array_map(function ($feed_item) {
            return $feed_item->getGuid();
        }, $matching_feed_items);


        return array_filter($feed_items, function ($feed_item) use ($matching_guids) {
            return !in_array($feed_item['guid'], $matching_guids);
        });
    }

    public function bulkInsertFeedItems(array $feed_items)
    {

        $non_duplicate_feed_items = $this->removeDuplicateGuids($feed_items);

        foreach ($non_duplicate_feed_items as $feed_item) {

            $feed_item_to_insert = new FeedItem();
            foreach ($feed_item as $key => $value) {
                $method = 'set' . ucfirst($key);
                if ($key == 'pubDate') {
                    $formatted_date = DateTime::createFromFormat('D, d M Y H:i:s T', $value);
                    $feed_item_to_insert->$method($formatted_date);
                    continue;
                }
                $feed_item_to_insert->$method($value);
                $this->entity_manager->persist($feed_item_to_insert);
            }
        }
        $this->entity_manager->flush();
    }
}

<?php
// src/Controller/RssFeedController.php
namespace App\Controller;

use App\Entity\FeedItem;
use App\Repository\FeedItemRepository;
use App\Service\RSS\FeedFetchService;
use App\Service\RSS\FeedParseService;
use App\Service\RSS\InsertFeedService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class FeedController extends AbstractController
{
    /**
     * @Route("/rss/getFeed")
     * @param FeedFetchService $feed_fetch_service
     * @param InsertFeedService $insert_feed_service
     * @param FeedItemRepository $feed_item_repository
     * @return Response
     */
    public function getFeed(
        FeedFetchService $feed_fetch_service,
        InsertFeedService $insert_feed_service,
        FeedItemRepository $feed_item_repository
    ): Response {
        /**
         * Hard coding in the feed URL here, more than likely would be passed in via response.
         */
        $feed_data = $feed_fetch_service->fetchFeed("http://feeds.bbci.co.uk/news/world/europe/rss.xml");
        $insert_feed_service->bulkInsertFeedItems($feed_data);
        $rss_feed_values = $feed_item_repository->retrieveFeedsAscending();

        return $this->render('rss-feed/feed-page.html.twig', ['feed_items' => $rss_feed_values]);
    }
}

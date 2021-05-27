<?php

namespace Drupal\redirects_endpoint\Controller;

use Drupal;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\JsonResponse;

class RedirectsEndpointRestController
{
    /**
     * Get a single redirect
     *
     * @return JsonResponse
     */
    public function getRedirect(): JsonResponse
    {
        $source = $_GET['source'];
        $language = $_GET['language'] ?? '';
        $response = new JsonResponse();

        $query = Drupal::database()->select('redirect', 'r')
            ->condition('r.redirect_source__path', $source)
            ->fields('r');

        $result = $query->execute()->fetch();
        if (!$result){
            $response->setStatusCode(404);
        } else {
            $redirect_data = [
                'language' => $language,
                'source' => '/' . $source,
                'url' =>  Url::fromUri($result->redirect_redirect__uri, ['absolute' => false])->toString(),
                'statusCode' => $result->status_code
            ];

            $response->setData($redirect_data);
        }

        return $response;
    }
}

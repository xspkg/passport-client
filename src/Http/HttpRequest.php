<?php
/**
 * Created by PhpStorm.
 * User: Yxs <250915790@qq.com>
 * Date: 2019/5/6
 * Time: 16:30
 */

namespace XsKit\PassportClient\Http;

use XsKit\PassportClient\Contracts\HttpRequestContract;
use XsKit\PassportClient\Contracts\HttpResponseContract;
use GuzzleHttp\Exception\GuzzleException;

class HttpRequest extends AbstractRequest implements HttpRequestContract
{

    /**
     * @return HttpResponseContract
     */
    public function get(): HttpResponseContract
    {
        $this->guzzleOptions['query'] = $this->param;
        return $this->send('GET');
    }

    /**
     * @return HttpResponseContract
     */
    public function post(): HttpResponseContract
    {
        $this->guzzleOptions['form_params'] = $this->param;
        return $this->send('POST');
    }

    /**
     * @return HttpResponseContract
     */
    public function put(): HttpResponseContract
    {
        $this->guzzleOptions['json'] = $this->param;
        return $this->send('PUT');
    }

    /**
     * @return HttpResponseContract
     */
    public function delete(): HttpResponseContract
    {
        $this->guzzleOptions['query'] = $this->param;
        return $this->send('DELETE');
    }

    /**
     * @return HttpResponseContract
     */
    public function options(): HttpResponseContract
    {
        $this->guzzleOptions['query'] = $this->param;
        return $this->send('OPTIONS');
    }

    /**
     * @return HttpResponseContract
     */
    public function patch(): HttpResponseContract
    {
        $this->guzzleOptions['form_params'] = $this->param;
        return $this->send('PATCH');
    }

    /**
     * @return HttpResponseContract
     */
    public function head(): HttpResponseContract
    {
        $this->guzzleOptions['query'] = $this->param;
        return $this->send('HEAD');
    }

    public function upload(): HttpResponseContract
    {
        $this->guzzleOptions['body'] = $this->param;
        return $this->send('POST');
    }

    /**
     * @param string $method
     * @return HttpResponse
     */
    public function send($method = ''): HttpResponseContract
    {
        $httpResponse = new HttpResponse($this->options);
        try {
            if ($this->request) {
                $res = $this->http->send($this->request, $this->guzzleOptions);
            } else {
                $res = $this->http->request($method, $this->query, $this->guzzleOptions);
            }

            $httpResponse->receive($res);
        } catch (\Throwable|GuzzleException  $e) {
            $httpResponse->throwException($e);
        } finally {
            return $httpResponse;
        }
    }
}
<?php
/**
 * FileName: PageUrlManager.php
 * Author: dingwenhua
 * Date: 2015/07/31 12:23
 */
namespace common\components;

use Yii;
use yii\data\Pagination;

class CmsPagination extends Pagination
{
    /**
     * Creates the URL suitable for pagination with the specified page number.
     * This method is mainly called by pagers when creating URLs used to perform pagination.
     * @param integer $page the zero-based page number that the URL should point to.
     * @param integer $pageSize the number of items on each page. If not set, the value of [[pageSize]] will be used.
     * @param boolean $absolute whether to create an absolute URL. Defaults to `false`.
     * @return string the created URL
     * @see params
     * @see forcePageParam
     */
    public function createUrl($page, $pageSize = null, $absolute = false)
    {
        $page = (int) $page;
        $pageSize = (int) $pageSize;
        $paramsUrl = '';
        if (($params = $this->params) === null) {
            $request = Yii::$app->getRequest();
            $params = $request instanceof Request ? $request->getQueryParams() : [];
        }
        $paramsUrl = implode('/', $params);

        if ($page > 0 || $page >= 0 && $this->forcePageParam) {
            $params[$this->pageParam] = $page + 1;
        } else {
            unset($params[$this->pageParam]);
        }
        if ($pageSize <= 0) {
            $pageSize = $this->getPageSize();
        }
        if ($pageSize != $this->defaultPageSize) {
            $params[$this->pageSizeParam] = $pageSize;
        } else {
            unset($params[$this->pageSizeParam]);
        }
        $params[0] = $this->route === null ? Yii::$app->controller->getRoute() : $this->route;
        $urlManager = $this->urlManager === null ? Yii::$app->getUrlManager() : $this->urlManager;
        $baseUrl = $urlManager->getBaseUrl();
        if ($absolute) {
            return $urlManager->createAbsoluteUrl($params);
        } else {
            return $baseUrl.'/'.$params[0].'/'.$paramsUrl.'/'.$params['page'];
            //return $urlManager->createUrl($params);
        }
    }
}

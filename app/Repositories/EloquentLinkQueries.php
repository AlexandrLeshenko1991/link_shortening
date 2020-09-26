<?php

namespace App\Repositories;

use App\Models\Links;
use App\Repositories\Interfaces\LinkQueries;

final class EloquentLinkQueries implements LinkQueries
{
    public function getById($id): Links
    {
        return Links::findOrFail($id);
    }


    /**
     * @param int $userId
     * @return Links[] | Collection
     */
    //для тестовой задачи ограничил вывод, пагинацию не реализовывал

    public function getUserLink($userId)
    {
        return Links::whereUserId($userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    /**
     * @param $custom_code
     * @return Links
     */


    public function getLinkByCode($custom_code) : Links
    {
        return Links::where('custom_code', $custom_code)->first();
    }

    /**
     * @param $link
     * @return Links[] | Collection
     */


    public function getLinkStatistic($link)
    {
        return $link->statistics()->get();
    }

}

<?php

namespace App\Repositories\Interfaces;

use App\Models\Links;

interface LinkQueries
{
    public function getById($id): Links;
    public function getUserLink($userId): Links;
    public function getLinkByCode($custom_code) : Links;
    public function getLinkStatistic(Links $link): Links;
}

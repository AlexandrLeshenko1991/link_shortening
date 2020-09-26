<?php
namespace App\Repositories\Interfaces;

use App\Models\Links;

interface LinkRepository
{
    public function save(Links $link): Links;
    public function updateCount($id);
    public function addStatistic($link, $request);
}

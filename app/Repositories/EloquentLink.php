<?php
namespace App\Repositories;

use App\Models\Links;
use App\Models\StatisticLinks;
use Browser;
use Illuminate\Support\Str;
use App\Repositories\Interfaces\LinkRepository;
use Illuminate\Support\Facades\Http;

final class EloquentLink implements LinkRepository
{
    private $api_url = 'http://ipwhois.app/json/';

    public function save(Links $link): Links
    {
        $link = $this->createNewCustomCode($link);
        if ($link->save()){
            return $link;
        }
    }

    public function updateCount($id)
    {
        $link = Links::find($id);
        $link->increment('clicks');
        return  $link->save();
    }

    public function addStatistic($link, $request)
    {
        $ip = $request->ip();
        $statistic_model_start = [
            'ip'=> $ip,
            'browser' => Browser::browserName(),
            'os' => Browser::platformName(),
            'region' => $this->getRegion($ip),
        ];
        $statistic = new StatisticLinks($statistic_model_start);
        $link->statistics()->save($statistic);
    }

    private function getRegion($ip)
    {
        $region = 'No info';
        $response = Http::get($this->api_url.$ip);
        if ($response->ok()){
            $json = $response->json();
            $region = $json['country']??'No info';
        }

        return $region;
    }

    private function createNewCustomCode(Links   $link){
        $custom_code = strtolower(Str::random(8));
        $link->custom_code = $custom_code;

        if ($this->checkUniqueLink($link)){
            $this->createNewCustomCode($link);
        }
        return $link;
    }

    private function checkUniqueLink(Links $link)
    {
        return !!Links::where('custom_code', $link->custom_code)->first();
    }

}

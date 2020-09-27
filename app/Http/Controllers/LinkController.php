<?php

namespace App\Http\Controllers;


use App\Models\Links;
use App\Repositories\EloquentLink;
use App\Repositories\EloquentLinkQueries;
use App\Jobs\AddStatistic;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;



class LinkController extends Controller
{
    /**
     * @var EloquentLinkQueries
     */
    private $eloquentLinkQueries;
    /**
     * @var EloquentLink
     */
    private $linkRepository;

    /**
     * Create a new controller instance.
     *
     * @param EloquentLinkQueries $eloquentLinkQueries
     * @param EloquentLink $linkRepository
     */
    public function __construct(EloquentLinkQueries $eloquentLinkQueries, EloquentLink $linkRepository  )
    {
        $this->middleware('auth')->except('customLink');
        $this->eloquentLinkQueries = $eloquentLinkQueries;
        $this->linkRepository = $linkRepository;
    }
    /**
     * @param  Request  $request
     * @return Factory|RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function index(Request $request)
    {
        return view('site.link.index');
    }

    /**
     * @return Factory|View
     */
    public function allLinks()
    {
        $all_user_link = $this->eloquentLinkQueries->getUserLink(Auth::user()->id);
        return view('site.link.all', compact('all_user_link'));
    }

    /**
     * @param $custom_code
     * @param EloquentLinkQueries $eloquentLinkQueries
     * @param EloquentLink $linkRepository
     * @param Request $request
     * @return Factory|View
     */
    public function customLink($custom_code, Request $request)
    {
        $link = $this->eloquentLinkQueries->getLinkByCode($custom_code);
        $this->linkRepository->updateCount($link->id);

        dispatch(new AddStatistic($this->linkRepository, $link, $request))->afterResponse();

        return redirect()->away($link->original);
    }

    public function oneLink($id)
    {
        $link = $this->eloquentLinkQueries->getById($id);

        if (Auth::user()->id !== $link->user_id) return new Response('Forbidden', 403);

        return view('site.link.one', compact('link'));
    }

    public function linkStatistic($id)
    {
        $link = $this->eloquentLinkQueries->getById($id);
        $statistic = $this->eloquentLinkQueries->getLinkStatistic($link);
        if (Auth::user()->id !== $link->user_id) return new Response('Forbidden', 403);

        return view('site.link.statistic', compact('link', 'statistic'));
    }



    public function add(Request $request)
    {
        \Validator::make(
            $request->all(),
            [
                'original'      => ['required', 'url'],
            ],
        )->validate();

        $links = new Links($request->only(['original']));
        $links->user_id = Auth::user()->id;

        $newLink = $this->linkRepository->save($links);
        $request->session()->flash('add_new_link_success', __('Add new link!'));

        return redirect()->route('link', [$newLink->id]);
    }

}

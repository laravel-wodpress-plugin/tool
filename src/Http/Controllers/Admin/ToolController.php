<?php


namespace TinhPHP\Tool\Http\Controllers\Admin;

use TinhPHP\Tool\Models\ToolShortLink;
use App\Services\MediaService;
use TinhPHP\Tool\Services\ToolService;
use TinhPHP\Tool\Services\ToolShortLinkService;
use Illuminate\Http\Request;

/**
 * Class ToolController
 * @package App\Http\Controllers\Admin
 * @property ToolService $toolService
 * @property MediaService $mediaService
 * @property ToolShortLinkService $toolShortLinkService
 */
class ToolController extends AdminToolController
{
    public function __construct(
        ToolService $toolService,
        MediaService $mediaService,
        ToolShortLinkService $toolShortLinkService
    ) {
        parent::__construct();
        $this->toolService = $toolService;
        $this->mediaService = $mediaService;
        $this->toolShortLinkService = $toolShortLinkService;
    }

    public function index()
    {
        return redirect(admin_url('tools/short_link'));
    }

    public function shortLink(Request $request)
    {
        $this->toolShortLinkService->buildCondition($request->all(), $condition, $sortBy, $sortType);
        $items = ToolShortLink::query()->where($condition)->orderBy($sortBy, $sortType)->paginate($this->page_number);

        $data = [
            'title' => trans('nav.menu_left.tool_short_link'),
            'items' => $items,
        ];
        return view('view_tool::admin.short_link.list', $this->render($data));
    }

    public function createShortLink()
    {
        $data = [
            'short_url' => $this->toolShortLinkService->generateShortUrl(),
            'title' => trans('common.add') . ' ' . trans('nav.menu_left.tool_short_link'),
        ];

        return view('view_tool::admin.short_link.form', $this->render($data));
    }

    public function handleCreateShortLink(Request $request)
    {
        $params = $request->all();
        if (!empty($params['_token'])) {
            $result = $this->toolShortLinkService->create($params);
            if (empty($result['message'])) {
                $request->session()->flash('success', trans('common.add.success'));

                return redirect(admin_url('tools/short_link'), 302);
            } else {
                $request->session()->flash('error', $result['message']);
            }
        }

        return back()->withInput();
    }
}

<?php
/**
 * @author: nguyentinh
 * @time: 2021/09/25
 */

namespace TinhPHP\Tool\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Class QrcodeController.
 */
class QrcodeController extends ToolController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $slug = 'url')
    {
        $data = [
            'active_menu' => 'generate_qrcode',
            'sub_active_menu' => $slug,
            'keyword' => 'QR Code Generator for URL, vCard, and more. Add logo, colors, frames, and download in high print quality. Get your free QR Codes now!',
            'description' => 'QR Code Generator for URL, vCard, and more. Add logo, colors, frames, and download in high print quality. Get your free QR Codes now!',
            'title' => 'QR Code Generator | Create Your Free QR Codes'
        ];

        $view = 'view_tool::web.qrcode.'.$slug;

        if (!view()->exists($view)) {
            $view = 'view_tool::web.qrcode.url';
        }

        return view($view, $this->render($data));
    }

    public function download(Request $request, $slug)
    {
        $isDownload = 1;
        switch ($slug) {
            case 'url':
                $fileName = $slug.'-'.Str::slug($request->get('url')).'.png';
                $content = QrCode::format('png')->size(500)->generate($request->get('url'));
                break;

            case 'email':
                $fileName = $slug.'-'.Str::slug($request->get('email')).'.png';
                $content = QrCode::format('png')->size(500)->email(
                    $request->get('email'),
                    $request->get('title'),
                    $request->get('content')
                );
                break;

            case 'sms':
                $fileName = $slug.'-'.Str::slug($request->get('sms')).'.png';
                $content = QrCode::format('png')->size(500)->SMS($request->get('sms'));
                break;

            case 'text':
                $fileName = $slug.'-'.Str::slug(Str::limit($request->get('content'), 50)).'.png';
                $content = QrCode::format('png')->size(500)->generate($request->get('content'));
                break;

            default:
                $isDownload = 0;
                $fileName = '';
                $content = '';
                break;
        }

        if ($isDownload) {
            $fileName = 'tmp/'.date('Y/m/d/').$fileName;
            Storage::disk('public')->put($fileName, $content);
            return response()->download(Storage::disk('public')->path($fileName));
        }

        return redirect(base_url('tool/generate-qrcode'));
    }
}

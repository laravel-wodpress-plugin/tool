<?php
/**
 * @author: nguyentinh
 * @time: 10/29/19 4:05 PM
 */

namespace TinhPHP\Tool\Http\Controllers;

use Illuminate\Session\Store;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class FacebookController.
 *
 */
final class FacebookController extends ToolController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function icon()
    {
        $pathFile = public_path('site/emoji/emoji.txt');

        $data = [
            'active_menu' => 'facebook_icon',
            'file_name' => $pathFile,
            'keyword' => 'icon facebook, mat cuoi facebook, fbook, facebook emoticon, smile facebook, facebook symbols, bieu tuong facebook, emoji, viet status facebook',
            'description' => 'Tổng hợp full bộ icon facebook đầy đủ nhất, mới nhất với nhiều trạng thái khác nhau, công cụ viết status facebook kèm icon tiện lợi nhất chỉ cần click vào biểu tượng cảm xúc facebook và chọn nhiều icon facebook khác nhau',
            'title' => '👋 Icon emoji, Full trọn bộ 4000 icon facebook mới nhất - 😃 Biểu tượng cảm xúc fb 💁👌🎍😍'
        ];
        return view('view_tool::web.facebook.icon', $this->render($data));
    }

    public function text($type = 'text')
    {
        $showAffiliate = request()->cookie('a0');

        $data = [
            'showAffiliate' => $showAffiliate,
            'active_menu' => 'facebook_text',
            'sub_active_menu' => 'sub_facebook_' . $type,
            'description' => 'Công cụ đổi font chữ Facebook online miễn phí với hơn 80 phông ĐẸP, ĐỘC, LẠ. Hãy tạo điểm nhấn trong từng nét chữ với Facebook Text Generator',
            'title' => 'Công cụ Đổi Font Chữ Facebook [kiểu đẹp thay thế YayText]',
            'keywords' => 'text,chữ,văn bản,đặc biệt,unicode,symbol,post,story,status,bài viết,miễn phí,Facebook',
        ];

        return response(view('view_tool::web.facebook.' . $type, $this->render($data)))->cookie('a0', 'ok', 10);
    }

    public function avatar()
    {
        $data = [
            'active_menu' => 'facebook_avatar',
        ];
        return view('view_tool::web.facebook.avatar', $this->render($data));
    }

    public function postAvatar()
    {
        // open an image file
        $path = request()->file('avatar')->store('public/upload/tool/facebook-avatar/' . date('Y/m/d'));

        $img = Image::make(storage_path('app/' . $path));

        // resize image instance
        $img->resize(500, 500);

        // insert a watermark
        $img->insert(public_path('site/img/tich-xanh-iframe.png'), 'center');

        // save image in desired format
        $img->save(storage_path('app/public/upload/tool/facebook-avatar/' . date('Y/m/d/') . time() . '-ok-img.png'))->mime();

        unlink(storage_path('app/' . $path));

    }
}

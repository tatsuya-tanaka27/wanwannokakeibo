<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Logic\KakeiboLogic;

/**
 * 家計簿一覧画面コントローラー
 * @author t_tanaka
 */
class ListController extends Controller
{
    /**
    * 一覧画面初期表示
    *
    * @param Request $request リクエストパラメーター
    * @return 一覧画面にリダイレクト
    */
    public function index(Request $request)
    {
        Log::info('[家計簿一覧画面初期表示]' );

        // 年月リストを取得
        $KakeiboDateList = $request->session()->get('KakeiboDateList');

        // 年月リストの中の最新年月を取得
        $KakeiboDate = $KakeiboDateList[0];

        // 表示用の年月を設定
        $disp_date = $KakeiboDate['year'] . '-' . $KakeiboDate['month'];

        // 家計簿データ一覧をDBから取得して、セッションにセットする
        KakeiboLogic::setKakeiboList($request, $disp_date);

        return view('kakeibo.list');
    }

    /**
    * 一覧ポスト処理
    *
    * @param Request $request リクエストパラメーター
    * @return 家計簿データ一覧
    */
    public function post(Request $request)
    {
        Log::info('[家計簿一覧画面表示年月切替処理開始]' );

        // 家計簿データ一覧をDBから取得して、セッションにセットする
        KakeiboLogic::setKakeiboList($request, $request->disp_date);

        // 家計簿データ一覧を取得
        $kakeiboList = $request->session()->get('kakeiboList');

        // 画面再描画用のHTMLテキスト
        $inner_html = "";

        foreach($kakeiboList as $data){
            $inner_html .= '<tr>' .
                                '<td>' . $data->item_name . '</td>' .
                                '<td>' . $data->amount . '</td>' .
                                '<td>' . $data->input_date . '</td>' .
                                '<td>' . $data->payer . '</td>' .
                                '<td>' . $data->remarks . '</td>' .
                            '</tr>';
        }

        Log::info('[家計簿一覧画面表示年月切替処理終了]' );

        return $inner_html;
    }
}

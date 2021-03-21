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
        $dispDate = $KakeiboDate['year'] . '-' . $KakeiboDate['month'];

        // 家計簿データ一覧をDBから取得して、セッションにセットする
        KakeiboLogic::setKakeiboData_dispDate($request, $dispDate);

        // 表示年月に紐づく家計簿データの各項目の集計金額を取得して、セッションにセットする
        KakeiboLogic::setAggregateData_dispDate($request, $dispDate);

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

        // 表示年月に紐づく家計簿データをDBから取得して、セッションにセットする
        KakeiboLogic::setKakeiboData_dispDate($request, $request->dispDate);

        // 表示年月に紐づく家計簿データを取得
        $kakeiboData_dispDate = $request->session()->get('kakeiboData_dispDate');

        // 表示年月に紐づく家計簿データの各項目の集計金額を取得して、セッションにセットする
        KakeiboLogic::setAggregateData_dispDate($request, $request->dispDate);

        // 表示年月に紐づく家計簿データの各項目の集計金額を取得
        $aggregateData_dispDate = $request->session()->get('aggregateData_dispDate');

        // 家計簿データ用の画面再描画HTMLテキスト
        $kakeiboData_html = "";

        foreach($kakeiboData_dispDate as $data){
            $kakeiboData_html .= '<tr>' .
                                '<td>' . $data->item_name . '</td>' .
                                '<td>' . $data->amount . '</td>' .
                                '<td>' . $data->input_date . '</td>' .
                                '<td>' . $data->remarks . '</td>' .
                            '</tr>';
        }

        // 集計金額用の画面再描画HTMLテキスト
        $aggregateData_html = "";

        foreach($aggregateData_dispDate as $aggregateData){
            $aggregateData_html .= '<tr>' .
                                '<td>' . $aggregateData->item_name . '</td>' .
                                '<td>' . $aggregateData->total_amount . '</td>' .
                            '</tr>';
        }

        Log::info('[家計簿一覧画面表示年月切替処理終了]' );

        return array('kakeiboData_html'=>$kakeiboData_html,
                        'aggregateData_html'=>$aggregateData_html,);
    }
}

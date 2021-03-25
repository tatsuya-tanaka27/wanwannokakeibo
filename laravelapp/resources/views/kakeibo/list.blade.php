@extends('layouts.base')

@section('title', 'わんわんの家計簿入力')

@section('content')
<div id="list-area" class="row">
    <div class="d-flex flex-column justify-content-center col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="ts com_title">家計簿一覧</h1>
        <div id="date-area" class="text-center mb-2">
            <div>
                <span>日付：</span>
                <select id="dispDate" name="dispDate" class="input_item">
                    @foreach(Session::get('KakeiboDateList') as $KakeiboDate)
                    <option value="{{$KakeiboDate['year'] . '-' . $KakeiboDate['month']}}">
                        {{$KakeiboDate['year'] . '年' . $KakeiboDate['month'] . '月'}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if(count(Session::get('kakeiboData_dispDate')) > 0)
        <div class="table-responsive d-xl-flex d-lg-flex d-md-flex justify-content-center">
            <table id="listTable" class="table table-sm solid-border">
                <thead class="table-info" align="center" nowrap>
                    <tr>
                        <th>項目</th>
                        <th>金額</th>
                        <th>日付</th>
                        <th>備考</th>
                    </tr>
                </thead>
                <tbody id="listData" class="table-light solid-border" align="center" nowrap>
                    @foreach(Session::get('kakeiboData_dispDate') as $data)
                    <tr>
                        <td>{{$data->item_name}}</td>
                        <td>{{$data->amount}}</td>
                        <td>{{$data->input_date}}</td>
                        <td>{{$data->remarks}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table id="aggregateDataTable" class="table table-sm solid-border ml-2">
                <thead class="table-info" align="center" nowrap>
                    <tr>
                        <th colspan="2">家計簿合計金額</th>
                    </tr>
                </thead>
                <tbody id="aggregateData" class="table-light solid-border" align="center" nowrap>
                    @foreach(Session::get('aggregateData_dispDate') as $aggregateData)
                    <tr>
                        <td>{{$aggregateData->item_name}}</td>
                        <td>{{$aggregateData->total_amount}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>
                            <span class="font-weight-bold">収支合計</span>
                        </td>
                        <td>
                            <span class="font-weight-bold">{{Session::get('incAndExp')}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection

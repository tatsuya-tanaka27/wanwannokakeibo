@extends('layouts.base')

@section('title', 'わんわんの家計簿入力')

@section('content')
<h1 class="ts com_title">家計簿一覧</h1>
<div id="date-area">
    <div>
        <span>日付：</span>
        <select id="kakeiboDate" name="kakeiboDate" class="input_item">
            @foreach(Session::get('KakeiboDateList') as $KakeiboDate)
            <option value="{{$KakeiboDate['year'] . '-' . $KakeiboDate['month']}}">
                {{$KakeiboDate['year'] . '年' . $KakeiboDate['month'] . '月'}}</option>
            @endforeach
        </select>
    </div>
</div>
<table id="listTable" class="table table-sm table-responsive">
    <thead class="table-info">
        <tr>
            <th>項目</th>
            <th>金額</th>
            <th>日付</th>
            <th>支払人</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody id="listData" class="table-light" align="center" nowrap>
        @foreach(Session::get('kakeiboData') as $data)
        <tr>
            <td>{{$data->item_name}}</td>
            <td>{{$data->amount}}</td>
            <td>{{$data->input_date}}</td>
            <td>{{$data->payer}}</td>
            <td>{{$data->remarks}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

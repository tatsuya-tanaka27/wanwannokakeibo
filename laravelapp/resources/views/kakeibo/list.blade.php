@extends('layouts.base')

@section('title', 'わんわんの家計簿入力')

@section('content')
<h1 class="ts com_title">家計簿一覧</h1>
<div id="date-area">
    <div>
        <span>日付：</span>
        <select name=”item” class="input_item">
            <option value=””></option>
            <option value=”2020/11”>2020/11 </option> <option value=”2020/12” selected>2020/12</option>
        </select>
    </div>
</div>
<table id="inputListTable" class="table table-sm table-responsive">
    <thead class="table-info">
        <tr>
            <th>項目</th>
            <th>金額</th>
            <th>日付</th>
            <th>支払人</th>
            <th>備考</th>
        </tr>
    </thead>
    <tbody class="table-light" align="center" nowrap>
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

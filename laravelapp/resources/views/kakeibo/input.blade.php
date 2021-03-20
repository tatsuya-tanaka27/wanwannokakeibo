@extends('layouts.base')

@section('title', 'わんわんの家計簿入力')

@section('content')
<h1 class="ts com_title">家計簿入力</h1>
<table id="inputTable" class="table table-sm table-responsive">
    <thead class="table-info">
        <tr>
            <th>項目</th>
            <th>金額</th>
            <th>日付</th>
            <th>支払人</th>
            <th>備考</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-light" align="center" nowrap>
        <form name="input-form" class="" action="/wanwannokakeibo/insert" method="post">
            @csrf
            <tr>
                <td>
                    {{Form::select('item', Session::get('inputItems'))}}
                </td>
                <td>
                    <input type="number" name="amount" class="" value="" />
                </td>
                <td>
                    <input type="date" name="date" />
                </td>
                <td>
                    <input type="text" name="payer" class="" value="テスト" />
                </td>
                <td>
                    <input type="text" name="remarks" class="" value="テスト値" />
                </td>
                <td>
                    <input type="submit" value="登録" />
                </td>
            </tr>
        </form>
    </tbody>
</table>
<table id="inputListTable" class="table table-sm table-responsive">
    <thead class="table-info col-xs-3 col-ms-3 col-md-4 col-lg-4">
        <tr>
            <th>項目</th>
            <th>金額</th>
            <th>日付</th>
            <th>支払人</th>
            <th>備考</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-light" align="center" nowrap>
        @foreach(Session::get('kakeiboData_now') as $data)
        <form id="kakeiboData{{$data->id}}" name="update-form" class="" action="/wanwannokakeibo/update" method="post">
            @csrf
            <input id="kakeiboDataId{{$data->id}}" type="hidden" name="update_id" value="{{$data->id}}">
            <tr id="kakeiboDataDataTr{{$data->id}}">
                <td>{{Form::select('item', Session::get('inputItems'), $data->item_id)}}</td>
                <td><input type="number" name="amount" value="{{$data->amount}}"></td>
                <td><input type="date" name="date" value="{{$data->input_date}}"></td>
                <td><input type="text" name="payer" value="{{$data->payer}}"></td>
                <td><input type="text" name="remarks" value="{{$data->remarks}}"></td>
                <td>
                    <input type="submit" name="update" value="更新" />
                </td>
                <td>
                    <input type="button" name="delete" onclick="delete_data({{$data->id}})" value="削除" />
                </td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>
<table id="aggregateDataTable" class="table table-sm table-responsive">
    <thead class="table-info">
        <tr>
            <th>項目</th>
            <th>合計金額</th>
        </tr>
    </thead>
    <tbody id="aggregateData" class="table-light" align="center" nowrap>
        @foreach(Session::get('aggregateData_now') as $aggregateData)
        <tr>
            <td>{{$aggregateData->item_name}}</td>
            <td>{{$aggregateData->total_amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

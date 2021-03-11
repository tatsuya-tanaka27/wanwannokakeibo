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
        <form name="input-form" class="" action="/wanwannokakeibo/input" method="post">
            @csrf
            <tr>
                <td>
                    {{Form::select('input_item', Session::get('inputItems'))}}
                </td>
                <td>
                    <input type="number" name="input_amount" class="" value="" />
                </td>
                <td>
                    <input type="date" name="input_date" />
                </td>
                <td>
                    <input type="text" name="input_payer" class="" value="テスト" />
                </td>
                <td>
                    <input type="text" name="input_remarks" class="" value="テスト値" />
                </td>
                <td>
                    <input type="submit" value="登録" />
                </td>
            </tr>
        </form>
    </tbody>
</table>
<table id="inputListTable" class="table table-sm table-responsive">
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
        @foreach(Session::get('kakeiboData') as $data)
        <form name="update-form" class="" action="/wanwannokakeibo/update" method="post">
            @csrf
            <input type="hidden" name="update_id" value="{{$data->id}}">
            <tr>
                <td>{{Form::select('update_item', Session::get('inputItems'), $data->item_id)}}</td>
                <td><input type="number" name="update_amount" value="{{$data->amount}}"></td>
                <td><input type="date" name="update_date" value="{{$data->input_date}}"></td>
                <td><input type="text" name="update_payer" value="{{$data->payer}}"></td>
                <td><input type="text" name="update_remarks" value="{{$data->remarks}}"></td>
                <td>
                    <input type="submit" name="value" value="更新" />
                </td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>
@endsection

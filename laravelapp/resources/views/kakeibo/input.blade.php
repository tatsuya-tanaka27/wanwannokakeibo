@extends('layouts.base')

@section('title', 'わんわんの家計簿入力')

@section('content')
<div id="input-area" class="row">
    <h1 class="ts com_title">家計簿入力</h1>
    <div class="table-responsive">
        <table id="inputTable"
            class="table table-sm table-bordered col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 solid-border">
            <thead class="table-info">
                <tr>
                    <th colspan="3">家計簿登録</th>
                </tr>
            </thead>
            <tbody class="table-light solid-border" align="center" nowrap>
                <form name="input-form" class="" action="/wanwannokakeibo/insert" method="post">
                    @csrf
                    <tr>
                        <td colspan="">
                            <input class="w-100" type="date" name="input_date" />
                        </td>
                        <td class="select_item">
                            {{Form::select('item_id', Session::get('inputItems'), null, ['placeholder'=>'家計簿項目入力選択'])}}
                        </td>
                        <td rowspan="2" style="vertical-align: middle;">
                            <input type="submit" value="登録" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="w-100" type="number" name="amount" placeholder="金額入力" />
                        </td>
                        <td>
                            <input class="w-100" type="text" name="remarks" placeholder="備考入力" />
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
        <table id="inputListTable"
            class="table table-sm table-bordered col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 solid-border">
            <thead class="table-info col-xs-3 col-ms-3 col-md-4 col-lg-4">
                <tr>
                    <th colspan="3">家計簿登録</th>
                </tr>
            </thead>

            @foreach(Session::get('kakeiboData_now') as $data)
            <tbody class="table-light" align="center" nowrap>
                <form id="kakeiboData{{$data->id}}" name="update-form" class="" action="/wanwannokakeibo/update"
                    method="post">
                    @csrf
                    <tr>
                        <td colspan="">
                            <input class="w-100" type="date" name="input_date" value="{{$data->input_date}}" />
                        </td>
                        <td class="select_item">
                            {{Form::select('item_id', Session::get('inputItems'), $data->item_id, ['placeholder'=>'家計簿項目入力選択'])}}
                        </td>
                        <td>
                            <input type="submit" name="update" value="更新" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="w-100" type="number" name="amount" value="{{$data->amount}}"
                                placeholder="金額入力" />
                        </td>
                        <td>
                            <input class="w-100" type="text" name="remarks" value="{{$data->remarks}}"
                                placeholder="備考入力" />
                        </td>
                        <td>
                            <input type="button" name="delete" onclick="delete_data({{$data->id}})" value="削除" />
                        </td>
                    </tr>
                </form>
            </tbody>
            @endforeach
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
    </div>
</div>
</div>
@endsection

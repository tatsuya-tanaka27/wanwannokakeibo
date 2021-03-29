@extends('layouts.base')

@section('title', 'わんわんの家計簿入力')

@section('content')
<div id="input-area" class="row justify-content-center">
    <h1 class="ts com_title">家計簿入力</h1>
    <div class="table-responsive d-xl-flex d-lg-flex d-md-flex justify-content-center">
        <div id="left-area col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <table id="inputTable" class="table table-sm solid-border">
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
            @if(count(Session::get('kakeiboData_now')) > 0)
            <table id="inputListTable" class="table table-sm solid-border">
                <thead class="table-info">
                    <tr>
                        <th colspan="3">家計簿修正・削除</th>
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
        </div>
        <div id="right-area col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <table id="aggregateDataTable" class="table table-sm solid-border ml-2 table-striped">
                <thead class="table-info">
                    <tr>
                        <th colspan="2">家計簿金額合計</th>
                    </tr>
                </thead>
                <tbody id="aggregateData" class="table-light" align="center" nowrap>
                    @foreach(Session::get('aggregateData_now') as $aggregateData)
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

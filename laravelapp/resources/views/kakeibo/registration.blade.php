@extends('layouts.base')

@section('title', 'わんわんの家計簿 家計簿項目登録')

@section('content')
<h1 class="ts com_title">家計簿項目登録</h1>
<table id="registrationTable" class="table table-sm table-responsive">
    <thead class="table-info">
        <tr>
            <th>項目ID</th>
            <th>項目</th>
            <th>備考</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-light" align="center" nowrap>
        <form name="registration-form" class="" action="/wanwannokakeibo/item-insert" method="post">
            @csrf
            <tr>
                <td>
                    <input type="text" name="item_id" class="" value="" />
                </td>
                <td>
                    <input type="text" name="item_name" class="" value="" />
                </td>
                <td>
                    <input type="text" name="remarks" class="" value="" />
                </td>
                <td>
                    <input type="submit" value="登録" />
                </td>
            </tr>
        </form>
    </tbody>
</table>
<table id="registrationListTable" class="table table-sm table-responsive">
    <thead class="table-info">
        <tr>
            <th>項目ID</th>
            <th>項目</th>
            <th>備考</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody class="table-light" align="center" nowrap>
        @foreach(Session::get('userItems') as $userItem)
        <form id="userItem{{$userItem->id}}" name="update-form" class="" action="/wanwannokakeibo/item-update"
            method="post">
            @csrf
            <input id="userItemId{{$userItem->id}}" type="hidden" name="update_id" value="{{$userItem->id}}">
            <tr id="userItemTr{{$userItem->id}}">
                <td><input type="text" name="item_id" value="{{$userItem->item_id}}"></td>
                <td><input type="text" name="item_name" value="{{$userItem->item_name}}"></td>
                <td><input type="text" name="remarks" value="{{$userItem->remarks}}"></td>
                <td>
                    <input type="submit" name="update" value="更新" />
                </td>
                <td>
                    <input type="button" name="delete" onclick="delete_item({{$userItem->id}})" value="削除" />
                </td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>
@endsection

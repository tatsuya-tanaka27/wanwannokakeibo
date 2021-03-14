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
@endsection

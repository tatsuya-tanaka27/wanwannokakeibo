@extends('layouts.base')

@section('title', 'わんわんの家計簿 トップ')

@section('content')
    <table>
        <tr><th>Name</th><th>Mail</th><th>Age</th></tr>
        @foreach($items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->mail}}</td>
                <td>{{$item->age}}</td>
            </tr>
        @endforeach
    </table>
@endsection

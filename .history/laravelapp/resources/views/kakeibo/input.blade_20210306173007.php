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
				<th>備考</th>
				<th></th>
			</tr>
		</thead>
		<tbody class="table-light" align="center" nowrap>
			<tr>
				<td>
					<select name="”item”" class="input_item">
						<option value="””" selected></option>
						<option value="””">家賃</option>
						<option value="””">ガス代</option>
						<option value="””">水道代</option>
						<option value="””">電気代</option>
						<option value="””">食費</option>
						<option value="””">日用品代</option>
						<option value="””">雑費</option>
					</select>
				</td>
				<td>
					<input　type="tel"　name="amount"　class="input_amount"	value=""/>
				</td>
				<td>
					<input type="date" />
				</td>
				<td>
					<input　type="text"	name="biko"	class="input_biko"　value="テスト値"/>
				</td>
				<td>
					<input type="button" value="登録" onclick="" />
				</td>
			</tr>
		</tbody>
	</table>
	<table id="inputListTable" class="table table-sm table-responsive">
		<thead class="table-info">
			<tr>
				<th>項目</th>
				<th>金額</th>
				<th>日付</th>
				<th>備考</th>
				<th></th>
			</tr>
		</thead>
		<tbody class="table-light" align="center" nowrap>
			<tr>
				<td>家賃</td>
				<td>12345</td>
				<td>2020/12/03</td>
				<td>テスト値</td>
				<td>
					<input type="button" value="修正" onclick="" />
				</td>
			</tr>
			
							</tbody>
						</table>
@endsection

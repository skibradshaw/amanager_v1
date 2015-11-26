  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<div class="row">
		<div class="large-4 columns">
			<table class="table table-striped table-condensed responsive" id="deposits" width="100%">
			<thead>
			<tr>
				<th align="center" style="cursor:pointer">Date</th>
				<th align="center" style="cursor:pointer">Item Count</th>
				<th align="center" style="cursor:pointer">Amount</th>
			</tr>
			</thead>
			<tbody>

			@forelse($deposits as $d)
				<tr>
					<td>{{ $d->deposit_date->format('n/j/Y') }}</a></td>
					<td align="center" class="text-center">{{ $d->payments()->count('id') }}</td>
					<td align="right"class="text-right">${{ number_format($d->amount,2) }}</td>
				</tr>
				
			@empty
				<tr>
					<td>None Found</td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
				</tbody>
			</table>
		</div>
	</div>
		
@stop
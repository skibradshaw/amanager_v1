  <div class="row">
  <h2><small>Ledger</small></h2>
	  <div class="large-{{ $lease->details->count() }} columns">
		  <table id="ledger" class="responsive ledger" width="100%">
			<thead>
				<tr>
				  <th>Payments</th>
				  @foreach($lease->details as $m)
				  	<th nowrap="" align="center" class="text-center"> {{ $m->detailName() }} </th>
				  @endforeach
				</tr>
			</thead>	
			<tbody>
				@foreach($lease->tenants as $t)
					<tr>
						<td> {{ $t->lastname }} </td>

						@foreach($lease->details as $m)

							
							

							@if($lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id') == 0)
							
								<td align="right" class="text-right" nowrap>${{ number_format($m->monthAllocation($t->id),2) }}</td>
							@elseif($lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id') == 1)
							<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.payments.allocate',['name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = ' . $m->year)->first()->id]) }}?leasemonth={{ $m->year . "-" . $m->month . "-01" }}" data-reveal-id="allocatePayment" data-reveal-ajax="true">${{ number_format($m->monthAllocation($t->id),2) }} ({{$lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id')}})
								</a></td>							
							@elseif($lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id') > 1)							
							<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.payments.choose',['name' => $lease->apartment->name, 'lease_id' => $lease->id]) }}?tenant_id={{ $t->id }}&leasemonth={{ $m->year . "-" . $m->month . "-01" }}" data-reveal-id="choosePayment" data-reveal-ajax="true">
								${{ number_format($m->monthAllocation($t->id),2) }} ({{$lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id')}})
								</a>
							</td>
							@endif
						@endforeach
					</tr>
				@endforeach
				<tr>
						<td> &nbsp; </td>

						@foreach($lease->details as $m)									
							<td>&nbsp;</td>
						@endforeach				</tr>			

	            <tr>
		            <td>Rent</td>
					@foreach($lease->details as $m)									
		                <th align="right" class="text-right" nowrap>${{ number_format(($m->monthly_rent),2) }} </th>
		            @endforeach
	            </tr>					            
				<tr>
				    <th>Pet Rent</th>
					@foreach($lease->details as $m)									
					    <td align="right" class="text-right edit" id="{{$m->id}}" nowrap><a href="{{ route('apartments.lease.petrent',['name' => $lease->apartment->name, 'id' => $lease->id]) }}" data-reveal-id="changePetRent" data-reveal-ajax="true">{{ number_format(($m->monthly_pet_rent),2) }}</a></td>
					@endforeach
				</tr>
				<tr>
					<td>Fees</td>
					@foreach($lease->details as $m)									
						<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.fees.index',['name' => $lease->apartment->name, 'id' => $lease->id])}} "> ${{ number_format($lease->monthFees($m->month,$m->year),2) }}</a></td>
					@endforeach
				</tr>					            
			</tbody>
			<tfoot>
				<tr>
					<td>Balance</td>
					@foreach($lease->details as $m)
						<td align="right" class="text-right" nowrap>$<span id="balance{{$m->id}}">{{ number_format($m->monthBalance(),2) }}</span></td>
					@endforeach
				</tr>
			</tfoot>	
		  </table>
		  
	  </div>
  </div>
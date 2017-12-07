<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Performance Budget - Download</title>

	<style type="text/css" media="all">
		body {
			font-size: 10pt;
		}
		#info_pb th {
			text-align: left;
			width: 150px;
		}

		#info_realisasi {
			margin-top: 20px;
		}

		table#info_realisasi {
		  border-collapse: collapse;
		}

		#info_realisasi td, #info_realisasi th {
		  border: 1px solid #000;
		  padding: 0.5rem;
		}

		.nom {
			float: right;
		}
	</style>
</head>
<body>
	<h2>PERFORMANCE BUDGET</h2>
	<table id="info_pb" border="0">
		<tr>
			<th>No. Kontrak</th>
			<td>:</td>
			<td>{{ $pb->contract_number }}</td>
		</tr><tr>
			<th>Proyek</th>
			<td>:</td>
			<td>{{ $pb->job_title }}</td>
		</tr>
		<tr>
			<th>Client</th>
			<td>:</td>
			<td>{{ $pb->client_name }}</td>
		</tr>
		<tr>
			<th>Lokasi</th>
			<td>:</td>
			<td>{{ $pb->client_address }}</td>
		</tr>
		<tr>
			<th>Tanggal Kontrak</th>
			<td>:</td>
			<td>{{ $pb->getContractDate() }}</td>
		</tr>
		<tr>
			<th>Nilai Kontrak</th>
			<td>:</td>
			<td>Rp {{ number_format($pb->value,0,',','.') }}</td>
		</tr>
	</table>

	<table id="info_realisasi" width="100%">
		<thead>
			<tr>
				<th style="text-align: center;">No.</th>
				<th style="text-align: center;">Tanggal</th>
				<th style="text-align: center;">Keterangan</th>
				<th style="text-align: center;">Biaya</th>
				<th style="text-align: center;">Saldo</th>
			</tr>
		</thead>

		<tbody>
		<?php $saldo = $pb->value; $belanja = 0; $no = 1;?>
		@foreach ($realisasi as $key => $element)
            <?php 
                $saldo -= $element['jumlah']; 
                $belanja += $element['jumlah']; 
            ?>
            <tr>
                <td style="text-align: center;">{{ $no }}</td>
                <td>{{ $element['date'] }}</td>
                <td>{{ $element['jenis'] == 'Advance Payment' ? 'Advance Payment: '.$element['detail'] : $element['detail'] }}</td>
                <td>
                	<span>Rp </span> 
                	<span class="nom">{{ number_format($element['jumlah'],0,',','.') }}</span>
	            </td>
                <td>
                	<span>Rp </span> 
                	<span class="nom">{{ number_format($saldo,0,',','.') }}</span>
	            </td>
            </tr>

            <?php $no++; ?>
        @endforeach
		</tbody>
	</table>
</body>
</html>
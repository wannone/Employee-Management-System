<!DOCTYPE html>
<html>
<head>
    <style>
         thead {
        display: table-header-group;
    }
    tfoot {
        display: table-row-group;
    }
    tr {
        page-break-inside: avoid;
    }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            word-wrap: break-word;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        h5 {
            margin: 10px 0;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h5>Employee List</h5>

    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 8%;">NIP</th>
                <th style="width: 10%;">Name</th>
                <th style="width: 10%;">Birthplace</th>
                <th style="width: 10%;">Birthdate</th>
                <th style="width: 15%;">Address</th>
                <th style="width: 5%;">M/F</th>
                <th style="width: 10%;">Group</th>
                <th style="width: 8%;">Eselon</th>
                <th style="width: 10%;">Position</th>
                <th style="width: 10%;">Workplace</th>
                <th style="width: 10%;">Religion</th>
                <th style="width: 15%;">Unit</th>
                <th style="width: 10%;">Phone</th>
                <th style="width: 15%;">NPWP</th>
            </tr>
        </thead>
        <tbody>
            @php $i=0 @endphp
            @foreach($data as $d)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $d['nip'] }}</td>
                <td>{{ $d['name'] }}</td>
                <td>{{ $d['birthplace'] }}</td>
                <td>{{ $d['birthdate'] }}</td>
                <td>{{ $d['address'] }}</td>
                <td>{{ $d['gender'] }}</td>
                <td>{{ $d['group'] }}</td>
                <td>{{ $d['eselon'] }}</td>
                <td>{{ $d['position'] }}</td>
                <td>{{ $d['workplace'] }}</td>
                <td>{{ $d['religion'] }}</td>
                <td>{{ $d['unit'] }}</td>
                <td>{{ $d['phone'] }}</td>
                <td>{{ $d['npwp'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

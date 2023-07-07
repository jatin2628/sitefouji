<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Files</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
            font-size: 28px;
        }

        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .status-pending {
            color: #ff9800;
        }

        .status-approved {
            color: #4caf50;
        }

        .status-partially-approved {
            color: #2196f3;
        }

        .status-declined {
            color: #f44336;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="/logout" class="logout-button">Logout</a>
    <h1>User Files for {{ $user->first_name }}</h1>

    <table>
        <thead>
            <tr>
                <th>File Name</th>
                <th>Total Entries</th>
                <th>Unique Entries</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->filename }}</td>
                    <td>@if ($totalEntries[$file->id] == 0)
                        -
                    @else
                        {{ $totalEntries[$file->id] }}
                    @endif</td>
                    <td> @if ($uniqueEntries[$file->id]==0)
                        -
                    @else
                        {{ $uniqueEntries[$file->id] }}
                        
                    @endif</td>
                    <td>
                        @if ($file->status=='0')
                            <span class="status-pending">Pending</span>
                        @elseif ($file->status=='1')
                            <span class="status-approved">Approved</span>
                        @elseif ($file->status=='2')
                            <span class="status-partially-approved">Partially Approved</span>
                        @elseif ($file->status=='3')
                            <span class="status-declined">Declined</span>
                        @endif
                    </td>
                    <td>
                    <a href="/userdata/{{$file->id}}/status/1">Approve</a> |
                        <a href="/userdata/{{$file->id}}/status/2">Partially Approved</a> |
                        <a href="/userdata/{{$file->id}}/status/3">Decline</a>
                    </td>
                    <td><a href="/userdata/{{$file->id}}/view">View</a></td>
                    <td><a href="{{url('/download',$file->filename)}}">Download</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>











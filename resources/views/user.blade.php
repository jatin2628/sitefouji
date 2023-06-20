<!DOCTYPE html>
<html>
<head>
    <title>File Upload and Status Table</title>
    <style>
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .status {
            margin-left: 10px;
        }

        .status span {
            margin-right: 10px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .status .count {
            margin-right: 10px;
            color: #fff;
        }

        .status .count span {
            margin-right: 5px;
            font-weight: bold;
        }

        .status .count .total {
            color: #fff;
        }

        .status .count .jat1 {
            color: green;
        }

        .status .count .jat2 {
            color: orange;
        }

        .status .count .jat0 {
            color: blue;
        }

        .status .count .jat3 {
            color: red;
        }
        form{
            margin: 25px;
        }
    </style>
</head>
<body>
    <header>
        <h1>File Upload and Status Table</h1>
        <div class="status">
            <span>Welcome, {{ $user->first_name.' '.$user->last_name}} </span>
            <div class="count">
                <span>Total Files Uploaded:</span>
                <span class="total">{{$statusCounts['totalFiles']}}</span>
                <span>Approved:</span>
                <span class="approved">{{$statusCounts['approved']}}</span>
                <span>Partially Approved:</span>
                <span class="partially-approved">{{$statusCounts['partiallyApproved']}}</span>
                <span>Pending:</span>
                <span class="pending">{{$statusCounts['pending']}}</span>
                <span>Declined:</span>
                <span class="declined">{{$statusCounts['declined']}}</span>
            </div>
        </div>
    </header>

    <form method="post" action="/api/upload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="files[]" multiple />
        <input type="submit" value="Upload" />
    </form>

    <table>
        <thead>
            <tr>
                <th>Sno</th>
                <th>Filename</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->id }}</td>
                    <td>{{ $file->filename }}</td>
                    <td class="jat{{ $file->status }}">
                        @if ($file->status=='0')
                            Pending
                        @elseif ($file->status=='1')
                            Approved
                        @elseif ($file->status=='2')
                            Partially Approved
                        @elseif ($file->status=='3')
                            Declined
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

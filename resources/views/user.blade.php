<!DOCTYPE html>
<html>
<head>
    <title>File Upload and Status Table</title>
    <style>
        /* Styling for header */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
           
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #fff;
        }

        /* Styling for logo */
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            margin: auto;
            justify-content: center;
            align-items: center;
        }

        /* Styling for user info */
        .user-info {
            color: #fff;
         
            display: flex;
            margin: auto;
            margin-left: 10px;
            justify-content: center;
            align-items: center;
        }

        /* Styling for logout button */
        .logout-button input[type="submit"] {
            background-color: #555;
            border: none;
            color: #fff;
            cursor: pointer;
            right:5px;
            float: right;
            font-size: 14px;
            text-decoration: underline;
            font-weight: bold;
            margin: 5px;
            padding: 5px;
        }

        /* Styling for count section */
        .count-section {
            background-color: #555;
            padding: 10px;
            color: #fff;
            margin-top: 10px;
            border-radius: 5px;
        }

        /* Styling for count items */
        .count-item {
            display: inline-block;
            margin-right: 10px;
        }

        /* Styling for count labels */
        .count-label {
            font-weight: bold;
        }

        /* Styling for count values */
        .count-value {
            font-weight: bold;
            margin-right: 5px;
        }

        /* Styling for file count section */
        .file-count {
            margin-top: 10px;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        /* Styling for file types */
        .file-type {
            margin-right: 10px;
            font-weight: bold;
        }

        /* Styling for file type counts */
        .file-type-count {
            margin-right: 5px;
            font-weight: bold;
        }

        /* Styling for file type colors */
        .excel {
            color: green;
        }

        .word {
            color: blue;
        }

        .pdf {
            color: red;
        }

        /* Styling for table */
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

        /* Styling for status classes */
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-pending {
            color: blue;
            background-color: #d6eaf8;
        }

        .status-approved {
            color: green;
            background-color: #d4efdf;
        }

        .status-partially-approved {
            color: orange;
            background-color: #f9e79f;
        }

        .status-declined {
            color: red;
            background-color: #f5b7b1;
        }
        .upload-form{
            display: flex;
            margin:auto;
        }
        .upload-form input{
            width: 15rem;

            height: 1.8rem;
            padding: 4px;
        }
        form{
            margin: 10px;
            padding: 10px;
        }
        .flash-message {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        z-index: 9999;
    }

    .flash-success {
        background-color: #7ec699;
        color: #ffffff;
    }

    .flash-error {
        background-color: #ff6b6b;
        color: #ffffff;
    }
    </style>
</head>
<body>
    <header>
        @if (session('success'))
    <div class="flash-message flash-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="flash-message flash-error">
        {{ session('error') }}
    </div>
@endif
        <div class="logo">File Upload and Status Table
         
        </div>
        <div class="logout-button">
            <form method="get" action="/logout">
                @csrf
                <input type="submit" value="Logout" />
            </form>
        </div>
        <div class="user-info">
            Welcome, {{ $user->first_name.' '.$user->last_name}}
        </div>
        <div class="count-section">
            <div class="count-item">
                <span class="count-label">Total Files Uploaded:</span>
                <span class="count-value">{{$statusCounts['totalFiles']}}</span>
            </div>
            <div class="count-item">
                <span class="count-label">Approved:</span>
                <span class="count-value">{{$statusCounts['approved']}}</span>
            </div>
            <div class="count-item">
                <span class="count-label">Partially Approved:</span>
                <span class="count-value">{{$statusCounts['partiallyApproved']}}</span>
            </div>
            <div class="count-item">
                <span class="count-label">Pending:</span>
                <span class="count-value">{{$statusCounts['pending']}}</span>
            </div>
            <div class="count-item">
                <span class="count-label">Declined:</span>
                <span class="count-value">{{$statusCounts['declined']}}</span>
            </div>
        </div>
      
    </header>
    

    <div class="file-count">
        <span class="file-type">
            Total Excel Files:
            <span class="file-type-count">{{$excelFiles}}</span>
        </span>
        <span class="file-type">
            Total Word Files:
            <span class="file-type-count">{{$wordFiles}}</span>
        </span>
        <span class="file-type">
            Total PDF Files:
            <span class="file-type-count">{{$pdfFiles}}</span>
        </span>
    </div>

    <form class="upload-form" method="post" action="/upload" enctype="multipart/form-data">
        @csrf
        <input  type="file" name="files[]" multiple /><br>
        <input type="submit" value="Upload" />
    </form>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Filename</th>
                <th>Status</th>
                <th>Total Entries</th>
                <th>Unique Entries</th>
            </tr>
        </thead>
        <tbody>
            {{$count = 0}}
            @foreach ($files as $file)
                <tr>
                    <td>{{ ++$count }}</td>
                    <td>{{ $file->filename }}</td>
                    <td class="status status-{{$file->status}}">
                        @if ($file->status == '0')
                            Pending
                        @elseif ($file->status == '1')
                            Approved
                        @elseif ($file->status == '2')
                            Partially Approved
                        @elseif ($file->status == '3')
                            Declined
                        @endif
                    </td>
                    <td>
            
                        @if ($totalEntries[$file->id] == 0)
                -
            @else
                {{ $totalEntries[$file->id] }}
            @endif
        </td>
                    <td>
                    @if ($uniqueEntries[$file->id]==0)
                -
            @else
                {{ $uniqueEntries[$file->id] }}
                
            @endif
            </td></tr>
            @endforeach
        </tbody>
    </table>
    <script>
        // Add this JavaScript code in your HTML template or an external JS file
        setTimeout(function() {
            var flashMessages = document.getElementsByClassName('flash-message');
            for (var i = 0; i < flashMessages.length; i++) {
                flashMessages[i].style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html>
